<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();

        $this->load->model('Penjualan_Model','penjualan');
    }


    public function kasir(){
        $data['title'] = 'Kasir';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'penjualan/kasir';
        $this->load->view('layout', $data);
    }
}