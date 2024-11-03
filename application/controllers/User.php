<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Dashboard',
            'total_keranjang'   => $this->Model_user->getTotalKeranjang($id_user),
            'total_transaksi'   => $this->Model_user->getTotalTransaksi($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/dashboard');
        $this->load->view('templates/user/footer');
    }


    // DAFTAR MENU
    public function daftar_menu()
    {
        $data = [
            'title' => 'Daftar Menu',
            'menu'  => $this->Model_user->getAllMenu(),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/daftar_menu');
        $this->load->view('templates/user/footer');
    }

    public function tambah_keranjang($id_menu)
    {
        $id_user = $this->session->userdata('id_user');
        $cekMenu = $this->Model_user->cekKeranjang($id_user, $id_menu);

        if ($cekMenu) {
            $data = [
                'jumlah' => $cekMenu->jumlah + 1
            ];

            $this->Model_user->editJumlahKeranjang($id_user, $id_menu, $data);
        } else {
            $data = [
                'id_user' => $id_user,
                'id_menu' => $id_menu,
                'jumlah'  => 10,
            ];

            $this->Model_user->tambahKeranjang($data);
        }

        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Berhasil menambahkan ke keranjang
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('user/daftar_menu');
    }


    // KERANJANG
    public function keranjang()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Keranjang',
            'menu'      => $this->Model_user->getAllMenu(),
            'keranjang' => $this->Model_user->getKeranjang($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/keranjang');
        $this->load->view('templates/user/footer');
    }

    public function edit_keranjang($id_keranjang)
    {
        $jumlah = $this->input->post('jumlah');

        if ($jumlah < 10) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Jumlah tidak boleh kurang dari 10
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect('user/keranjang');
            return;
        }

        $data = [
            'id_keranjang' => $this->input->post('id_keranjang'),
            'jumlah'       => $jumlah,
        ];

        $this->Model_user->editKeranjang($id_keranjang, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Data berhasil diubah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('user/keranjang');
    }


    public function hapus_keranjang($id_keranjang)
    {
        $this->Model_user->hapusItemKeranjang($id_keranjang);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data berhasil dihapus
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('user/keranjang');
    }


    // CHECKOUT
    public function checkout()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Keranjang',
            'menu'      => $this->Model_user->getAllMenu(),
            'keranjang' => $this->Model_user->getKeranjang($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/checkout');
        $this->load->view('templates/user/footer');
    }

    public function checkout_pemesanan()
    {
        date_default_timezone_set('Asia/Jakarta');

        $id_user = $this->session->userdata('id_user');

        $kode_pemesanan = date('dmYHi');

        $data_pemesanan = [
            'kode_pemesanan'    => $kode_pemesanan,
            'id_user'           => $id_user,
            'no_telp'           => $this->input->post('no_telp'),
            'alamat'            => $this->input->post('alamat'),
            'sub_total'         => $this->input->post('sub_total'),
            'tanggal_pemesanan' => date('Y-m-d H:i:s'),
            'status_pengiriman' => 'Menunggu',
            'status_pembayaran' => 'Belum Diterima',
        ];

        $this->Model_user->tambahPemesanan($data_pemesanan);

        $id_pemesanan = $this->db->insert_id();

        $kode_pemesanan .= sprintf('%03d', $id_pemesanan);

        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->update('pemesanan', ['kode_pemesanan' => $kode_pemesanan]);

        $keranjang  = $this->Model_user->getKeranjang($id_user);

        foreach ($keranjang as $item) {
            $data_detail_pemesanan = [
                'id_pemesanan'  => $id_pemesanan,
                'id_menu'       => $item['id_menu'],
                'jumlah'        => $item['jumlah'],
            ];

            $this->Model_user->tambahDetailPemesanan($data_detail_pemesanan);
        }

        $this->Model_user->hapusKeranjang($id_user);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Checkout berhasil! Silahkan melakukan pembayaran.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>'
        );

        redirect('user/pembayaran/' . $id_pemesanan);
    }


    // TRANSAKSI
    public function transaksi()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'     => 'Transaksi',
            'pemesanan' => $this->Model_user->getPemesanan($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/transaksi');
        $this->load->view('templates/user/footer');
    }

    public function detail_transaksi($id_pemesanan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Detail Transaksi',
            'id_user'           => $id_user,
            'detail_pemesanan'  => $this->Model_user->getDetailPemesanan($id_pemesanan),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/detail_pemesanan');
        $this->load->view('templates/user/footer');
    }

    public function hapus_transaksi($id_pemesanan)
    {
        $this->Model_user->hapusPemesanan($id_pemesanan);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data berhasil dihapus
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('user/transaksi');
    }

    public function nota($id_pemesanan)
    {
        // $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Detail Transaksi',
            // 'id_user'           => $id_user,
            'pemesanan'         => $this->Model_user->getPemesananById($id_pemesanan),
            'detail_pemesanan'  => $this->Model_user->getDetailPemesanan($id_pemesanan),
        ];

        // $this->load->view('templates/user/header', $data);
        // $this->load->view('templates/user/topbar');
        // $this->load->view('templates/user/sidebar');
        $this->load->view('user/nota', $data);
        // $this->load->view('templates/user/footer');
    }


    // PEMBAYARAN
    public function pembayaran($id_pemesanan)
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title'             => 'Pembayaran',
            'id_user'           => $id_user,
            'detail_pemesanan'  => $this->Model_user->getDetailPemesanan($id_pemesanan),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/pembayaran');
        $this->load->view('templates/user/footer');
    }

    public function upload_pembayaran()
    {
        $config['upload_path']      = './assets/img/bukti_transaksi/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 2048;

        $this->load->library('upload', $config);

        $id_pemesanan   = $this->input->post('id_pemesanan');
        $id_transaksi   = $this->input->post('id_transaksi');

        // jika upload ulang bukti transaksi
        if ($id_transaksi) {
            $transaksi              = $this->Model_user->getTransaksi($id_transaksi);
            $bukti_transaksi_lama   = $transaksi['bukti_transaksi'];
            $path_file_lama         = './assets/img/bukti_transaksi/' . $bukti_transaksi_lama;

            if ($bukti_transaksi_lama && file_exists($path_file_lama)) {
                unlink($path_file_lama);
            }
        }

        if (!$this->upload->do_upload('bukti_transaksi')) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
            redirect('user/pembayaran');
        } else {
            $upload_foto    = $this->upload->data();
            $transfer_lunas = $upload_foto['file_name'];

            $data = [
                'id_pemesanan'      => $id_pemesanan,
                'bukti_transaksi'   => $transfer_lunas,
                'tanggal_transaksi' => date('Y-m-d'),
            ];

            if ($id_transaksi) {
                $this->Model_user->editTransaksi($id_transaksi, $data);
                $this->Model_user->editStatusPembayaran($id_pemesanan, 'Belum Diterima');
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Bukti pembayaran berhasil diupload ulang
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );

                redirect('user/transaksi');
            } else {
                $this->Model_user->tambahTransaksi($data);
            }
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Bukti pembayaran berhasil diupload
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>'
            );

            redirect('user/transaksi');
        }
    }


    // PROFILE
    public function profile()
    {
        $id_user = $this->session->userdata('id_user');

        $data = [
            'title' => 'Profile',
            'user'  => $this->Model_user->getUserById($id_user),
        ];

        $this->load->view('templates/user/header', $data);
        $this->load->view('templates/user/topbar');
        $this->load->view('templates/user/sidebar');
        $this->load->view('user/profile');
        $this->load->view('templates/user/footer');
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

        $this->Model_user->editProfile($id_user, $data);
        $this->session->set_flashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil berhasil diubah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>'
        );

        redirect('user/profile');
    }
}

/* End of file User.php */
