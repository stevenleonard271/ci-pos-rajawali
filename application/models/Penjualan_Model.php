<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_Model extends CI_Model
{
    public function countPenjualan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $query = "SELECT `penjualan`.`created_at`,COUNT(`penjualan`.`id`) as jumlah_penjualan
                  FROM `penjualan`WHERE `penjualan`.`created_at` = '$today'";

        return $this->db->query($query)->row();
    }

    public function insertCart()
    {
        $data = [
            'id_produk' => $this->input->post('sparepart', true),
            'jumlah' => $this->input->post('jumlah', true),
            'id_pelanggan' => $this->input->post('pelanggan', true)
        ];

        $this->db->insert('cart_penjualan', $data);
    }

    public function deleteCart($id_produk, $id_pelanggan)
    {
        $data = [
            'id_produk' => $id_produk,
            'id_pelanggan' => $id_pelanggan
        ];

        $this->db->where($data);
        $this->db->delete('cart_penjualan');
    }

    public function viewCart($id_pelanggan)
    {
        $this->db->where("id_pelanggan", $id_pelanggan);
        return $this->db->get("view_cart");
    }
}
