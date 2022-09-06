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
                                    Masuk</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <b> <?= $stok_masuk->no_pembelian; ?> </b>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Status
                                    Pembelian</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext status">
                                        <?= $stok_masuk->status; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Tanggal Stok
                                    Masuk</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <?= $stok_masuk->tanggal_pembelian; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Nama
                                    Supplier</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <?= $stok_masuk->nama_supplier; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for=""><b>Catatan Pembelian</b></label>
                                <textarea name="" id="" rows="3" readonly="readonly" disabled="disabled"
                                    class="form-control bg-white"><?= $stok_masuk->catatan_pembelian; ?>
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
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jumlah Pembelian</th>
                                        <th>Harga Pembelian</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($stok_masuk_produk as $smp) : ?>
                                    <tr>
                                        <?php foreach ($produk as $p) : ?>
                                        <?php if ($smp->id_produk == $p['id']) : ?>
                                        <td>
                                            <?= $p['nama']; ?>
                                        </td>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <td><?= $smp->jumlah_produk; ?></td>
                                        <td>
                                            <?= rupiah($smp->harga_produk); ?>
                                        </td>
                                        <td><?= rupiah($smp->total_produk);  ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr class="bg-dark">
                                        <td colspan="3">
                                            <h6 style="color: white;"><b>Total Pembelian</b></h6>
                                        </td>
                                        <td style="color: white;"> <?= rupiah($stok_masuk->grand_total); ?> </td>
                                    </tr>
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

<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>
<script>

</script>