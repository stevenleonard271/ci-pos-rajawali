<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col">

            <!-- Error Flash Data -->
            <?=form_error('pelanggan', '<div class="alert alert-danger" role="alert">', '</div>');?>


            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="" class="btn btn-primary mb-3 tombolTambahPelanggan" data-toggle="modal"
                data-target="#newPelangganModal">Tambah Pelanggan</a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">No. HP Pelanggan</th>
                            <th scope="col">Jumlah Motor</th>
                            <th scope="col">Tanggal diperbarui</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach ($pelanggan as $p): ?>
                        <tr>
                            <th scope="row"><?=$i++;?></th>
                            <td><a href=""><?=$p['nama'];?></a></td>
                            <td><?=$p['nomor'];?></td>
                            <td>Coba</td>
                            <td><?=$p['updated_at'];?></td>
                            <td>
                                <a href="<?=base_url('others/tambahMotor/' . $p['id']);?>"
                                    class="badge badge-warning tampilModaltambahMotor" data-toggle="modal"
                                    data-target="#newMotorModal" data-id="<?=$p['id'];?>">Tambah Motor</a>
                                <a href="<?=base_url('others/ubahPelanggan/' . $p['id']);?>"
                                    class="badge badge-success tampilModalUbahPelanggan" data-toggle="modal"
                                    data-target="#newPelangganModal" data-id="<?=$p['id'];?>">Edit</a>
                                <a href="<?=base_url('others/hapusPelanggan/' . $p['id']);?>" class="badge badge-danger"
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
<div class="modal fade" id="newPelangganModal" tabindex="-1" role="dialog" aria-labelledby="newPelangganModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPelangganModalLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('others/pelanggan');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="pelanggan" name="pelanggan"
                            placeholder="Nama Pelanggan" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="no_pelanggan" name="no_pelanggan"
                            placeholder="Nomor Pelanggan" autocomplete="off">
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
<!-- Menu Modal -->
<div class="modal fade" id="newMotorModal" tabindex="-1" role="dialog" aria-labelledby="newMotorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMotorModalLabel">Tambah Motor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('others/pelanggan');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                            autocomplete="off" disabled>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="jenis_motor" name="jenis_motor"
                            placeholder="Jenis Motor" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="plat_motor" name="plat_motor"
                            placeholder="Plat Motor" autocomplete="off">
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