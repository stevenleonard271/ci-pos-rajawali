<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('Produk_model', 'produk');
        $this->load->model('Others_Model', 'others');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'admin/index';
        $data['produkKritis'] = $this->produk->runningOutProduk();
        $data['pelanggan'] = $this->others->countAllPelanggan();

        $this->load->view('layout', $data);
    }

    //GET AND INSERT TO MANAJEMEN USER
    public function role()
    {
        $data['title'] = 'Manajemen User';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $data['content'] = 'admin/role';

        $this->form_validation->set_rules('role', 'User', "required", [
            'required' => 'User wajib diisi',
        ]);

        //Insert data ke table user_role
        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->db->insert('user_role', [
                'role' => $this->input->post('role'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User baru ditambah </div>');
            redirect('admin/role');
        }
    }
    //HAPUS SUBMENU BY MODEL
    public function hapusRole($id)
    {
        $this->load->model('Role_model', "role");
        $this->role->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
     User terhapus! </div>');
        redirect('admin/role');
    }

    //UBAH ROLE
    public function getUbahRole()
    {
        $id = $_POST['id'];
        $this->load->model('Role_model', 'role');
        echo json_encode($this->role->getRole($id));
    }

    public function ubahRole()
    {
        $id = $_POST['id'];
        $this->load->model('Role_model', 'role');
        $this->role->editRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          User diedit! </div>');
        redirect('admin/role');
    }

    //GET ROLE ACCESS BY ID
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $data['content'] = 'admin/role-access';

        $this->db->where('id!=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('layout', $data);
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            //role_id dan menu_id => salah satu field di database
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Akses diubah! </div>');
    }
}
