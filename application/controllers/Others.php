<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Others extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('Others_Model', 'others');
    }

    //insert pelanggan
    public function pelanggan()
    {
        $data['title'] = 'Pelanggan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'others/pelanggan';

        $data['pelanggan'] = $this->others->getAllPelanggan();

        // $id = $_POST['id'];
        // $data['current_pelanggan'] = $this->others->getPelanggan($id);

        $this->form_validation->set_rules('pelanggan', 'Pelanggan', "required", [
            'required' => 'Nama pelanggan wajib diisi',
        ]);
        $this->form_validation->set_rules('no_pelanggan', 'Nomor', "required", [
            'required' => 'Nomor pelanggan wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->others->insertPelanggan();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Pelanggan baru ditambah </div>');
            redirect('others/pelanggan');
        }

    }

    //UBAH Supplier
    public function getUbahPelanggan()
    {
        $id = $_POST['id'];
        echo json_encode($this->others->getPelanggan($id));
    }

    public function ubahPelanggan()
    {
        $id = $_POST['id'];
        $this->others->editPelanggan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Pelanggan diubah! </div>');
        redirect('others/pelanggan');
    }

    public function hapusPelanggan($id)
    {
        $this->others->deletePelanggan($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Data Pelanggan terhapus </div>');
        redirect('others/pelanggan');
    }
}