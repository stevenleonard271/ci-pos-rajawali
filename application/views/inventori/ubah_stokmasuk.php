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
                                <input type="hidden" name="id" id="id" value="<?=$stok_masuk->id;?>" />
                                <input type="hidden" name="no_pembelian" id="no_pembelian"
                                    value="<?=$stok_masuk->no_pembelian;?>" />

                                <div class="form-group">
                                    <label for="supplier">Supplier Produk</label>
                                    <select name="supplier" id="select_supplier" class="form-control">
                                        <option value="">Pilih Supplier</option>
                                        <?php foreach ($supplier as $s): ?>
                                        <option value="<?=$s['id'];?>"
                                            <?php if ($s['id'] == $stok_masuk->idSupplier): ?>selected <?php endif;?>>
                                            <?=$s['nama'];?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                    <?=form_error('supplier', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pembelian">Tanggal Pembelian</label>
                                    <input type="text" class="form-control date" id="edit_tgl_pembelian"
                                        name="edit_tgl_pembelian" autocomplete="off"
                                        value="<?=$stok_masuk->tanggal_pembelian;?>">
                                    <?=form_error('tanggal_beli', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status_pembelian">Status</label>
                                    <select name="status_pembelian" id="status_pembelian" class="form-control">
                                        <?php if ($stok_masuk->status == "Lunas"): ?>
                                        <option value="Lunas" selected>Lunas</option>
                                        <option value="Hutang">Hutang</option>
                                        <?php elseif ($stok_masuk->status == "Hutang"): ?>
                                        <option value="Hutang" selected>Hutang</option>
                                        <option value="Lunas">Lunas</option>
                                        <?php endif;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <div class="row">
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class=" col-sm col-md col-lg mb-3">
                                        <div class="card border-left-primary shadow h-100 ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Grand Total</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            Rp. <?=$stok_masuk->grand_total;?> </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class=" col-sm col-md col-lg mb-3">
                                        <div class="card border-left-success shadow h-100 ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Nomor Pembelian</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?=$stok_masuk->no_pembelian;?>
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
                                    <label for="catatan">Catatan Pembelian</label>
                                    <textarea class="form-control" name="catatan_pembelian" id="catatan_pembelian"
                                        rows="3"><?=$stok_masuk->catatan_pembelian;?></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="h5 font-weight-bold text-gray-800"> Tambah Produk</div>
                            </div>
                        </div>
                        <hr class="mb-1">
                        <div class="col-md-12 col-xs-12 col-lg-12 ">
                            <div class="row border-bottom align-middle p-2">
                                <div class="col-5 pl-0">
                                    <b>Nama Barang</b>
                                </div>
                                <div class="col-2">
                                    <b>Jumlah</b>
                                </div>
                                <div class="col-2">
                                    <b>Harga Satuan</b>
                                </div>
                                <div class="col-2">
                                    <b>Harga Total</b>
                                </div>
                            </div>
                            <div class="row border-bottom p-2 align-items-center" id="form_produk_masuk1">
                                <div class="col-5 pl-0 ">
                                    <select name="select_produk[]" class="select_produk form-control">
                                        <option value="">Pilih Produk</option>
                                        <?php foreach ($produk as $p): ?>
                                        <option value="<?=$p['id'];?>"><?=$p['nama'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="number" class="jumlah_produk form-control" id="jumlah_produk"
                                        name="jumlah_produk[]" autocomplete="off">
                                </div>
                                <div class="col-2">
                                    <input type="number" class="harga_produk form-control" id="harga_produk"
                                        name="harga_produk[]" autocomplete="off">
                                </div>
                                <div class="col-2">
                                    <input type="number" class="total_produk form-control" id="total_produk"
                                        name="total_produk[]" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12 col-xl-12 mt-2">
                            <a id="tambah_produk" class="btn btn-success">Tambah Produk</a>
                            <a href="<?=base_url('inventori/stokmasuk')?>" class="btn btn-danger float-right ">Batal</a>
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