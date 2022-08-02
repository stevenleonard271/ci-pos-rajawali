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

    public function usersList(){
        $query = "SELECT `user`.*, `user_role`.`role` FROM `user` JOIN `user_role` ON `user`.`role_id` = `user_role`.`id` ";
        return $this->db->query($query)->result_array();
        
    }

    public function getUser($id){
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

     //EDIT MENU
     public function editUser()
     {
         $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'role_id' => htmlspecialchars($this->input->post('role', true)),
         ];
         $this->db->where('id', $this->input->post('id'));
         $this->db->update('user', $data);
     }

    public function deleteUser($id){
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}