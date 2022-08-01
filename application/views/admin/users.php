<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col">

            <!-- Error Flash Data -->
            <?=form_error('role', '<div class="alert alert-danger" role="alert">', '</div>');?>

            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="" class="btn btn-primary mb-3 tombolTambahUser" data-toggle="modal"
                data-target="#newUserModal">Tambah User</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">User</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;?>
                    <?php foreach ($users as $r): ?>
                    <tr>
                        <th scope="row"><?=$i++;?></th>
                        <td><?=$r['nama'];?></td>
                        <td><?=$r['email'];?></td>
                        <td><?=$r['role'];?></td>
                        <td>
                            <a href="<?=base_url('admin/ubahRole/' . $r['id']);?>"
                                class="badge badge-success tampilModalUbahRole" data-toggle="modal"
                                data-target="#newRoleModal" data-id="<?=$r['id'];?>">Edit</a>
                            <a href="<?=base_url('admin/hapusRole/' . $r['id']);?>" class="badge badge-danger"
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
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('admin/users');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama User">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="password" name="password"
                            placeholder="Password User">
                    </div>
                    <div class="form-group">
                        <select name="role" class="form-control">
                            <option value="">Pilih Role</option>
                            <?php foreach ($role as $r): ?>
                            <option value="<?=$r['id'];?>"><?=$r['role'];?></option>
                            <?php endforeach;?>
                        </select>
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