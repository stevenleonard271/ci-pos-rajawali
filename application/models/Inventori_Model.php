<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori_Model extends CI_Model
{
    public $mape = 0;
    //GET Supplier BY ID
    public function getSupplier($id)
    {
        // echo $_POST[$id];
        // $query = "SELECT * FROM `user_menu` WHERE `id` ='.$id";

        return $this->db->get_where('supplier', ['id' => $id])->row_array();
    }

    //EDIT Supplier
    public function editSupplier()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nomor" => $this->input->post('nomor', true),
            "deskripsi" => $this->input->post('deskripsi', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('supplier', $data);
    }

    //DELETE Supplier
    public function deleteSupplier($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('supplier');
    }

    public function insertStokMasuk()
    {
        $data = [
            'id_supplier' => $this->input->post('supplier', true),
            'tanggal_pembelian' => $this->input->post('tgl_pembelian', true),
            'status' => $this->input->post('status_pembelian', true),
            'no_pembelian' => $this->input->post('no_pembelian', true),
            'catatan_pembelian' => $this->input->post('catatan_pembelian', true),
        ];
        // dd($data);
        $this->db->insert('stok_masuk', $data);

        $id_stok_masuk = $this->db->insert_id();
        $select_produk = $this->input->post('select_produk');
        $jumlah_produk = $this->input->post('jumlah_produk');
        $harga_produk = $this->input->post('harga_produk');
        $total_produk = $this->input->post('total_produk');
        $grandtotal = 0;
        for ($i = 0; $i < count($select_produk); $i++) {
            $grandtotal += $total_produk[$i];
            $data_detail = [
                'id_stok_masuk' => $id_stok_masuk,
                'id_produk' => $select_produk[$i],
                'jumlah_produk' => $jumlah_produk[$i],
                'harga_produk' => $harga_produk[$i],
                'total_produk' => $total_produk[$i],

            ];
            //insert data ke stok_masuk_produk
            $this->db->insert('stok_masuk_produk', $data_detail);
        }
        //update grand total
        $this->db->set('grand_total', $grandtotal);
        $this->db->where('id', $id_stok_masuk);
        $this->db->update('stok_masuk');
    }

    public function getAllStokMasuk()
    {
        $query = "SELECT `stok_masuk`.*, `supplier`.`nama` as nama_supplier
                  FROM stok_masuk JOIN supplier
                  ON `stok_masuk`.`id_supplier` = `supplier`.`id`
                  ORDER BY `stok_masuk`.`no_pembelian` ASC";
        return $this->db->query($query)->result_array();
    }

    public function countOrder()
    {
        $query = "SELECT `stok_masuk`.`created_at`,COUNT(`stok_masuk`.`id`) as jumlah_stokmasuk
                  FROM `stok_masuk`";
        return $this->db->query($query)->row();
    }
    public function countStokMasuk()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $query = "SELECT `stok_masuk`.`created_at`,COUNT(`stok_masuk`.`id`) as jumlah_stokmasuk
                  FROM `stok_masuk`WHERE `stok_masuk`.`created_at` = '$today'";

        return $this->db->query($query)->row();
    }

    public function getStokMasuk($id)
    {
        $query = "SELECT `stok_masuk`.*,`supplier`.`id` as idSupplier,
                 `supplier`.`nama` as nama_supplier
                  FROM stok_masuk JOIN supplier
                  ON `stok_masuk`.`id_supplier` = `supplier`.`id`
                  WHERE `stok_masuk`.`id` = $id";

        return $this->db->query($query)->row();
    }

    public function getStokDetail($id)
    {
        $this->db->where("id_stok_masuk", $id);
        return $this->db->get("stok_masuk_produk")->result();
    }

    //Edit Stok Masuk
    public function editStokMasuk()
    {

        $data = [
            'id_supplier' => $this->input->post('supplier', true),
            'no_pembelian' => $this->input->post('no_pembelian', true),
            'tanggal_pembelian' => $this->input->post('edit_tgl_pembelian', true),
            'status' => $this->input->post('status_pembelian', true),
            'catatan_pembelian' => $this->input->post('catatan_pembelian', true),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('stok_masuk', $data);

        // delete all data where id_stok_masuk = id_produk
        $this->db->where('id_stok_masuk', $this->input->post('id'));
        $this->db->delete('stok_masuk_produk');

        //insert all produk into db stok_masuk_produk
        $id_stok_masuk = $this->input->post('id');
        $select_produk = $this->input->post('select_produk');
        $jumlah_produk = $this->input->post('jumlah_produk');
        $harga_produk = $this->input->post('harga_produk');
        $total_produk = $this->input->post('total_produk');
        $grandtotal = 0;
        for ($i = 0; $i < count($select_produk); $i++) {
            $grandtotal += $total_produk[$i];
            $data_detail = [
                'id_stok_masuk' => $id_stok_masuk,
                'id_produk' => $select_produk[$i],
                'jumlah_produk' => $jumlah_produk[$i],
                'harga_produk' => $harga_produk[$i],
                'total_produk' => $total_produk[$i],

            ];
            //insert data ke stok_masuk_produk
            $this->db->insert('stok_masuk_produk', $data_detail);
        }
        //update grand total
        $this->db->set('grand_total', $grandtotal);
        $this->db->where('id', $id_stok_masuk);
        $this->db->update('stok_masuk');
    }

    public function getAllStokKeluar()
    {
        $query = "SELECT `stok_keluar`.*
        FROM stok_keluar ORDER BY `stok_keluar`.`tanggal_keluar` ASC";

        return $this->db->query($query)->result_array();
    }

    public function getStokKeluar($id)
    {
        return $this->db->get_where('stok_keluar', ['id' => $id])->row();
    }

    public function getStokKeluarDetail($id)
    {
        $this->db->where("id_stok_keluar", $id);
        return $this->db->get("stok_keluar_produk")->result();
    }

    public function countStokKeluar()
    {
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $query = "SELECT `stok_keluar`.`created_at`,COUNT(`stok_keluar`.`id`) as jumlah_stokkeluar
                  FROM `stok_keluar`WHERE `stok_keluar`.`created_at` = '$today'";

        return $this->db->query($query)->row();
    }

    public function insertStokKeluar()
    {
        $data = [
            'no_keluar' => $this->input->post('no_keluar', true),
            'tanggal_keluar' => $this->input->post('tgl_keluar', true),
            'catatan_keluar' => $this->input->post('catatan_keluar', true),
        ];
        $this->db->insert('stok_keluar', $data);

        $id_stok_keluar = $this->db->insert_id();
        $select_produk = $this->input->post('select_produk');
        $jumlah_produk = $this->input->post('jumlah_produk');
        $alasan_keluar = $this->input->post('select_alasan');

        for ($i = 0; $i < count($select_produk); $i++) {
            $data_detail = [
                'id_stok_keluar' => $id_stok_keluar,
                'id_produk' => $select_produk[$i],
                'jumlah_produk' => $jumlah_produk[$i],
                'alasan' => $alasan_keluar[$i],
            ];
            //insert data ke stok_keluar_produk
            $this->db->insert('stok_keluar_produk', $data_detail);
        }
    }

    public function editStokKeluar()
    {
        $data = [
            'no_keluar' => $this->input->post('no_keluar', true),
            'tanggal_keluar' => $this->input->post('edit_tgl_keluar', true),
            'catatan_keluar' => $this->input->post('catatan_keluar', true),
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('stok_keluar', $data);

        // delete all data where id_stok_keluar = id_produk
        $this->db->where('id_stok_keluar', $this->input->post('id'));
        $this->db->delete('stok_keluar_produk');

        //insert all produk into db stok_keluar_produk
        $id_stok_keluar = $this->input->post('id');
        $select_produk = $this->input->post('select_produk');
        $jumlah_produk = $this->input->post('jumlah_produk');
        $alasan_keluar = $this->input->post('select_alasan');

        for ($i = 0; $i < count($select_produk); $i++) {
            $data_detail = [
                'id_stok_keluar' => $id_stok_keluar,
                'id_produk' => $select_produk[$i],
                'jumlah_produk' => $jumlah_produk[$i],
                'alasan' => $alasan_keluar[$i],
            ];
            //insert data ke stok_keluar_produk
            $this->db->insert('stok_keluar_produk', $data_detail);
        }
    }

    public function getPenjualan($idProduk, $tglPeramalan)
    {
        $query = "SELECT monthname(pj.`tanggal_penjualan`) as bulan, year(pj.`tanggal_penjualan`) as tahun ,p.`id_produk`, sum(p.`jumlah`) as jumlah_produk 
                  FROM penjualan_produk p join penjualan pj 
                  ON p.id_penjualan = pj.id
                  WHERE month(tanggal_penjualan) <  month('$tglPeramalan')
                  AND year(tanggal_penjualan) <=  year('$tglPeramalan')
                  AND p.`id_produk` = '$idProduk'
                  GROUP BY month(tanggal_penjualan), year(tanggal_penjualan)";

        return $this->db->query($query);
    }

    public function getForecastMonth($tglPeramalan)
    {
        $query = "SELECT monthname('$tglPeramalan') as bulan, month('$tglPeramalan') as bulanAngka,
                 '$tglPeramalan' as tanggal_peramalan,
                  year('$tglPeramalan') as tahun";
        return $this->db->query($query)->row();
    }

    private function getRequiredPenjualan($requiredMonth, $requiredYear, $idProduk)
    {
        $query = "SELECT monthname(pj.`tanggal_penjualan`) as bulan, year(pj.`tanggal_penjualan`) as tahun ,p.`id_produk`, sum(p.`jumlah`) as jumlah_produk 
                  FROM penjualan_produk p join penjualan pj 
                  ON p.id_penjualan = pj.id
                  WHERE month(tanggal_penjualan) =  '$requiredMonth'
                  AND year(tanggal_penjualan) =  '$requiredYear'
                  AND p.`id_produk` = '$idProduk'
                  GROUP BY month(tanggal_penjualan), year(tanggal_penjualan)";

        return $this->db->query($query);
    }

    public function ambilRamalan($produk, $tglPeramalan)
    {
        $tglPeramalan = strtotime($tglPeramalan);
        $this->db->select('*');
        $this->db->from('peramalan');
        $this->db->where('month(tanggal)', date('m', $tglPeramalan));
        $this->db->where('year(tanggal)', date('Y', $tglPeramalan));
        $this->db->where('id_produk', $produk);
        $this->db->join('produk', 'produk.id= peramalan.id_produk ');
        return $this->db->get()->row();
    }

    public function perhitunganSMA($idProduk, $tglPeramalan, $ma)
    {
        // get data yang akan dihitung
        $forecast = $this->getForecastMonth($tglPeramalan);
        $requiredMonth = $forecast->bulanAngka - $ma - 1;
        $requiredYear = $forecast->tahun;


        $histo = $this->getPenjualan($idProduk, $tglPeramalan)->result();
        $requiredData = $this->getRequiredPenjualan($requiredMonth, $requiredYear, $idProduk);

        if ($requiredData->num_rows() > 0) {
            $count = 1;
            $jumJual = [];
            $ap = [];
            $row = [];
            $totalApe = 0;
            foreach ($histo as $hs) :
                $ramal = "";
                $error = "";
                $abserror = "";
                array_push($jumJual, $hs->jumlah_produk);
                if ($count <= $ma) :
                    $ramal = 0;
                    $error = 0;
                    $abserror = 0;
                    $ape = 0;
                else :
                    $ttl = 0;
                    for ($i = ($count - $ma) - 1; $i < count($jumJual) - 1; $i++) {
                        $ttl += $jumJual[$i];
                    }
                    $ttl = $ttl / $ma;
                    $ramal = $ttl;
                    $error = ($jumJual[count($jumJual) - 1] - $ttl);
                    $abserror = abs($error);
                    $ape = (abs(($jumJual[count($jumJual) - 1] - $ttl))) / $jumJual[count($jumJual) - 1];
                    $totalApe += $ape;
                    // fungsi push ap untuk menambahkan bulan yang memiliki ape
                    array_push($ap, $ape);
                endif;

                $row = array(
                    'Tahun' => $hs->tahun,
                    'Bulan' => $hs->bulan,
                    'Jumlah' => $hs->jumlah_produk,
                    'Peramalan' => $ramal,
                    'Error' => $error,
                    'AbsError' => $abserror,
                    'APE' => $ape
                );

                $result[] = $row;

                $count++;
            endforeach;
            $ttl = 0;

            for ($i = ($count - $ma) - 1; $i < count($jumJual); $i++) {
                // echo 'sugeng' . count($jumJual);
                $ttl += $jumJual[$i];
            }
            $ttl = $ttl / $ma;
            $ramal = $ttl;

            $row = array(
                'Tahun' => $hs->tahun,
                'Bulan' => $forecast->bulan,
                'Jumlah' => '?',
                'Peramalan' => $ramal,
                'Error' => 0,
                'AbsError' => 0,
                'APE' => 0
            );
            $result[] = $row;

            $this->mape = $totalApe / count($ap) * 100;

            return $result;
        } else {
            return null;
            // die();
        }
    }
}