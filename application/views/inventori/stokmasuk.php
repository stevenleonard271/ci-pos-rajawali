<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="row">
        <div class="col-lg ">

            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>


            <!-- Error Flash Data -->
            <?= form_error('stokmasuk', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <!-- Success Flash Data -->
            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('inventori/stokmasukbaru'); ?>" class="btn btn-primary mb-3">Tambah Stok Masuk</a>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Pembelian</th>
                            <th scope="col">Nomor Pembelian</th>
                            <th scope="col">Supplier </th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibuat pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stokmasuk as $s) : ?>
                            <tr>
                                <td><?= $s['tanggal_pembelian']; ?></td>
                                <td><a href="<?= base_url('inventori/detailStokMasuk/' . $s['id']); ?> "><?= $s['no_pembelian']; ?></a></td>
                                <td><?= $s['nama_supplier']; ?></td>
                                <td><?php if ($s['status'] == "Lunas") : ?>
                                        <span class="badge badge-success"><?= $s['status']; ?></span>
                                    <?php elseif ($s['status'] == "Hutang") : ?>
                                        <span class="badge badge-danger"><?= $s['status']; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $s['created_at']; ?></td>
                                <td>
                                    <a href="<?= base_url('inventori/ubahStokMasuk/' . $s['id']); ?>" class="badge badge-info">Edit</a>
                                    <!-- <a href="<?php //base_url('inventori/hapusStokMasuk/' . $s['id']);
                                                    ?>"
                                    class="badge badge-danger"
                                    onclick="return confirm('Yakin hendak menghapus?');">Hapus</a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->