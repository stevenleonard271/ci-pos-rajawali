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
        $query = "SELECT `penjualan`.*, `pelanggan`.`nama` as pelanggan, `mekanik`.`nama` as mekanik, `motor_pelanggan`.`jenis` as motor,  
                  `motor_pelanggan`.`plat_nomor` as plat
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

    public function totalOngkos($id_mekanik)
    {
        $query = "SELECT SUM(ongkos) as total_ongkos from penjualan WHERE id_mekanik = $id_mekanik;";
        return $this->db->query($query)->row();
    }

    public function totalService($id_mekanik)
    {
        $query = "SELECT COUNT(id_mekanik) as total_service from penjualan WHERE id_mekanik = $id_mekanik";
        return $this->db->query($query)->row();
    }

    public function ongkosMekanik()
    {
        $query = "SELECT `mekanik`.*, SUM(`penjualan`.`ongkos`) as total_ongkos, COUNT(`penjualan`.`id_mekanik`) as total_service from mekanik RIGHT JOIN penjualan
        ON `penjualan`.`id_mekanik` = `mekanik`.`id`
        GROUP BY `mekanik`.`id`;";
        return $this->db->query($query)->result_array();
    }

    public function mekanikProduktif()
    {
    }
}
