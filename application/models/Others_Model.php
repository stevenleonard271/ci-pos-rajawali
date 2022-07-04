<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Others_Model extends CI_Model
{
    public function getAllPelanggan()
    {
        // $query = "SELECT `pelanggan`.* FROM `pelanggan`";
        // return $this->db->query($query)->result_array;

        return $this->db->get('pelanggan')->result_array();
    }

    public function insertPelanggan()
    {
        $data = [
            'nama' => $this->input->post('pelanggan', true),
            'nomor' => $this->input->post('no_pelanggan', true),
        ];

        $this->db->insert('pelanggan', $data);
    }

    public function getPelanggan($id)
    {
        return $this->db->get_where('pelanggan', ['id' => $id])->row_array();
    }

    public function editPelanggan($id)
    {
        date_default_timezone_set('Asia/Jakarta');

        $data = [
            'nama' => $this->input->post('pelanggan', true),
            'nomor' => $this->input->post('no_pelanggan', true),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->where('id', $id);
        $this->db->update('pelanggan', $data);
    }

    public function deletePelanggan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pelanggan');
    }

}