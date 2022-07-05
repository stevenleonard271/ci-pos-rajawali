<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Produk_model', 'produk');
    }

    //GET AND INSERT PRODUK
    public function index()
    {
        $data['title'] = 'Daftar Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'produk/index';

        //Get data dari tabel produk
        $data['produk'] = $this->produk->getAllProduk();

        $data['hitungProduk'] = $this->produk->countAllProduk();

        $data['produkBaru'] = $this->produk->newestProduk();

        $data['produkKritis'] = $this->produk->runningOutProduk();

        $data['hitungProdukKritis'] = $this->produk->countRunningOutProduk();

        $this->load->view('layout', $data);

    }
    //INSERT PRODUK
    public function baru()
    {
        $data['title'] = 'Daftar Produk';
        $data['subTitle'] = 'Tambah Produk Baru';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'produk/baru';

        $data['kategori'] = $this->produk->getAllKategori();

        $this->form_validation->set_rules('nama', 'Nama', "required", [
            'required' => 'Nama produk wajib diisi',
        ]);
        $this->form_validation->set_rules('kode', 'Kode', "required", [
            'required' => 'Kode produk wajib diisi',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', "required", [
            'required' => 'Kategori produk wajib diisi',
        ]);
        $this->form_validation->set_rules('stok', 'Jumlah', "required", [
            'required' => 'Stok produk wajib diisi',
        ]);
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', "required", [
            'required' => 'Harga jual produk wajib diisi',
        ]);
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', "required", [
            'required' => 'Harga beli produk wajib diisi',
        ]);
        $this->form_validation->set_rules('batas_bawah', 'Batas Bawah', "required", [
            'required' => 'Batas bawah produk wajib diisi',
        ]);

        // 'nama' => $this->input->post('nama', true),
        // 'id_kategori' => $this->input->post('kategori', true),
        // 'kode' => $this->input->post('kode', true),
        // 'jumlah' => $this->input->post('stok', true),
        // 'harga_jual' => $this->input->post('harga_jual', true),
        // 'harga_beli' => $this->input->post('harga_beli', true),
        // 'batas_bawah' => $this->input->post('batas_bawah', true),

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->produk->insertProduk();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Produk baru ditambah </div>');
            redirect('produk');
        }
    }

    //UBAH PRODUK
    public function ubahProduk($id)
    {
        $data['content'] = 'produk/ubah';
        $data['title'] = 'Daftar Produk';
        $data['subTitle'] = 'Ubah Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();
        $data['kategori'] = $this->produk->getAllKategori();
        $data['produk'] = $this->produk->getProduk($id);

        $data_edit = $this->produk->getProduk($id);
        // ej($data_edit);

        $data['laba'] = $data_edit->harga_jual - $data_edit->harga_beli;

        $this->form_validation->set_rules('nama', 'Nama', "required", [
            'required' => 'Nama produk wajib diisi',
        ]);
        $this->form_validation->set_rules('kode', 'Kode', "required", [
            'required' => 'Kode produk wajib diisi',
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', "required", [
            'required' => 'Kategori produk wajib diisi',
        ]);
        $this->form_validation->set_rules('stok', 'Jumlah', "required", [
            'required' => 'Stok produk wajib diisi',
        ]);
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', "required", [
            'required' => 'Harga jual produk wajib diisi',
        ]);
        $this->form_validation->set_rules('harga_beli', 'Harga Beli', "required", [
            'required' => 'Harga beli produk wajib diisi',
        ]);
        $this->form_validation->set_rules('batas_bawah', 'Batas Bawah', "required", [
            'required' => 'Batas bawah produk wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->produk->editProduk();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Produk diubah! </div>');
            redirect('produk');
        }

    }

    //DELETE PRODUK
    public function hapusProduk($id)
    {
        $this->produk->deleteProduk($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Produk terhapus </div>');
        redirect('produk');
    }

    // GET AND INSERT KATEGORI
    public function kategori()
    {
        $data['title'] = 'Kategori Produk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'produk/kategori';
        $data['kategori'] = $this->produk->getAllKategori();

        $this->form_validation->set_rules('kategori', 'Kategori', "required", [
            'required' => 'Kategori wajib diisi',
        ]);

        //Insert data ke tabel kategori_produk
        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->db->insert('kategori_produk', [
                'nama' => $this->input->post('kategori'),
            ]);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Kategori baru ditambah </div>');
            redirect('produk/kategori');
        }
    }

    //UBAH Kategori
    public function getUbahKategori()
    {
        $id = $_POST['id'];
        echo json_encode($this->produk->getKategori($id));
    }

    public function ubahKategori()
    {
        $id = $_POST['id'];

        $this->produk->editKategori($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Kategori diubah! </div>');
        redirect('produk/kategori');
    }

    //HAPUS KATEGORI
    public function hapusKategori($id)
    {

        $this->produk->deleteKategori($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Kategori terhapus </div>');
        redirect('produk/kategori');
    }

}