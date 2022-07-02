<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>

    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 col-sm-4 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Produk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$hitungProduk->jumlah_produk;?>
                                Produk</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 col-sm-4 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Produk Terbaru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$produkBaru->nama;?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-archive fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-4 col-md-6 col-sm-4 mb-3">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase ">
                                Jumlah Produk yang akan habis
                                <a class="badge badge-success ml-3 py-2" id="lihatData">Lihat Data</a>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?=$hitungProdukKritis->produk_kritis;?> Produk
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mb-4 border-left-danger">
                <div class="card-body" id="newsHeading">
                    <div class="h6 mb-3 font-weight-bold text-danger text-uppercase">
                        Stok Produk yang Menipis
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <table class="table table-bordered" id="stok_kritis">
                        <thead>
                            <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Batas Minimal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($produkKritis as $pk): ?>
                            <tr>
                                <td><?=$pk->nama;?></td>
                                <td><?=$pk->jumlah;?></td>
                                <td><?=$pk->batas_bawah;?></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-lg col-sm">


            <?php if (validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?=validation_errors();?>
            </div>
            <?php endif;?>

            <!-- Error Flash Data -->
            <?=form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>');?>

            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="<?=base_url('produk/baru');?>" class="btn btn-primary mb-3">Tambah Produk</a>


            <div class="table-responsive">

                <table class="table table-hover display" id="table-sub-menu">
                    <thead>
                        <tr>
                            <th scope="col">Kode Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Stok tersedia</th>
                            <th scope="col">Terjual</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($produk as $p): ?>
                        <tr>
                            <th scope="row">
                                <?=$p['kode'];?>
                            </th>
                            <td><?=$p['nama'];?></td>
                            <td><?=$p['nama_kategori'];?></td>
                            <td><?=$p['jumlah'];?></td>
                            <td>Belum</td>
                            <td><?=$p['harga_jual'];?></td>
                            <td>
                                <a href="<?=base_url('produk/ubahProduk/' . $p['id']);?>" class="badge badge-success"
                                    id="editProduk">Edit</a>
                                <a href="<?=base_url('produk/hapusProduk/' . $p['id']);?>" class="badge badge-danger"
                                    onclick="return confirm('Yakin hendak menghapus?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <?php /*  <?=$this->pagination->create_links();?> */?>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->