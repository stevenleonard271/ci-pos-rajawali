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
        $this->load->model('Inventori_model', 'inventori');
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
        if ($histo->num_rows() > 0) {
            $histo = $histo->result();
            foreach ($histo as $hs) {
                $str .= '
                <tr>
                    <th scope="row">' . $hs->bulan . '</th>
                    <th scope="row">' . $hs->tahun . '</th>
                    <td>' . $hs->jumlah_produk . '</td>
                </tr>
            ';
            }
        } else {
            $str .= '
            <tr>
                <td colspan="6" class="text-center"><b>Data Penjualan tidak ditemukan</b></td>
            </tr>
            ';
        }
        echo $str;
    }

    public function hasilPeramalan()
    {
        $post = $this->input->post();

        $data['title'] = "Peramalan Pembelian";
        $data['subtitle'] = "Perhitungan Peramalan Pembelian";
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();
        // $data['requiredData'] = $this->inventori->
        $data['perhitunganSma'] = $this->inventori->perhitunganSMA($post['sparepart'], $post['tgl_peramalan'], 3);
        $data['mapeTiga'] = $this->inventori->mape;
        $data['perhitunganSmaEmpat'] = $this->inventori->perhitunganSMA($post['sparepart'], $post['tgl_peramalan'], 4);
        $data['mapeEmpat'] = $this->inventori->mape;
        $data['perhitunganSmaLima'] = $this->inventori->perhitunganSMA($post['sparepart'], $post['tgl_peramalan'], 5);
        $data['mapeLima'] = $this->inventori->mape;

        //inisialisasi default hasil 0
        $maTiga = [
            'ma' => 3,
            'hasil' => $data['perhitunganSma'] != null ? end($data['perhitunganSma'])['Peramalan'] : 0,
            'mape' => $data['mapeTiga']
        ];
        $maEmpat = [
            'ma' => 4,
            'hasil' => $data['perhitunganSmaEmpat'] != null ? end($data['perhitunganSmaEmpat'])['Peramalan'] : 0,
            'mape' => $data['mapeEmpat']
        ];
        $maLima = [
            'ma' => 5,
            'hasil' => $data['perhitunganSmaLima'] != null ? end($data['perhitunganSmaEmpat'])['Peramalan'] : 0,
            'mape' => $data['mapeLima']
        ];

        //Membandingkan mape terkecil untuk dijadikan kesimpulan
        if ($maTiga['mape'] <= $maEmpat['mape'] && $maTiga['mape'] <= $maLima['mape']) {
            $bestForecast = $maTiga['hasil'];
            $bestMoving = $maTiga['ma'];
            $bestMape = $maTiga['mape'];
        } else if ($maEmpat['mape'] <= $maTiga['mape'] && $maEmpat['mape'] <= $maLima['mape']) {
            $bestForecast = $maEmpat['hasil'];
            $bestMoving = $maEmpat['ma'];
            $bestMape = $maEmpat['mape'];
        } else {
            $bestForecast = $maLima['hasil'];
            $bestMoving = $maLima['ma'];
            $bestMape = $maLima['mape'];
        }

        $data['bestMape'] = $bestMape;
        $data['bestForecast'] = round($bestForecast);
        $data['bestMoving'] = $bestMoving;

        $data['forcast'] = $this->laporan->forecastMonth($post['tgl_peramalan']);

        $data['produk'] = $this->produk->getProduk($post['sparepart']);

        $data['content'] = 'laporan/hasil_peramalan';

        $this->load->view('layout', $data);
    }

    public function hitungPeramalanSemuaProduk()
    {
        $post = $this->input->post();
        $produk = $this->produk->getAllProduk();

        foreach ($produk as $p) {

            $perhitunganSma = $this->inventori->perhitunganSMA($p['id'], $post['tgl_peramalan'], 3);
            $mapeTiga = $this->inventori->mape;
            $perhitunganSmaEmpat = $this->inventori->perhitunganSMA($p['id'], $post['tgl_peramalan'], 4);
            $mapeEmpat = $this->inventori->mape;
            $perhitunganSmaLima = $this->inventori->perhitunganSMA($p['id'], $post['tgl_peramalan'], 5);
            $mapeLima = $this->inventori->mape;

            //inisialisasi default hasil 0
            $maTiga = [
                'ma' => 3,
                'hasil' => $perhitunganSma != null ? end($perhitunganSma)['Peramalan'] : 0,
                'mape' => $mapeTiga == null ? 100 : $mapeTiga
            ];
            $maEmpat = [
                'ma' => 4,
                'hasil' => $perhitunganSmaEmpat != null ? end($perhitunganSmaEmpat)['Peramalan'] : 0,
                'mape' => $mapeEmpat == null ? 100 : $mapeEmpat
            ];
            $maLima = [
                'ma' => 5,
                'hasil' => $perhitunganSmaLima != null ? end($perhitunganSmaEmpat)['Peramalan'] : 0,
                'mape' => $mapeLima == null ? 100 : $mapeLima
            ];

            //Membandingkan mape terkecil untuk dijadikan kesimpulan
            if ($maTiga['mape'] <= $maEmpat['mape'] && $maTiga['mape'] <= $maLima['mape']) {
                $bestForecast = $maTiga['hasil'];
                $bestMoving = $maTiga['ma'];
                $bestMape = $maTiga['mape'];
            } else if ($maEmpat['mape'] <= $maTiga['mape'] && $maEmpat['mape'] <= $maLima['mape']) {
                $bestForecast = $maEmpat['hasil'];
                $bestMoving = $maEmpat['ma'];
                $bestMape = $maEmpat['mape'];
            } else {
                $bestForecast = $maLima['hasil'];
                $bestMoving = $maLima['ma'];
                $bestMape = $maLima['mape'];
            }

            // $data['bestMape'] = $bestMape;
            $bestForecast = round($bestForecast);
            $data['bestMoving'] = $bestMoving;

            $row["id_produk"] = $p['id'];
            $row['tanggal'] = $post['tgl_peramalan'];
            $row['hasil'] = $bestForecast;
            $row['mape'] = $bestMape;

            // dd($row['id_produk']);

            // var_dump($row);

            //TODO
            //beri kondisi jika mape = 100 dan hasil=0  maka tidak insert ke db

            $this->laporan->insertPeramalan($row);
        }

        $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                Peramalan berhasil! Data sudah tersimpan
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
        </div>');
        redirect('laporan/peramalan');
    }

    public function simpanPeramalan()
    {

        $this->laporan->insertPeramalan();
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Peramalan berhasil! Data sudah tersimpan
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
</div>');
        redirect('laporan/peramalan');
    }
}