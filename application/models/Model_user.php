<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_user extends CI_Model
{
    // GET TOTAL DATA
    public function getTotalKeranjang($id_user)
    {
        return $this->db->where('k.id_user', $id_user)
            ->from('keranjang AS k')
            ->count_all_results();
    }

    public function getTotalTransaksi($id_user)
    {
        return $this->db->select('COUNT(*) AS total')
            ->join('pemesanan AS p', 'p.id_pemesanan = t.id_transaksi', 'INNER')
            ->join('user AS u', 'u.id_user = p.id_user', 'INNER')
            ->where('u.id_user', $id_user)
            ->from('transaksi AS t')
            ->get()
            ->row()
            ->total;
    }




    // GET ALL DATA
    public function getAllMenu()
    {
        $this->db->join('kategori AS k', 'k.id_kategori = m.id_kategori', 'INNER');
        return $this->db->get('menu AS m')->result_array();
    }


    // CEK DATA
    public function cekKeranjang($id_user, $id_menu)
    {
        return $this->db->get_where('keranjang', ['id_user' => $id_user, 'id_menu' => $id_menu])->row();
    }


    // GET DATA BY ID
    public function getUserById($id_user)
    {
        $this->db->where('u.id_user', $id_user);
        $this->db->join('role AS r', 'r.id_role = u.id_role', 'INNER');
        return $this->db->get('user AS u')->row_array();
    }

    public function getKeranjang($id_user)
    {
        $this->db->join('menu AS m', 'm.id_menu = k.id_menu', 'INNER');
        $this->db->where('k.id_user', $id_user);
        return $this->db->get('keranjang AS k')->result_array();
    }

    public function getPemesanan($id_user)
    {
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('p.id_user', $id_user);
        return $this->db->get('pemesanan AS p')->result_array();
    }

    public function getPemesananById($id_pemesanan)
    {
        $this->db->where('p.id_pemesanan', $id_pemesanan);
        $this->db->join('transaksi AS t', 't.id_pemesanan = p.id_pemesanan', 'LEFT');
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('pemesanan AS p')->row_array();
    }

    public function getDetailPemesanan($id_pemesanan)
    {
        $this->db->where('dp.id_pemesanan', $id_pemesanan);
        $this->db->join('transaksi AS t', 't.id_pemesanan = p.id_pemesanan', 'LEFT');
        $this->db->join('detail_pemesanan AS dp', 'p.id_pemesanan = dp.id_pemesanan', 'INNER');
        $this->db->join('menu AS m', 'm.id_menu = dp.id_menu', 'INNER');
        return $this->db->get('pemesanan AS p')->result_array();
    }

    public function getTransaksi($id_transaksi)
    {
        return $this->db->where('id_transaksi', $id_transaksi)->get('transaksi')->row_array();
    }



    // TAMBAH DATA
    public function tambahKeranjang($data)
    {
        $this->db->insert('keranjang', $data);
    }

    public function tambahPemesanan($data_pesanan)
    {
        return $this->db->insert('pemesanan', $data_pesanan);
    }

    public function tambahDetailPemesanan($data_pesanan)
    {
        return $this->db->insert('detail_pemesanan', $data_pesanan);
    }

    public function tambahTransaksi($data)
    {
        return $this->db->insert('transaksi', $data);
    }


    // EDIT DATA
    public function editJumlahKeranjang($id_user, $id_menu, $data)
    {
        $this->db->where('id_user', $id_user);
        $this->db->where('id_menu', $id_menu);
        $this->db->update('keranjang', $data);
    }

    public function editKeranjang($id_keranjang, $data)
    {
        $this->db->where('id_keranjang', $id_keranjang)->update('keranjang', $data);
    }

    public function editTransaksi($id_transaksi, $data)
    {
        $this->db->where('id_transaksi', $id_transaksi)->update('transaksi', $data);
    }

    public function editStatusPembayaran($id_pemesanan, $status)
    {
        $this->db->where('id_pemesanan', $id_pemesanan);
        $this->db->update('pemesanan', ['status_pembayaran' => $status]);
    }

    public function editProfile($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('user', $data);
    }



    // HAPUS DATA
    public function hapusItemKeranjang($id_keranjang)
    {
        $this->db->delete('keranjang', ['id_user' => $id_keranjang]);
        $this->db->delete('keranjang', ['id_menu' => $id_keranjang]);
        $this->db->delete('keranjang', ['id_keranjang' => $id_keranjang]);
    }

    public function hapusKeranjang($id_user)
    {
        $this->db->delete('keranjang', ['id_user' => $id_user]);
    }

    public function hapusPemesanan($id_pemesanan)
    {
        $this->db->delete('transaksi', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('detail_pemesanan', ['id_pemesanan' => $id_pemesanan]);
        $this->db->delete('pemesanan', ['id_pemesanan' => $id_pemesanan]);
    }
}

/* End of file Model_user.php */
