<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    //EDIT ROLE

    public function getRole($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    //EDIT MENU
    public function editRole()
    {
        $data = [
            "role" => $this->input->post('role', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_role', $data);
    }

    //DELETE ROLE
    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }
}