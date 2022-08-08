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

    public function detailPenjualan($id)
    {

        $data['title'] = 'Penjualan';
        $data['subtitle'] = "Detail Penjualan";
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['content'] = 'laporan/detail_penjualan';
        $data['detailPenjualan'] = $this->laporan->detailPenjualan($id);
        $data['penjualan_produk'] = $this->laporan->detailPenjualanProduk($id);
        $data['produk'] = $this->produk->getAllProduk();

        $this->load->view('layout', $data);
    }

    public function ongkos()
    {
        $data['title'] = 'Ongkos';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['content'] = 'laporan/ongkos';
        // $data['mekanik'] = $this->others->getAllMekanik();
        // $data['totalOngkos'] = $this->laporan->totalOngkos(2);
        // $data['totalServis'] = $this->laporan->totalService(2);
        $data['mekanik'] = $this->laporan->ongkosMekanik();
        $data['totalOngkos'] = $this->laporan->totalOngkos()->total_ongkos;
        $data['totalService'] = $this->laporan->totalService()->total_service;
        $data['mekanikProduktif'] = $this->laporan->mekanikProduktif()->mekanik_produktif;
        $this->load->view('layout', $data);
    }

    public function peramalan()
    {
        $data['title'] = 'Peramalan Pembelian';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['content'] = 'laporan/peramalan';
        $data['produk'] = $this->produk->getAllProduk();
        $this->load->view('layout', $data);
    }

    public function riwayatPenjualan()
    {
        $post = $this->input->post();
        $histo = $this->laporan->historyPenjualanProduk($post['sparepart'], $post['tgl_ramal']);

        $str = "";
        if($histo->num_rows() > 0){
            $histo = $histo->result();
            foreach($histo as $hs){
                $str .= '
                <tr>
                    <th scope="row">'.$hs->bulan.'</th>
                    <td>'.$hs->jumlah_produk.'</td>
                </tr>
            ';
            }
        } else{
            $str .= '
            <tr>
                <td colspan="6" class="text-center"><b>Data Penjualan tidak ditemukan</b></td>
            </tr>
            ';
        }
        echo $str;
    }

    public function hasilPeramalan(){
        $post = $this->input->post();
        
        $data['title'] = "Peramalan Pembelian";
        $data['subtitle'] = "Perhitungan Peramalan Pembelian";
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        $data['histo'] = $this->laporan->historyPenjualanProduk($post['sparepart'], $post['tgl_peramalan'])->result();
        $data['forcast'] = $this->laporan->forecastMonth($post['tgl_peramalan']);
        // $data['moving_average'] = $post['moving_average'];
        $data['produk'] = $this->produk->getProduk($post['sparepart']);
        // dd($data['forcast']);
        // $data['riwayatPenjualan'] = $this->laporan->historyPenjualanProduk($tanggalPeramalan);
        $data['content'] = 'laporan/hasil_peramalan';


        
        $this->load->view('layout', $data);
    }


}