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
            <?= form_error('stokkeluar', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <!-- Success Flash Data -->
            <?= $this->session->flashdata('message'); ?>

            <a href="<?= base_url('inventori/stokkeluarbaru'); ?>" class="btn btn-primary mb-3">Tambah Stok Keluar</a>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Barang Keluar</th>
                            <th scope="col">Nomor Barang Keluar</th>
                            <th scope="col">Dibuat pada</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stokkeluar as $s) : ?>
                            <tr>
                                <td><?= $s['tanggal_keluar']; ?></td>
                                <td><a href="<?= base_url('inventori/detailStokKeluar/' . $s['id']); ?> "><?= $s['no_keluar']; ?></a></td>
                                <td><?= $s['created_at']; ?></td>
                                <td>
                                    <a href="<?= base_url('inventori/ubahStokKeluar/' . $s['id']); ?>" class="badge badge-success">Edit</a>

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