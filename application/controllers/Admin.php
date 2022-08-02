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
        $this->load->model('Role_Model', 'role');
        $this->load->model('Inventori_Model', 'inventori');
        $this->load->model('Laporan_Model', 'laporan');
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
        $data['totalOngkos'] = $this->laporan->totalOngkos()->total_ongkos;
        $data['totalOrder'] = $this->inventori->countOrder()->jumlah_stokmasuk;

        $this->load->view('layout', $data);
    }

    //GET AND INSERT TO MANAJEMEN USER
    public function role()
    {
        $data['title'] = 'Manajemen Role';
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
            Role baru ditambah </div>');
            redirect('admin/role');
        }
    }

    public function users(){
        $data['title'] = 'Manajemen User';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();
        $data['users'] = $this->role->usersList();
        $data['role'] = $this->db->get('user_role')->result_array();
        $data['content'] = 'admin/users';

        $this->form_validation->set_rules('nama', 'User', "required", [
            'required' => 'Nama User wajib diisi',
        ]);
        $this->form_validation->set_rules('email', 'User', "required", [
            'required' => 'Email User wajib diisi',
        ]);
        $this->form_validation->set_rules('password', 'User', "required", [
            'required' => 'Password User wajib diisi',
        ]);
        $this->form_validation->set_rules('role', 'User', "required", [
            'required' => 'Role User wajib diisi',
        ]);

        if($this->form_validation->run()==false){ 
            $this->load->view('layout', $data);
        } else{
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'foto' => 'default.jpg',
                'role_id' => htmlspecialchars($this->input->post('role', true)),
                'created_at' => time(),
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            User baru ditambah </div>');
            redirect('admin/users');
        }
    }

    public function hapusUser($id){
     $this->role->deleteUser($id);
     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
     User terhapus! </div>');
     redirect('admin/users');
    }

    public function getUbahUser(){
        $id = $_POST['id'];
        echo json_encode($this->role->getUser($id));
        
    }

    public function ubahUser(){
        $id = $_POST['id'];
        $this->role->editUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        User diedit! </div>');
      redirect('admin/users');

    }

    //HAPUS SUBMENU BY MODEL
    public function hapusRole($id)
    {
        $this->role->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
     Role terhapus! </div>');
        redirect('admin/role');
    }

    //UBAH ROLE
    public function getUbahRole()
    {
        $id = $_POST['id'];
        echo json_encode($this->role->getRole($id));
    }

    public function ubahRole()
    {
        $id = $_POST['id'];
        $this->load->model('Role_model', 'role');
        $this->role->editRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          Role diedit! </div>');
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