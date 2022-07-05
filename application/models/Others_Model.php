<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Others_Model extends CI_Model
{
    public function getAllPelanggan()
    {

        $query = "SELECT `pelanggan`.*,COUNT(`motor_pelanggan`.`id_pelanggan`) as `jumlah_motor`
      FROM `pelanggan` LEFT JOIN `motor_pelanggan`
        ON `motor_pelanggan`.`id_pelanggan` = `pelanggan`.`id`
        GROUP BY `id_pelanggan`
        ORDER BY `jumlah_motor` DESC
";
        return $this->db->query($query)->result_array();
        // return $this->db->get('pelanggan')->result_array();
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

    public function insertMotor()
    {
        $data = [
            'id_pelanggan' => $this->input->post('id_pelanggan', true),
            'jenis' => $this->input->post('jenis_motor', true),
            'plat_nomor' => $this->input->post('plat_nomor', true),
        ];
        $this->db->insert('motor_pelanggan', $data);
    }

    public function getAllMekanik()
    {
        return $this->db->get('mekanik')->result_array();
    }

    public function insertMekanik()
    {
        $data = [
            'nama' => $this->input->post('mekanik', true),
            'nomor' => $this->input->post('no_mekanik', true),
            'alamat' => $this->input->post('alamat_mekanik', true),
            'persentase_ongkos' => $this->input->post('persentase_ongkos', true),
        ];
        $this->db->insert('mekanik', $data);
    }

    public function getMekanik($id)
    {
        return $this->db->get_where('mekanik', ['id' => $id])->row_array();
    }

    public function editMekanik($id)
    {
        $data = [
            'nama' => $this->input->post('mekanik', true),
            'nomor' => $this->input->post('no_mekanik', true),
            'alamat' => $this->input->post('alamat_mekanik', true),
            'persentase_ongkos' => $this->input->post('persentase_ongkos', true),
        ];
        $this->db->where('id', $id);
        $this->db->update('mekanik', $data);
    }
    
     public function deleteMekanik($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mekanik');
    }


}