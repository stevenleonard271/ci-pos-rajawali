<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">

        <div class="col-lg">
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h1 class="h5 mt-2 text-gray-100"><?= $subTitle; ?></h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Nomor Stok
                                    Keluar</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <b> <?= $stok_keluar->no_keluar; ?> </b>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Tanggal Stok
                                    Keluar</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <?= $stok_keluar->tanggal_keluar; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for=""><b>Catatan Barang Keluar</b></label>
                                <textarea name="" id="" rows="3" readonly="readonly" disabled="disabled"
                                    class="form-control bg-white"><?= $stok_keluar->catatan_keluar; ?>
                                </textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card rounded-0 shadow-none">
                        <div class="card-body">
                            <table class="table" id="tableStokKeluar">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah</th>
                                        <th>Alasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stok_keluar_produk as $skp) : ?>
                                    <tr>
                                        <?php foreach ($produk as $p) : ?>
                                        <?php if ($skp->id_produk == $p['id']) : ?>
                                        <td>
                                            <?= $p['nama']; ?>
                                        </td>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td><?= $skp->jumlah_produk; ?></td>
                                        <td>
                                            <?= $skp->alasan;  ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->