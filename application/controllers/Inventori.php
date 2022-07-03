<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();

        $this->load->model('Inventori_model', 'inventori');
    }

    //Get and Insert Supplier
    public function supplier()
    {
        $data['title'] = 'Supplier';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'inventori/supplier';

        //load all Supplier from Db
        $data['supplier'] = $this->db->get('supplier')->result_array();

        //validation
        $this->form_validation->set_rules('nama', 'Nama', "required", [
            'required' => 'Nama Supplier wajib diisi',
        ]);
        $this->form_validation->set_rules('nomor', 'Nomor', "required", [
            'required' => 'Nomor Supplier wajib diisi',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', "required", [
            'required' => 'Deskripsi Supplier wajib diisi',
        ]);

        //Insert data ke tabel supplier
        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->db->insert('supplier', [
                'nama' => $this->input->post('nama'),
                'nomor' => $this->input->post('nomor'),
                'deskripsi' => $this->input->post('deskripsi'),
            ]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Supplier baru ditambah </div>');
            redirect('inventori/supplier');

        }

    }

    //UBAH Supplier
    public function getUbahSupplier()
    {
        $id = $_POST['id'];
        echo json_encode($this->inventori->getSupplier($id));
    }

    public function ubahSupplier()
    {
        $id = $_POST['id'];

        $this->inventori->editSupplier($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Supplier diubah! </div>');
        redirect('inventori/supplier');
    }

    //HAPUS SUPPLIER
    public function hapusSupplier($id)
    {

        $this->inventori->deleteSupplier($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
          Supplier terhapus </div>');
        redirect('inventori/supplier');
    }

    public function stokmasuk()
    {

        $data['title'] = 'Stok Masuk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'inventori/stokmasuk';

        $data['stokmasuk'] = $this->inventori->getAllStokMasuk();

        $this->load->view('layout', $data);
    }

    //Insert data
    public function stokMasukBaru()
    {
        $data['title'] = 'Stok Masuk';
        $data['subTitle'] = 'Tambah Catatan Stok Masuk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'inventori/stokmasukbaru';

        $data['supplier'] = $this->db->get('supplier')->result_array();

        $this->form_validation->set_rules('supplier', 'Supplier', "required", [
            'required' => 'Supplier wajib diisi',
        ]);

        $this->form_validation->set_rules('catatan_pembelian', 'Catatan pembelian', "required", [
            'required' => 'Catatan pembelian wajib diisi',
        ]);

        $data['countReceipt'] = $this->inventori->countStokMasuk()->jumlah_stokmasuk;
        $this->load->model('Produk_model', 'produk');
        $data['produk'] = $this->produk->getAllProduk();

        // ej($data['countReceipt']);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->inventori->insertStokMasuk();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Catatan stok masuk ditambah </div>');
            redirect('inventori/stokmasuk');
        }

    }

    public function stokkeluar()
    {

        $data['title'] = 'Stok Keluar';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'inventori/stokkeluar';

        $data['stokkeluar'] = $this->inventori->getAllStokKeluar();

        $this->load->view('layout', $data);
    }

    public function stokkeluarBaru()
    {
        $data['title'] = 'Stok Keluar';
        $data['subTitle'] = 'Tambah Catatan Stok Keluar';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['content'] = 'inventori/stokkeluarbaru';
        $this->load->model('Produk_model', 'produk');
        $data['produk'] = $this->produk->getAllProduk();

        $data['countReceipt'] = $this->inventori->countStokKeluar()->jumlah_stokkeluar;

        $this->form_validation->set_rules('catatan_keluar', 'Catatan Keluar', "required", [
            'required' => 'Catatan keluar wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->inventori->insertStokKeluar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Catatan stok keluar ditambah </div>');
            redirect('inventori/stokkeluar');
        }

    }

}