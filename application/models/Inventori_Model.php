<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori_Model extends CI_Model
{

    //GET Supplier BY ID
    public function getSupplier($id)
    {
        // echo $_POST[$id];
        // $query = "SELECT * FROM `user_menu` WHERE `id` ='.$id";

        return $this->db->get_where('supplier', ['id' => $id])->row_array();
    }

    //EDIT Supplier
    public function editSupplier()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nomor" => $this->input->post('nomor', true),
            "deskripsi" => $this->input->post('deskripsi', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('supplier', $data);
    }

    //DELETE Supplier
    public function deleteSupplier($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplier');
    }

    public function insertStokMasuk()
    {
        $data = [
            'id_supplier' => $this->input->post('supplier', true),
            'tanggal_pembelian' => $this->input->post('tgl_beli', true),
            'status' => $this->input->post('status', true),
            'no_pembelian' => $this->input->post('no_pembelian', true),
            'catatan_pembelian' => $this->input->post('catatan', true),
        ];
        // dd($data);
        $this->db->insert('stok_masuk', $data);

    }

    public function getAllStokMasuk()
    {
        $query = "SELECT `stok_masuk`.*, `supplier`.`nama` as nama_supplier
                  FROM stok_masuk JOIN supplier
                  ON `stok_masuk`.`id` = `supplier`.`id`
                  ORDER BY `stok_masuk`.`no_pembelian` ASC
         ";
        return $this->db->query($query)->result_array();
    }
    public function countStokMasuk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        // dd($today);

        $query = "SELECT `stok_masuk`.`created_at`,COUNT(`stok_masuk`.`id`) as jumlah_stokmasuk
                  FROM `stok_masuk`WHERE `stok_masuk`.`created_at` = '$today'";

        // $query = "SELECT `stok_masuk`.`created_at`
        //           FROM `stok_masuk`";

        return $this->db->query($query)->row();

    }

    public function getStokMasuk($id)
    {

    }

}