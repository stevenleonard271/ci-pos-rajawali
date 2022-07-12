<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_Model extends CI_Model
{
    public function countPenjualan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $query = "SELECT `stok_masuk`.`created_at`,COUNT(`stok_masuk`.`id`) as jumlah_stokmasuk
                  FROM `stok_masuk`WHERE `stok_masuk`.`created_at` = '$today'";

        return $this->db->query($query)->row();
    }
}
