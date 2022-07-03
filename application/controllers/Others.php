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

    public function pelanggan()
    {
        $data['title'] = 'Pelanggan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'others/pelanggan';

        $data['pelanggan'] = $this->others->getAllPelanggan();

        $this->load->view('layout', $data);
    }
}