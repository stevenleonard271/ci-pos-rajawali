<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col-lg col-sm-10">

            <?php if (validation_errors()): ?>
            <div class="alert alert-danger" role="alert">
                <?=validation_errors();?>
            </div>
            <?php endif;?>

            <!-- Error Flash Data -->
            <?=form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>');?>

            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>


            <a href="" class="btn btn-primary mb-3  tombolTambahSubMenu" data-toggle="modal"
                data-target="#newSubMenuModal">Tambah Submenu</a>
            <div class="table-responsive">
                <table class="table table-hover" id="table-sub-menu">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Url</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Active</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $i = 1;?>
                        <?php foreach ($subMenu as $sm): ?>
                        <tr>
                            <th scope="row">
                                <?=$i++;?>
                            </th>
                            <td><?=$sm['judul'];?></td>
                            <td><?=$sm['menu'];?></td>
                            <td><?=$sm['url'];?></td>
                            <td><?=$sm['icon'];?></td>
                            <td><?=$sm['is_active'];?></td>
                            <td>
                                <a href="<?=base_url('menu/ubahSubMenu/' . $sm['id']);?>"
                                    class="badge badge-success tampilModalUbahSubMenu" data-toggle="modal"
                                    data-target="#newSubMenuModal" data-id="<?=$sm['id'];?>">Edit</a>
                                <a href="<?=base_url('menu/hapusSubMenu/' . $sm['id']);?>" class="badge badge-danger"
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('menu/submenu');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Judul Submenu">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Pilih Menu</option>
                            <?php foreach ($menu as $m): ?>
                            <option value="<?=$m['id'];?>"><?=$m['menu'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url Submenu">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon Submenu">
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value=1>
                            <label class="form-check-label" for="is_active">
                                Active?
                            </label>
                        </div>
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