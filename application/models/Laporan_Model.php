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
                  LEFT JOIN motor_pelanggan ON `penjualan`.`id_motor` = `motor_pelanggan`.`id`
                  WHERE `penjualan`.`id` = $id
                  ";
        return $this->db->query($query)->row();
    }

    public function detailPenjualanProduk($id)
    {
        $this->db->where('id_penjualan', $id);
        return $this->db->get('penjualan_produk')->result();
    }

    public function historyPenjualanProduk($idProduk, $tglPeramalan)
    {
        $query = "SELECT monthname(pj.`tanggal_penjualan`) as bulan, year(pj.`tanggal_penjualan`) as tahun ,p.`id_produk`, sum(p.`jumlah`) as jumlah_produk 
                  FROM penjualan_produk p join penjualan pj 
                  ON p.id_penjualan = pj.id
                  WHERE month(tanggal_penjualan) <  month('$tglPeramalan')
                  AND year(tanggal_penjualan) <=  year('$tglPeramalan')
                  AND p.`id_produk` = $idProduk 
                  GROUP BY month(tanggal_penjualan), year(tanggal_penjualan)";

        return $this->db->query($query);
    }

    public function forecastMonth($tglPeramalan)
    {
        $query = "SELECT monthname('$tglPeramalan') as forecast, 
                 '$tglPeramalan' as tanggal_peramalan,
                  year('$tglPeramalan') as tahun";
        return $this->db->query($query)->row();
    }

    public function insertPeramalan($row = "")
    {
        if ($row == "") {
            $data = [
                'id_produk' => $this->input->post('produk'),
                'tanggal' => $this->input->post('tanggal'),
                'hasil' => $this->input->post('hasil'),
                'mape' => $this->input->post('mape'),
            ];
        } else {
            $data = $row;
        }
        $this->db->insert('peramalan', $data);
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