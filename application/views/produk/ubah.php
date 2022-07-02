<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800" id="titleHide"><?=$title;?></h1>

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="h5 mt-2 text-gray-100"><?=$subTitle;?></h1>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <input type="hidden" name="id" id="id" value="<?=$produk->id;?>">
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                        value="<?=$produk->nama;?>">
                                    <?=form_error('nama', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori Produk</label>
                                    <select name="kategori" id="select_kategori" class="form-control">
                                        <?php foreach ($kategori as $k): ?>
                                        <option value="<?=$k["id"];?>"
                                            <?php if ($k['id'] == $produk->IdKategori): ?>selected <?php endif;?>>
                                            <?=$k['nama'];?>
                                        </option>
                                        <?php endforeach;?>
                                    </select>
                                    <?=form_error('kategori', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="kode">Kode Produk</label>
                                    <input type="text" class="form-control" id="kode" name="kode" autocomplete="off"
                                        value="<?=$produk->kode;?>">
                                    <?=form_error('kode', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="batas_bawah">Peringatan batas bawah stok produk</label>
                                    <input type="number" class="form-control" id="batas_bawah" name="batas_bawah"
                                        autocomplete="off" value="<?=$produk->batas_bawah;?>">
                                    <?=form_error('batas_bawah', ' <small class="text-danger"> ', '</small> <br>');?>
                                    <small class="text-primary">
                                        **Batas bawah (jumlah minimal) untuk
                                        memberikan peringatan, ketika stok sudah
                                        kurang dari batas
                                    </small>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli Produk</label>
                                    <input type="number" class="form-control" id="harga_beli" name="harga_beli"
                                        autocomplete="off" value="<?=$produk->harga_beli;?>">
                                    <?=form_error('harga_beli', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual Produk</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                        autocomplete="off" value="<?=$produk->harga_jual;?>">
                                    <?=form_error('harga_jual', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                                <div class="form-group">
                                    <label for="laba">Laba Jual Produk</label>
                                    <input type="number" class="form-control" id="laba" name="laba" value="<?=$laba;?>"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok saat ini</label>
                                    <input type="number" class="form-control" id="stok" name="stok" autocomplete="off"
                                        value="<?=$produk->jumlah;?>">
                                    <?=form_error('stok', ' <small class="text-danger"> ', '</small>');?>
                                </div>
                            </div>
                            <button type="submit" class="btn ml-2 mr-3 btn-primary" name="ubah">Ubah Produk</button>
                            <a href="<?=base_url('produk')?>" class="btn btn-danger">Batal </a>
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