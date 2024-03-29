<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();

        $this->load->model('Inventori_Model', 'inventori');
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

    public function rekomendasiPembelianStokMasuk()
    {
        $post = $this->input->post();
        $idProduk = $post['idProduk'];
        $tglPembelian = $post['tgl_pembelian'];
        echo json_encode($this->inventori->ambilRamalan($idProduk, $tglPembelian));
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

    //Edit data from Ubah Stok Masuk
    public function ubahStokMasuk($id)
    {
        $data['content'] = 'inventori/ubah_stokmasuk';
        $data['title'] = 'Stok Masuk';
        $data['subTitle'] = 'Ubah Catatan Stok Masuk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $data['supplier'] = $this->db->get('supplier')->result_array();

        $data['stok_masuk'] = $this->inventori->getStokMasuk($id);
        $data['stok_masuk_produk'] = $this->inventori->getStokDetail($id);

        $this->form_validation->set_rules('supplier', 'Supplier', "required", [
            'required' => 'Supplier wajib diisi',
        ]);

        $this->load->model('Produk_model', 'produk');
        $data['produk'] = $this->produk->getAllProduk();

        // ej($data['countReceipt']);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->inventori->editStokMasuk();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Catatan stok masuk diubah </div>');
            redirect('inventori/stokmasuk');
        }
    }

    //Detail Stok Masuk
    public function detailStokMasuk($id)
    {
        $data['content'] = 'inventori/detail_stokmasuk';
        $data['title'] = 'Stok Masuk';
        $data['subTitle'] = 'Detail Catatan Stok Masuk';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();
        $data['stok_masuk'] = $this->inventori->getStokMasuk($id);
        $data['stok_masuk_produk'] = $this->inventori->getStokDetail($id);
        $data['supplier'] = $this->db->get('supplier')->result_array();
        $this->load->model('Produk_model', 'produk');
        $data['produk'] = $this->produk->getAllProduk();

        $this->load->view('layout', $data);
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

    public function ubahStokKeluar($id)
    {
        $data['content'] = 'inventori/ubah_stokkeluar';
        $data['title'] = 'Stok Keluar';
        $data['subTitle'] = 'Ubah Catatan Stok Keluar';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();



        $this->load->model('Produk_model', 'produk');
        $data['produk'] = $this->produk->getAllProduk();
        $data['stok_keluar'] = $this->inventori->getStokKeluar($id);
        $data['stok_keluar_produk'] = $this->inventori->getStokKeluarDetail($id);


        $this->form_validation->set_rules('catatan_keluar', 'Catatan Keluar', "required", [
            'required' => 'Catatan keluar wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('layout', $data);
        } else {
            $this->inventori->editStokKeluar();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Catatan stok keluar diubah </div>');
            redirect('inventori/stokkeluar');
        }
    }

    public function detailStokKeluar($id)
    {
        $data['content'] = 'inventori/detail_stokkeluar';
        $data['title'] = 'Stok Keluar';
        $data['subTitle'] = 'Detail Catatan Stok Keluar';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
        ])->row_array();

        $this->load->model('Produk_model', 'produk');
        $data['produk'] = $this->produk->getAllProduk();
        $data['stok_keluar'] = $this->inventori->getStokKeluar($id);
        $data['stok_keluar_produk'] = $this->inventori->getStokKeluarDetail($id);
        // var_dump($data['stok_keluar_produk']);
        // die;

        $this->load->view('layout', $data);
    }
}