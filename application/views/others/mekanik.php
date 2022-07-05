<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?=$title;?></h1>


    <div class="row">
        <div class="col">

            <!-- Error Flash Data -->
            <?=form_error('mekanik', '<div class="alert alert-danger" role="alert">', '</div>');?>
            <?=form_error('no_mekanik', '<div class="alert alert-danger" role="alert">', '</div>');?>
            <?=form_error('alamat_mekanik', '<div class="alert alert-danger" role="alert">', '</div>');?>
            <?=form_error('persentase_ongkos', '<div class="alert alert-danger" role="alert">', '</div>');?>


            <!-- Success Flash Data -->
            <?=$this->session->flashdata('message');?>

            <a href="" class="btn btn-primary mb-3 tombolTambahMekanik" data-toggle="modal"
                data-target="#newMekanikModal">Tambah Mekanik</a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Mekanik</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Persentase Ongkos(%)</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach ($mekanik as $m): ?>
                        <tr>
                            <th scope="row"><?=$i++;?></th>
                            <td><?=$m['nama'];?></td>
                            <td><?=$m['nomor'];?></td>
                            <td><?=$m['alamat'];?></td>
                            <td><?=$m['persentase_ongkos'];?></td>
                            <td>
                                <a href="<?=base_url('others/ubahMekanik/' . $m['id']);?>"
                                    class="badge badge-success tampilModalUbahMekanik" data-toggle="modal"
                                    data-target="#newMekanikModal" data-id="<?=$m['id'];?>">Edit</a>
                                <a href="<?=base_url('others/hapusMekanik/' . $m['id']);?>" class="badge badge-danger"
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
<div class="modal fade" id="newMekanikModal" tabindex="-1" role="dialog" aria-labelledby="newMekanikModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMekanikModalLabel">Tambah Mekanik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url('others/mekanik');?>" method="post">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" class="form-control" id="mekanik" name="mekanik" placeholder="Nama mekanik">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="no_mekanik" name="no_mekanik"
                            placeholder="Nomor mekanik">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="alamat_mekanik" name="alamat_mekanik"
                            placeholder="Alamat mekanik">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="persentase_ongkos" name="persentase_ongkos"
                            placeholder="Persentase ongkos">
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