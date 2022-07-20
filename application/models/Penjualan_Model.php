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

    public function deleteCart($id)
    {
        // dd($id);
        $this->db->where('id', $id);
        $this->db->delete('cart_penjualan');
    }

    public function viewCart($id_pelanggan)
    {
        $this->db->where("id_pelanggan", $id_pelanggan);
        return $this->db->get("view_cart");
    }

    public function insertPenjualan()
    {
        //insert form to penjualan
        $data = [
            'no_penjualan' => $this->input->post('no_penjualan', true),
            'tanggal_penjualan' => $this->input->post('tgl_penjualan', true),
            'kasir' => $this->input->post('kasir', true),
            'id_pelanggan' => $this->input->post('pelanggan', true),
            'id_motor' => $this->input->post('motor', true),
            'id_mekanik' => $this->input->post('mekanik', true),
            'ongkos' => $this->input->post('biaya_servis', true),
            'sub_total' => $this->input->post('subtotal', true),
            'grand_total' => $this->input->post('grandtotal', true),
            'diskon' => $this->input->post('diskon', true),
            'keterangan' => $this->input->post('keterangan', true),
        ];
        $this->db->insert('penjualan', $data);

        $id_pelanggan = $this->input->post('pelanggan');
        $id_penjualan = $this->db->get_where('penjualan', ['no_penjualan' => $this->input->post('no_penjualan', true),])->row()->id;
        $cart_penjualan = $this->db->get_where('cart_penjualan', ['id_pelanggan' => $id_pelanggan])->result();

        // insert data from cart penjualan to penjualan_produk
        foreach ($cart_penjualan as $cart => $val) :
            $data = [
                'id_penjualan' => $id_penjualan,
                'id_produk' => $val->id_produk,
                'id_pelanggan' => $val->id_pelanggan,
                'jumlah' => $val->jumlah,
            ];
            $this->db->insert('penjualan_produk', $data);
        endforeach;

        // delete data from cart penjualan
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('cart_penjualan');
    }
}
