<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Tanggal Penjualan</th>
                        <th scope="col">Kode Penjualan</th>
                        <th scope="col">Kasir</th>
                        <th scope="col">Pembeli</th>
                        <th scope="col">Dibuat Pada</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($penjualan as $p) : ?>
                        <tr>
                            <td><?= $p->tanggal_penjualan; ?></td>
                            <td><a href="<?= base_url('laporan/penjualan'); ?> "><?= $p->no_penjualan; ?></a></td>
                            <td><?= $p->kasir; ?></td>
                            <td><?= $p->pelanggan; ?></td>
                            <td><?= $p->created_at; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->