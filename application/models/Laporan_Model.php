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
        $query = "SELECT `penjualan`.*, `pelanggan`.`nama` as pelanggan, `mekanik`.`nama` as mekanik,
                 `motor_pelanggan`.`jenis` as motor,`motor_pelanggan`.`plat_nomor` as plat
                  FROM penjualan JOIN pelanggan ON `penjualan`.`id_pelanggan` = `pelanggan`.`id`
                  JOIN mekanik ON `penjualan`.`id_mekanik` = `mekanik`.`id`
                  JOIN motor_pelanggan ON `penjualan`.`id_motor` = `motor_pelanggan`.`id`
                  WHERE `penjualan`.`id` = $id
                  ";
        return $this->db->query($query)->row();
    }

    public function detailPenjualanProduk($id)
    {
        $this->db->where('id_penjualan', $id);
        return $this->db->get('penjualan_produk')->result();
    }

    public function historyPenjualanProduk()
    {
        $query = "SELECT p.`id_penjualan`,p.`id_produk`, sum(p.`jumlah`) as jumlah_produk from penjualan_produk p group by id_produk & id_penjualan ";
        return $this->db->query($query)->result();
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
        $query = "SELECT `mekanik`.`nama` as mekanik_produktif, `mekanik`.`id`, MAX(`penjualan`.`id_mekanik`) as mekanik from mekanik join penjualan 
                ON `penjualan`.`id_mekanik` = `mekanik`.`id`";
        return $this->db->query($query)->row();
    }

    public function totalOngkos()
    {
        $query = "SELECT SUM(`penjualan`.`ongkos`) as total_ongkos FROM penjualan";
        return $this->db->query($query)->row();
    }

    public function totalService()
    {
        $query = "SELECT COUNT(`penjualan`.`id_mekanik`) as total_service FROM penjualan";
        return $this->db->query($query)->row();
    }
}
