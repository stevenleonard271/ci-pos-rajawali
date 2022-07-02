<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col-lg-6">

            <!-- Error Flash Data -->
            <?=form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>');?>

            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="" class="btn btn-primary mb-3 tombolTambahMenu" data-toggle="modal"
                data-target="#newMenuModal">Tambah Menu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Urutan</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    <?php foreach ($menu as $m): ?>
                    <tr>
                        <th scope="row"><?=$i++;?></th>
                        <td><?=$m['menu']?></td>
                        <td><?=$m['urutan']?></td>
                        <td>
                            <a href="<?=base_url('menu/ubahMenu/' . $m['id']);?>"
                                class="badge badge-success tampilModalUbahMenu" data-toggle="modal"
                                data-target="#newMenuModal" data-id="<?=$m['id'];?>">Edit</a>
                            <a href="<?=base_url('menu/hapusMenu/' . $m['id']);?>" class="badge badge-danger"
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
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Nama Menu">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="urutan" name="urutan" placeholder="Urutan">
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