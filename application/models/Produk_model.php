<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    //GET ALL KATEGORI WITH JOIN PRODUK

    public function getAllKategori()
    {

        $query = "SELECT `kategori_produk`.`id`, `kategori_produk`.`nama`,
                COUNT(`produk`.`id_kategori`) as `jumlah_produk`
              FROM `kategori_produk` LEFT JOIN `produk`
                ON `produk`.`id_kategori` = `kategori_produk`.`id`
                GROUP BY `id_kategori`
                ORDER BY `jumlah_produk` DESC
        ";
        return $this->db->query($query)->result_array();
    }

    //GET COUNT PRODUK
    public function countAllProduk()
    {
        $query = "SELECT COUNT(`produk`.`id`) AS `jumlah_produk` FROM produk";
        return $this->db->query($query)->row();
    }

    //GET NEWEST PRODUK
    public function newestProduk()
    {
        $newest = "SELECT MAX(`produk`.`id`) from produk";
        $query = "SELECT `produk`.`nama` as nama FROM produk WHERE `produk`.`id` = ($newest)";

        return $this->db->query($query)->row();

    }

    //GET WHERE PRODUK IS RUNNING OUT
    public function runningOutProduk()
    {
        $query = "SELECT `produk`.`id`, `produk`.`nama`, `produk`.`jumlah`, `produk`.`batas_bawah`
                  FROM produk
                  WHERE `produk`.`jumlah` <= `produk`.`batas_bawah`";
        return $this->db->query($query)->result();
    }

    //COUNT WHERE PRODUK IS RUNNING OUT
    public function countRunningOutProduk()
    {
        $query = "SELECT COUNT(*) as produk_kritis FROM produk
                  WHERE `produk`.`jumlah` <= `produk`.`batas_bawah`";
        return $this->db->query($query)->row();
    }

    //GET KATEGORI BY ID
    public function getKategori($id)
    {
        // echo $_POST[$id];
        // $query = "SELECT * FROM `user_menu` WHERE `id` ='.$id";

        return $this->db->get_where('kategori_produk', ['id' => $id])->row_array();
    }

    //EDIT KATEGORI
    public function editKategori()
    {
        $data = [
            "nama" => $this->input->post('kategori', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kategori_produk', $data);
    }
    //DELETE KATEGORI
    public function deleteKategori($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('kategori_produk');
    }

    //GET ALL PRODUK WITH JOIN KATEGORI
    public function getAllProduk()
    {
        $query = "SELECT `produk`.*,`kategori_produk`.`nama` as nama_kategori
        FROM `produk` JOIN `kategori_produk`
        ON `produk`.`id_kategori` = `kategori_produk`.`id`
        ORDER BY `produk`.`nama` ASC";

        return $this->db->query($query)->result_array();
    }

    public function insertProduk()
    {
        $data = [
            'nama' => $this->input->post('nama', true),
            'id_kategori' => $this->input->post('kategori', true),
            'kode' => $this->input->post('kode', true),
            'jumlah' => $this->input->post('stok', true),
            'harga_jual' => $this->input->post('harga_jual', true),
            'harga_beli' => $this->input->post('harga_beli', true),
            'batas_bawah' => $this->input->post('batas_bawah', true),
        ];

        $this->db->insert('produk', $data);
    }

    public function getProduk($id)
    {
        $query = "SELECT `produk`.*, `kategori_produk`.`id` as IdKategori,
        `kategori_produk`.`nama` as NamaKategori
        FROM produk JOIN `kategori_produk`
        ON `produk`.`id_kategori` = `kategori_produk`.`id`
        WHERE `produk`.`id`= $id";
        // return $this->db->get_where('produk', ['id' => $id])->row_array();

        return $this->db->query($query)->row();
    }

    //EDIT Produk
    public function editProduk()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "id_kategori" => $this->input->post('kategori', true),
            "kode" => $this->input->post('kode', true),
            "jumlah" => $this->input->post('stok', true),
            "harga_beli" => $this->input->post('harga_beli', true),
            "harga_jual" => $this->input->post('harga_jual', true),
            "batas_bawah" => $this->input->post('batas_bawah', true),

        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('produk', $data);
    }

    //DELETE PRODUK
    public function deleteProduk($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('produk');
    }

}