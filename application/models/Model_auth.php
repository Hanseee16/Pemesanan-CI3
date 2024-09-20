<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_auth extends CI_Model
{
    public function tambahUserDanTransaksi($data_user, $data_transaksi)
    {
        // Mulai transaksi
        $this->db->trans_start();

        // Tambahkan user
        $this->db->insert('user', $data_user);

        // Dapatkan ID user yang baru saja dimasukkan
        $id_user = $this->db->insert_id();

        // Tambahkan ID user ke data transaksi
        $data_transaksi['id_user'] = $id_user;

        // Tambahkan transaksi pendaftaran
        $this->db->insert('transaksi_pendaftaran', $data_transaksi);

        // Selesaikan transaksi
        $this->db->trans_complete();

        // Periksa apakah transaksi berhasil
        if ($this->db->trans_status() === FALSE) {
            // Jika gagal, rollback
            return false;
        } else {
            // Jika sukses, commit
            return true;
        }
    }
}

/* End of file Model_auth.php */
