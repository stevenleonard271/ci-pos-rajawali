<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();

        $this->load->model('Penjualan_Model', 'penjualan');
        $this->load->model('Others_Model', 'others');
        $this->load->model('Laporan_Model', 'laporan');
        $this->load->model('Produk_model', 'produk');
    }

    public function penjualan()
    {
        $data['title'] = 'Penjualan';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['content'] = 'laporan/penjualan';
        $data['penjualan'] = $this->laporan->tampilPenjualan();
        $this->load->view('layout', $data);
    }

    public function detailPenjualan()
    {
    }
}
