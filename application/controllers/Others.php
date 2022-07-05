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

    public function tambahMotor()
    {
        $this->others->insertMotor();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Motor Pelanggan ditambah! </div>');
        redirect('others/pelanggan');

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

    //insert mekanik
    public function mekanik()
    {
        $data['title'] = 'Mekanik';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'others/mekanik';
        $data['mekanik'] = $this->others->getAllMekanik();

        // $id = $_POST['id'];
        // $data['current_pelanggan'] = $this->others->getPelanggan($id);

        $this->form_validation->set_rules('mekanik', 'Mekanik', "required", [
            'required' => 'Nama mekanik wajib diisi',
        ]);
        $this->form_validation->set_rules('no_mekanik', 'Nomor', "required", [
            'required' => 'Nomor mekanik wajib diisi',
        ]);
        $this->form_validation->set_rules('alamat_mekanik', 'Alamat', "required", [
            'required' => 'Alamat mekanik wajib diisi',
        ]);
        $this->form_validation->set_rules('persentase_ongkos', 'persentase_ongkos', "required", [
            'required' => 'Persentase Ongkos Mekanik wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->others->insertMekanik();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Mekanik baru ditambah </div>');
            redirect('others/mekanik');
        }
    }

    public function getUbahMekanik()
    {
        $id = $_POST['id'];
        echo json_encode($this->others->getMekanik($id));
    }

    public function ubahMekanik()
    {
        $id = $_POST['id'];
        $this->others->editMekanik($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Mekanik diubah! </div>');
        redirect('others/mekanik');
    }
    public function hapusMekanik($id)
    {
        $this->others->deleteMekanik($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Data Mekanik terhapus </div>');
        redirect('others/mekanik');
    }

}