<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    //GET and INSERT MENU
    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $queryMenuSelect = "SELECT * from user_menu ORDER BY urutan  ASC";
        $data['menu'] = $this->db->query($queryMenuSelect)->result_array();
        $data['content'] = 'menu/index';

        $this->form_validation->set_rules('menu', 'Menu', "required", [
            'required' => 'Menu wajib diisi',
        ]);

        //Insert data ke table user_menu
        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->db->insert('user_menu', [
                'menu' => $this->input->post('menu'),
                'urutan' => $this->input->post('urutan'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu baru ditambah </div>');
            redirect('menu');

        }
    }

    //HAPUS MENU
    public function hapusMenu($id)
    {
        $this->load->model('Menu_model', "menu");
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Menu terhapus </div>');
        redirect('menu');
    }

    //UBAH MENU
    public function getUbahMenu()
    {
        $id = $_POST['id'];
        $this->load->model('Menu_model', 'menu');
        echo json_encode($this->menu->getMenu($id));
    }

    public function ubahMenu()
    {
        $id = $_POST['id'];
        $this->load->model('Menu_model', 'menu');
        $this->menu->editMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu diubah! </div>');
        redirect('menu');
    }

    //GET AND INSERT SUBMENU

    public function submenu()
    {
        $data['title'] = "Submenu Management";
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();
        $data['content'] = 'menu/submenu';

        $this->load->model('Menu_model', "menu");

        $this->form_validation->set_rules('title', 'Judul', "required", [
            'required' => 'Judul wajib diisi',
        ]);
        $this->form_validation->set_rules('menu_id', 'Menu', "required", [
            'required' => 'Menu wajib diisi',
        ]);
        $this->form_validation->set_rules('url', 'Url', "required", [
            'required' => 'Url wajib diisi',
        ]);
        $this->form_validation->set_rules('icon', 'Icon', "required", [
            'required' => 'Icon wajib diisi',
        ]);

        //PAGINATION CONFIG
        // $this->load->library('pagination');

        //configuration
        // $config['base_url'] = 'http://localhost/pos-rajawali/menu/submenu';
        // $config['total_rows'] = $this->menu->countSubMenu();
        // $config['per_page'] = 5;
        // $config['num_links'] = 5;

        //initialize
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $data['subMenu'] = $this->menu->getSubMenu();
        // $data['start'] = $this->uri->segment(3);
        // $data['subMenu'] = $this->menu->getSubMenuPagination($config['per_page'], $data['start']);
        // $this->pagination->initialize($config);

        if ($this->form_validation->run() == false) {

            $this->load->view('layout', $data);
        } else {

            $data = [
                'judul' => htmlspecialchars($this->input->post('title', true)),
                'menu_id' => htmlspecialchars($this->input->post('menu_id', true)),
                'url' => htmlspecialchars($this->input->post('url', true)),
                'icon' => htmlspecialchars($this->input->post('icon', true)),
                'is_active' => htmlspecialchars($this->input->post('is_active', true)),

            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Submenu baru ditambahkan </div>');
            redirect('menu/submenu');

        }

    }

    //GET SUBMENU BY MODEL
    public function getUbahSubMenu()
    {
        // echo "Tampil";
        $id = $_POST['id'];

        $this->load->model('Menu_model', 'submenu');
        echo json_encode($this->submenu->getSubMenuById($id));
    }

    //EDIT SUBMENU BY MODEL

    public function ubahSubMenu()
    {
        $id = $_POST['id'];
        $this->load->model('Menu_model', 'submenu');
        $this->submenu->editSubMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        SubMenu diubah! </div>');
        redirect('menu/submenu');
    }

    //HAPUS SUBMENU BY MODEL
    public function hapusSubMenu($id)
    {
        $this->load->model('Menu_model', "menu");
        $this->menu->deleteSubMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        SubMenu dihapus! </div>');
        redirect('menu/submenu');
    }

}