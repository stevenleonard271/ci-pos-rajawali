<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col-lg-6">

            <!-- Error Flash Data -->
            <?=form_error('kategori', '<div class="alert alert-danger" role="alert">', '</div>');?>

            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="" class="btn btn-primary mb-3 tombolTambahKategori" data-toggle="modal"
                data-target="#newKategoriModal">Tambah Kategori</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Kategori</th>
                        <th scope="col">Jumlah Produk</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    <?php foreach ($kategori as $k): ?>
                    <tr>
                        <th scope="row"><?=$i++;?></th>
                        <td><?=$k['nama'];?></td>
                        <td><?=$k['jumlah_produk'];?></td>
                        <td>
                            <a href="<?=base_url('produk/ubahKategori/' . $k['id']);?>"
                                class="badge badge-success tampilModalUbahKategori" data-toggle="modal"
                                data-target="#newKategoriModal" data-id="<?=$k['id'];?>">Edit</a>
                            <a href="<?=base_url('produk/hapusKategori/' . $k['id']);?>" class="badge badge-danger"
                                onclick="return confirm('Yakin hendak menghapus?');">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach;?>

                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Menu Modal -->
<div class="modal fade" id="newKategoriModal" tabindex="-1" role="dialog" aria-labelledby="newKategoriModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKategoriModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('produk/kategori');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="kategori" name="kategori"
                            placeholder="Nama kategori">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>