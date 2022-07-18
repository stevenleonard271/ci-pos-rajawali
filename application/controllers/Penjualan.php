<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();

        $this->load->model('Penjualan_Model', 'penjualan');
        $this->load->model('Others_Model', 'others');
        $this->load->model('Produk_model', 'produk');
    }

    /* MENU UNTUK KASIR
      Controller kasir 
    */
    public function kasir()
    {
        $data['title'] = 'Kasir';
        $data['user'] = $this->db->get_where('user', [
            'email' => $this->session->userdata('email')
        ])->row_array();

        $data['content'] = 'penjualan/kasir';
        $data['pelanggan'] = $this->others->getAllPelanggan();
        $data['produk'] = $this->produk->getAllProduk();
        $data['mekanik'] = $this->others->getAllMekanik();
        $data['countReceipt'] = $this->penjualan->countPenjualan()->jumlah_penjualan;

        $this->load->view('layout', $data);
    }

    public function getMotor()
    {
        $post = $this->input->post();
        $motor = $this->others->getAllMotor($post['id']);
        $str = '<option value="">Pilih Motor</option>';
        foreach ($motor as $mtr) {
            $str .= '<option value="' . $mtr->id . '">' . $mtr->jenis . ' (' . $mtr->plat_nomor . ')</option>';
        }
        echo $str;
    }

    public function getDetailPro()
    {
        $post = $this->input->post();
        $produk = $this->produk->getProduk($post['id']);
        ej($produk);
    }

    public function tambahCart()
    {
        $this->penjualan->insertCart();
    }

    public function grandTotal()
    {
        $id_pelanggan = $this->input->post("pelanggan");
        $biaya_service = $this->input->post("servis_biaya");
        $cart = $this->penjualan->viewCart($id_pelanggan)->result();
        $ttl = 0;
        foreach ($cart as $crt) {
            $ttl += $crt->harga_total;
        }
        $ttl += $biaya_service;
        echo $ttl;
    }

    // public function hapusCart($id)
    // {
    //     $id_pelanggan = $this->input->post("pelanggan");
    //     $id_produk = $id;
    //     // $id_produk = $this->input->post("sparepart");
    //     $this->penjualan->deleteCart($id_produk, $id_pelanggan);
    // }

    public function cartlist()
    {
        $id_pelanggan = $this->input->post("pelanggan");
        $cart = $this->penjualan->viewCart($id_pelanggan);
        $onclick = "return confirm('Yakin hendak menghapus?');";
        // <button href="http://localhost/pos-rajawali/penjualan/hapusCart/' . $crt->id_produk . 
        $str = '';
        if ($cart->num_rows() > 0) {
            $cartdata = $cart->result();
            $i = 1;
            foreach ($cartdata as $crt) {
                $str .= '
                    <tr>
                        <td>' . $i . '</td>
                        <td>' . $crt->nama . '</td>
                        <td> <input type="text" class="form-control shadow-none" value="' . $crt->jumlah . '"></td>
                        <td>' . $crt->harga_jual . '</td>
                        <td>' . $crt->harga_total . '</td>
                        <td> <button type="submit" class="badge badge-danger deletesparepart">Hapus</button>
                        </td>
                    </tr>
                ';
                $i++;
            }
        } else {
            $str .= '
            <tr>
                <td colspan="6" class="text-center"><b>Masukkan item yang dibeli</b></td>
            </tr>
            ';
        }

        echo $str;
    }
}
