<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    //GET MENU BY ID
    public function getMenu($id)
    {
        // echo $_POST[$id];
        // $query = "SELECT * FROM `user_menu` WHERE `id` ='.$id";

        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    //EDIT MENU
    public function editMenu()
    {
        $data = [
            "menu" => $this->input->post('menu', true),
            "urutan" => $this->input->post('urutan', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    //DELETE MENU
    public function deleteMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    // GET ALL SUBMENU
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                 FROM `user_sub_menu` JOIN `user_menu`
                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`

        ";
        return $this->db->query($query)->result_array();
    }

    //Count SubMenu
    public function countSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                 FROM `user_sub_menu` JOIN `user_menu`
                 ON `user_sub_menu`.`menu_id` = `user_menu`.`id`

        ";
        return $this->db->query($query)->num_rows();
    }

    //GET SUBMENU BY ID TO EDIT
    public function getSubMenuById($id)
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        WHERE `user_sub_menu`.`id`= $id
        ";

        return $this->db->query($query)->row_array();
    }

    //EDIT SUBMENU
    public function editSubMenu()
    {
        $data = [
            "judul" => $this->input->post('title', true),
            "url" => $this->input->post('url', true),
            'menu_id' => $this->input->post('menu_id', true),
            "icon" => $this->input->post('icon', true),
            "is_active" => $this->input->post('is_active', true),

        ];

        // dd($data['is_active']);
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    //DELETE SUBMENU
    public function deleteSubMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

}