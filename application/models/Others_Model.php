<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Others_Model extends CI_Model
{
    public function getAllPelanggan()
    {
        $query = "SELECT * FROM PELANGGAN";
        return $this->db->query($query)->result_array;
    }
}