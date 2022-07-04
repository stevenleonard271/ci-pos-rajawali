<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800" id="titleHide"><?=$title;?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card mb-5">
                <div class="card-header bg-primary">
                    <h1 class="h5 mt-2 text-gray-100"><?=$subTitle;?></h1>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-5 col-sm-5">
                                <input type="hidden" name="no_keluar" id="no_keluar"
                                    value="<?php generateCodeStockOut($countReceipt);?>" />
                                <div class="form-group">
                                    <label for="tgl_keluar">Tanggal Barang Keluar</label>
                                    <input type="text" class="form-control date" id="tgl_keluar" name="tgl_keluar"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <div class="row">
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class=" col-sm col-md col-lg mb-3">
                                        <div class="card border-left-danger shadow h-100 ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                            Nomor Barang Keluar</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?php generateCodeStockOut($countReceipt);?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fas fa-receipt fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="catatan_keluar">Catatan Keluar</label>
                                    <textarea class="form-control" name="catatan_keluar" id="catatan_keluar"
                                        rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="h5 font-weight-bold text-gray-800">Tambah Produk</div>
                            </div>
                        </div>
                        <hr class="mb-1">
                        <div class="col-md-12 col-xs-12 col-lg-12 ">
                            <div class="row border-bottom align-middle p-2">
                                <div class="col-5 pl-0">
                                    <b>Nama Barang</b>
                                </div>
                                <div class="col-3">
                                    <b>Jumlah</b>
                                </div>
                                <div class="col-3">
                                    <b>Alasan Barang Keluar</b>
                                </div>

                            </div>
                            <div class="row border-bottom p-2 align-items-center" id="form_produk_masuk1">
                                <div class="col-5 pl-0 ">
                                    <select id="select_produk" name="select_produk[]"
                                        class="select_produk form-control">
                                        <option value="">Pilih Produk</option>
                                        <?php foreach ($produk as $p): ?>
                                        <option value="<?=$p['id'];?>"><?=$p['nama'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="jumlah_produk form-control" id="jumlah_produk"
                                        name="jumlah_produk[]" autocomplete="off">
                                </div>
                                <div class="col-3">
                                    <select id="select_alasan" name="select_alasan[]"
                                        class="select_alasan form-control">
                                        <option value="">Pilih alasan</option>
                                        <option value="Rusak dan dikembalikan">Rusak dan dikembalikan</option>
                                        <option value="Dan lain lain">Dan lain lain</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12 col-xl-12 mt-2">
                            <a id="tambah_produk" class="btn btn-success">Tambah Produk</a>
                            <a href="<?=base_url('inventori/stokkeluar')?>"
                                class="btn btn-danger float-right ">Batal</a>
                            <button type="submit" class="btn ml-2 mr-3 btn-primary float-right">Simpan Catatan</button>
                        </div>
                    </form>
                </div>
            </div>




        </div>

    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php

//generate Code Pembelian
function generateCodeStockOut($order)
{

    date_default_timezone_set('Asia/Jakarta');
    $name = "#SORWJ";
    $today = date('dmy');
    $order = $order + 1;

    $order = sprintf('%04d', $order);

    $code = $name . $today . $order;

    echo $code;

}

?>