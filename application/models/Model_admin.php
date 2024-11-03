<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_admin extends CI_Model
{
    // GET TOTAL DATA
    public function getTotalMenu()
    {
        return $this->db->count_all('menu');
    }

    public function getTotalTransaksi()
    {
        return $this->db->count_all('transaksi');
    }

    public function getTotalReseller()
    {
        $this->db->where('id_role', 2);
        $this->db->where('status', 'aktif');
        return $this->db->count_all_results('user');
    }




    // KATEGORI
    public function getAllKategori()
    {
        return $this->db->order_by('jenis_kategori', 'ASC')->get('kategori')->result_array();
    }

    public function tambahKategori($data)
    {
        $this->db->insert('kategori', $data);
    }

    public function editKategori($id_kategori, $data)
    {
        $this->db->where('id_kategori', $id_kategori)->update('kategori', $data);
    }


    // MENU
    public function getMenuById($id_menu)
    {
        return $this->db->get_where('menu', ['id_menu' => $id_menu])->row_array();
    }

    public function getAllMenu()
    {
        $this->db->join('kategori AS k', 'k.id_kategori = m.id_kategori', 'INNER');
        return $this->db->get('menu AS m')->result_array();
    }

    public function tambahMenu($data)
    {
        $this->db->insert('menu', $data);
    }

    public function editMenu($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu)->update('menu', $data);
    }


    // TRANSAKSI
    public function getAllTransaksi()
    {
        $this->db->order_by('id_pemesanan', 'DESC');
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('pemesanan AS p')->result_array();
    }

    public function editTransaksi($id_pemesanan, $data)
    {
        $this->db->where('id_pemesanan', $id_pemesanan)->update('pemesanan', $data);
    }

    public function getPemesanan($id_pemesanan)
    {
        $this->db->where('p.id_pemesanan', $id_pemesanan);
        $this->db->join('transaksi AS t', 't.id_pemesanan = p.id_pemesanan', 'LEFT');
        $this->db->join('detail_pemesanan AS dp', 'dp.id_pemesanan = p.id_pemesanan', 'INNER');
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('pemesanan AS p')->row_array();
    }

    public function getDetailPemesanan($id_pemesanan)
    {
        $this->db->where('dp.id_pemesanan', $id_pemesanan);
        $this->db->join('pemesanan AS p', 'p.id_pemesanan = dp.id_pemesanan', 'INNER');
        $this->db->join('menu AS m', 'm.id_menu = dp.id_menu', 'INNER');
        return $this->db->get('detail_pemesanan AS dp')->result_array();
    }

    public function kurangiStokMenu($id_menu, $jumlah)
    {
        $this->db->set('stok', 'stok - ' . (int)$jumlah, FALSE);
        $this->db->where('id_menu', $id_menu);
        $this->db->update('menu');
    }



    // LAPORAN
    public function getAllLaporan()
    {
        $this->db->order_by('id_pemesanan', 'DESC');
        $this->db->where('status_pengiriman', 'Dikirim');
        $this->db->where('status_pembayaran', 'Diterima');
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        return $this->db->get('pemesanan AS p')->result_array();
    }

    public function filterLaporanPdf($tanggal_awal, $tanggal_akhir)
    {
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('tanggal_pemesanan >=', $tanggal_awal);
        $this->db->where('tanggal_pemesanan <=', $tanggal_akhir . ' 23:59:59');
        $this->db->where('p.status_pengiriman', 'Dikirim');
        $this->db->where('p.status_pembayaran', 'Diterima');
        $this->db->group_by('p.kode_pemesanan');
        $transaksi = $this->db->get('pemesanan AS p')->result_array();

        return $transaksi;
    }

    public function filterLaporanExcel($tanggal_awal, $tanggal_akhir)
    {
        // $this->db->join('tbl_transaksi AS t', 't.kode_pesanan = p.kode_pesanan', 'LEFT');
        $this->db->join('user AS u', 'u.id_user = p.id_user', 'INNER');
        $this->db->where('tanggal_pemesanan >=', $tanggal_awal);
        $this->db->where('tanggal_pemesanan <=', $tanggal_akhir . ' 23:59:59');
        $this->db->where('p.status_pengiriman', 'Dikirim');
        $this->db->where('p.status_pembayaran', 'Diterima');
        return $this->db->get('pemesanan AS p')->result_array();
    }



    // REGISTRASI
    public function getAllRegistrasi()
    {
        $this->db->join('transaksi_pendaftaran AS tp', 'u.id_user = tp.id_user', 'INNER');
        return $this->db->get('user AS u')->result_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('user', ['id_user' => $id_user])->row();
    }

    public function editRegistrasi($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('user', $data);
    }



    // PROFILE
    public function getProfileByIdUser($id_user)
    {
        $this->db->where('u.id_user', $id_user);
        $this->db->join('role AS r', 'r.id_role = u.id_role', 'INNER');
        return $this->db->get('user AS u')->row_array();
    }

    public function editProfile($id_user, $data)
    {
        $this->db->where('id_user', $id_user)->update('user', $data);
    }
}

/* End of file Model_admin.php */
