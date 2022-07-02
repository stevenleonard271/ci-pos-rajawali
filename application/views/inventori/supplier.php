<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col-lg ">

            <?php if (validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?=validation_errors();?>
            </div>
            <?php endif;?>


            <!-- Error Flash Data -->
            <?=form_error('supplier', '<div class="alert alert-danger" role="alert">', '</div>');?>

            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="" class="btn btn-primary mb-3 tombolTambahSupplier" data-toggle="modal"
                data-target="#newSupplierModal">Tambah Supplier</a>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Nomor Supplier </th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach ($supplier as $s): ?>
                        <tr>
                            <th scope="row"><?=$i++;?></th>
                            <td><?=$s['nama'];?></td>
                            <td><?=$s['nomor'];?></td>
                            <td><?=$s['deskripsi'];?></td>
                            <td>
                                <a href="<?=base_url('inventori/ubahSupplier/' . $s['id']);?>"
                                    class="badge badge-success tampilModalUbahSupplier" data-toggle="modal"
                                    data-target="#newSupplierModal" data-id="<?=$s['id'];?>">Edit</a>
                                <a href="<?=base_url('inventori/hapusSupplier/' . $s['id']);?>"
                                    class="badge badge-danger"
                                    onclick="return confirm('Yakin hendak menghapus?');">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach;?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Menu Modal -->
<div class="modal fade" id="newSupplierModal" tabindex="-1" role="dialog" aria-labelledby="newSupplierModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSupplierModalLabel">Tambah Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('inventori/supplier');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama supplier"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Nomor supplier"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="deskripsi" rows="3" name="deskripsi"
                            placeholder="Deskripsi Supplier"></textarea>
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