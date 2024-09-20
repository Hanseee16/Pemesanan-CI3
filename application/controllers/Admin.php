<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // CEK LOGIN
        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
            redirect('login');
        }

        // FORMAT TANGGAL
        function tanggalIndonesia($tanggal)
        {
            $bulan = [
                1 => 'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];
            $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));

            return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }
    }


    // DASHBOARD
    public function index()
    {
        $data = [
            'title'             => 'Dashboard',
            'total_menu'        => $this->Model_admin->getTotalMenu(),
            'total_transaksi'   => $this->Model_admin->getTotalTransaksi(),
            'total_reseller'    => $this->Model_admin->getTotalReseller()
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/dashboard');
        $this->load->view('templates/admin/footer');
    }



    // START KATEGORI MAKANAN
    public function kategori()
    {
        $data = [
            'title'     => 'Kategori Makanan',
            'kategori'  => $this->Model_admin->getAllKategori(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/kategori');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_kategori()
    {
        $data = [
            'jenis_kategori'    => $this->input->post('jenis_kategori'),
            'nama_kategori'     => $this->input->post('nama_kategori'),
        ];

        $this->Model_admin->tambahKategori($data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil disimpan
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('admin/kategori');
    }

    public function edit_kategori($id_kategori)
    {
        $data = [
            'id_kategori'       => $this->input->post('id_kategori'),
            'jenis_kategori'    => $this->input->post('jenis_kategori'),
            'nama_kategori'     => $this->input->post('nama_kategori'),
        ];

        $this->Model_admin->editKategori($id_kategori, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data berhasil diubah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('admin/kategori');
    }
    // END KATEGORI MAKANAN




    // START MENU
    public function menu()
    {
        $data = [
            'title'     => 'Menu',
            'menu'      => $this->Model_admin->getAllMenu(),
            'kategori'  => $this->Model_admin->getAllKategori(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/menu');
        $this->load->view('templates/admin/footer');
    }

    public function tambah_menu()
    {
        $config['upload_path']      = './assets/img/upload_menu/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('admin/menu');
        } else {
            $upload_foto    = $this->upload->data();
            $foto_menu      = $upload_foto['file_name'];

            $data = [
                'id_kategori'   => $this->input->post('id_kategori'),
                'nama_menu'     => $this->input->post('nama_menu'),
                'harga'         => $this->input->post('harga'),
                'stok'          => $this->input->post('stok'),
                'isi'           => $this->input->post('isi'),
                'keterangan'    => $this->input->post('keterangan'),
                'foto'          => $foto_menu
            ];

            $this->Model_admin->tambahMenu($data);
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data berhasil disimpan
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );
            redirect('admin/menu');
        }
    }

    public function edit_menu($id_menu)
    {
        $menu       = $this->Model_admin->getMenuById($id_menu);
        $foto_lama  = $menu['foto'];

        $data = [
            'id_menu'       => $this->input->post('id_menu'),
            'id_kategori'   => $this->input->post('id_kategori'),
            'nama_menu'     => $this->input->post('nama_menu'),
            'harga'         => $this->input->post('harga'),
            'isi'           => $this->input->post('isi'),
            'stok'          => $this->input->post('stok'),
            'keterangan'    => $this->input->post('keterangan'),
        ];

        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path']      = './assets/img/upload_menu/';
            $config['allowed_types']    = 'gif|jpg|jpeg|png';
            $config['max_size']         = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/menu');
            } else {
                $upload_foto = $this->upload->data();
                $data['foto'] = $upload_foto['file_name'];

                // Hapus foto lama jika ada
                if ($foto_lama && file_exists('./assets/img/upload_menu/' . $foto_lama)) {
                    unlink('./assets/img/upload_menu/' . $foto_lama);
                }
            }
        }

        $this->Model_admin->editMenu($id_menu, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data berhasil diubah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );
        redirect('admin/menu');
    }
    // END MENU




    // START TRANSAKSI
    public function transaksi()
    {
        $data = [
            'title'     => 'Transaksi',
            'transaksi' => $this->Model_admin->getAllTransaksi(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/transaksi');
        $this->load->view('templates/admin/footer');
    }

    public function edit_transaksi($id_pemesanan)
    {
        $status_pembayaran = $this->input->post('status_pembayaran');

        $data = [
            'id_pemesanan'          => $this->input->post('id_pemesanan'),
            'status_pengiriman'     => $this->input->post('status_pengiriman'),
            'status_pembayaran'     => $status_pembayaran,
            'keterangan_ditolak'    => $this->input->post('keterangan_ditolak'),
        ];

        $this->Model_admin->editTransaksi($id_pemesanan, $data);

        // Kurangi stok jika pembayaran diterima
        if ($status_pembayaran == 'Diterima') {
            $detail_pesanan = $this->Model_admin->getDetailPemesanan($id_pemesanan);

            foreach ($detail_pesanan as $item) {
                $this->Model_admin->kurangiStokMenu($item['id_menu'], $item['jumlah']);
            }
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data berhasil diubah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('admin/transaksi');
    }

    public function detail_transaksi($id_pemesanan)
    {
        $data = [
            'title'             => 'Detail Transaksi',
            'pemesanan'         => $this->Model_admin->getPemesanan($id_pemesanan),
            'detail_pemesanan'  => $this->Model_admin->getDetailPemesanan($id_pemesanan),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/detail_transaksi');
        $this->load->view('templates/admin/footer');
    }
    // END TRANSAKSI




    // START REGISTRASI
    public function registrasi()
    {
        $data = [
            'title'         => 'Registrasi',
            'registrasi'    => $this->Model_admin->getAllRegistrasi(),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/registrasi');
        $this->load->view('templates/admin/footer');
    }

    public function edit_registrasi($id_user)
    {
        $status = $this->input->post('status');

        $data = [
            'id_user'   => $this->input->post('id_user'),
            'status'    => $status,
        ];

        $this->Model_admin->editRegistrasi($id_user, $data);

        // Jika status menjadi "Aktif", kirimkan email notifikasi
        if ($status === 'Aktif') {
            $user = $this->Model_admin->getUserById($id_user);

            $this->load->library('email');
            $this->email->from('kikiperdana46@gmail.com', 'Warung Kisam');
            $this->email->to($user->email);
            $this->email->subject('Status Registrasi Anda Telah Aktif');

            $user = $this->Model_admin->getUserById($id_user);

            $this->email->message('
                <html>
                <head>
                    <style>
                        .email-container {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            padding: 20px;
                            border-radius: 10px;
                            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                        }
                        .email-header {
                            font-size: 24px;
                            font-weight: bold;
                            color: #333;
                            margin-bottom: 20px;
                        }
                        .email-body {
                            font-size: 16px;
                            color: #555;
                            line-height: 1.5;
                        }
                        .email-footer {
                            margin-top: 20px;
                            font-size: 14px;
                            color: #888;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <div class="email-header">
                            Pemberitahuan Aktivasi Registrasi
                        </div>
                        <div class="email-body">
                            <p>Yth. Bapak/Ibu ' . $user->nama_lengkap . ',</p>
                            <p>Dengan hormat,</p>
                            <p>Kami ingin memberitahukan bahwa status registrasi Anda telah diaktifkan. Dengan perubahan ini, Anda kini dapat mengakses seluruh layanan yang tersedia.</p>
                            <p>Terima kasih atas perhatian dan partisipasi Anda.</p>
                        </div>
                        <div class="email-footer">
                            <p>Hormat kami,</p>
                            <p><strong>Tim Kami - Warung Kisam</strong></p>
                        </div>
                    </div>
                </body>
                </html>
            ');

            if ($this->email->send()) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Email notifikasi telah dikirimkan.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal mengirim email notifikasi.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            }
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data berhasil diubah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('admin/registrasi');
    }
    // END REGISTRASI




    // PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title' => 'Profile',
            'user'  => $this->Model_admin->getUserById($id_user),
        ];

        $this->load->view('templates/admin/header', $data);
        $this->load->view('templates/admin/topbar');
        $this->load->view('templates/admin/sidebar');
        $this->load->view('admin/profile');
        $this->load->view('templates/admin/footer');
    }

    public function edit_profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'nama_lengkap'  => $this->input->post('nama_lengkap'),
            'no_hp'         => $this->input->post('no_hp'),
        ];

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->Model_admin->editProfile($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                 Profil berhasil diubah.
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>'
        );

        redirect('admin/profile');
    }
}

/* End of file Admin.php */
