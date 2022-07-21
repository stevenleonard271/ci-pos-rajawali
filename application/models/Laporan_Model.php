<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_Model extends CI_Model
{

    public function tampilPenjualan()
    {
        $query = "SELECT `penjualan`.*, `pelanggan`.`nama` as pelanggan FROM `penjualan`
                 JOIN `pelanggan` ON `penjualan`.`id_pelanggan` = `pelanggan`.`id`
        ";
        return $this->db->query($query)->result();
    }

    public function detailPenjualan($id)
    {
        $query = "SELECT `penjualan`.*, `pelanggan`.`nama` as pelanggan, `mekanik`.`nama` as mekanik, `motor_pelanggan`.`jenis` as motor 
                  FROM `penjualan`JOIN `pelanggan` ON `penjualan`.`id_pelanggan` = `pelanggan`.`id` 
                  JOIN `mekanik` ON `penjualan`.`id_mekanik` = `mekanik`.`id`
                  JOIN `motor_pelanggan` ON `penjualan`.`id_motor` = `motor_pelanggan`.`id`
                  WHERE `penjualan`.`id` = $id
                  ";
        return $this->db->query($query)->row();
    }

    public function detailPenjualanProduk($id)
    {
        $this->db->where('id_penjualan', $id);
        return $this->db->get('penjualan_produk')->result();
    }
}
