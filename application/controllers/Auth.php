<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $this->load->view('auth/home');
    }

    public function login()
    {
        $this->validasiLogin();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $email      = $this->input->post('email');
            $password   = $this->input->post('password');

            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            // jika user ditemukan
            if ($user) {

                // cek status user
                if ($user['status'] == 'Aktif') {

                    // cek password user
                    if (password_verify($password, $user['password'])) {

                        // jika password sesuai
                        $data = [
                            'id_user'       => $user['id_user'],
                            'id_role'       => $user['id_role']
                        ];

                        $this->session->set_userdata($data);

                        // cek id_role
                        if ($user['id_role'] == 1) {
                            $this->session->set_flashdata(
                                'pesan',
                                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Hallo, selamat datang <strong>' . $user['nama_lengkap'] . '!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>'
                            );
                            redirect('admin');
                        } elseif ($user['id_role'] == 2) {
                            $this->session->set_flashdata(
                                'pesan',
                                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Hallo, selamat datang <strong>' . $user['nama_lengkap'] . '!</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>'
                            );
                            redirect('user');
                        }
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Maaf, password salah!</div>');
                        redirect('login');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">Akun Anda tidak aktif. Silakan hubungi admin untuk informasi lebih lanjut.</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email belum terdaftar! Silakan registrasi.</div>');
                redirect('login');
            }
        }
    }

    public function registrasi()
    {
        $this->validasiRegistrasi();

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/registrasi');
        } else {
            $data_user = [
                'nama_lengkap'  => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'email'         => htmlspecialchars($this->input->post('email', true)),
                'no_hp'         => htmlspecialchars($this->input->post('no_hp', true)),
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_role'       => 2,
                'status'        => 'Tidak Aktif'
            ];

            date_default_timezone_set('Asia/Jakarta');
            $data_transaksi = [
                'tanggal_transaksi' => date('Y-m-d H:i:s'),
                'bukti_transaksi'   => null
            ];

            if (!empty($_FILES['bukti_transaksi']['name'])) {
                $config = [
                    'upload_path'   => './assets/img/transaksi_pendaftaran/',
                    'allowed_types' => 'jpg|jpeg|png|pdf',
                    'max_size'      => 2048,
                ];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('bukti_transaksi')) {
                    $upload_data = $this->upload->data();
                    $data_transaksi['bukti_transaksi'] = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Gagal mengupload bukti transaksi. ' . $this->upload->display_errors('', '') . '</div>');
                    redirect('registrasi');
                    return;
                }
            }

            if ($this->Model_auth->tambahUserDanTransaksi($data_user, $data_transaksi)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Registrasi akun berhasil! Silakan login.</div>');
                redirect('login');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Registrasi gagal. Silakan coba lagi.</div>');
                redirect('registrasi');
            }
        }
    }

    public function not_found()
    {
        $this->load->view('404.php');
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_role');
        redirect('auth');
    }

    // VALIDASI LOGIN
    private function validasiLogin()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required'      => '%s belum diisi',
            'valid_email'   => '%s tidak valid',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required'      => '%s belum diisi',
        ]);
    }

    // VALIDASI REGISTRASI
    private function validasiRegistrasi()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama lengkap', 'required|trim', [
            'required'      => '%s belum diisi'
        ]);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'required'      => '%s belum diisi',
            'valid_email'   => '%s tidak valid',
            'is_unique'     => '%s sudah terdaftar'
        ]);

        $this->form_validation->set_rules('no_hp', 'No handphone', 'required|trim|min_length[12]|max_length[12]|numeric|is_unique[user.no_hp]', [
            'required'      => '%s belum diisi',
            'min_length'    => '%s minimal 12 angka',
            'max_length'    => '%s maksimal 12 angka',
            'numeric'       => '%s harus berupa angka',
            'is_unique'     => '%s sudah terdaftar',
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required'      => '%s belum diisi',
        ]);
    }
}

/* End of file Auth.php */
