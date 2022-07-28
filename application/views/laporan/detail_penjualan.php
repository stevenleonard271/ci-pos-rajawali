<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">

        <div class="col-lg">
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h1 class="h5 mt-2 text-gray-100"><?= $subtitle; ?></h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Nomor
                                    Penjualan</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <b> <?= $detailPenjualan->no_penjualan; ?> </b>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Nama Kasir</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext status">
                                        <?= $detailPenjualan->kasir; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Nama
                                    Mekanik</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext status">
                                        <?= $detailPenjualan->mekanik; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Tanggal Stok
                                    Masuk</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <?= $detailPenjualan->tanggal_penjualan; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Nama
                                    Pelanggan</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <?= $detailPenjualan->pelanggan; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row"><label for="" class="col-sm-6 col-form-label">Motor</label>
                                <div class="col-sm-6">
                                    <div type="text" readonly="readonly" id="" class="form-control-plaintext">
                                        <?php if($detailPenjualan->id_motor==0) :  ?>
                                        <?= "Tidak ada motor"?>
                                        <?php else :?>
                                        <?= $detailPenjualan->motor; ?> || <?= $detailPenjualan->plat; ?>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for=""><b>Catatan Penjualan</b></label>
                                <textarea name="" id="" rows="3" readonly="readonly" disabled="disabled"
                                    class="form-control bg-white"><?= $detailPenjualan->keterangan; ?>
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
                                    <?php foreach ($penjualan_produk as $smp) : ?>
                                    <tr>
                                        <?php foreach ($produk as $p) : ?>
                                        <?php if ($smp->id_produk == $p['id']) : ?>
                                        <td>
                                            <?= $p['nama']; ?>
                                        </td>
                                        <td><?= $smp->jumlah; ?></td>
                                        <td>
                                            <?= rupiah($p['harga_jual']); ?>
                                        </td>
                                        <td><?= rupiah($smp->jumlah * $p['harga_jual']);  ?></td>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3">
                                            <h6><b>Diskon</b></h6>
                                        </td>
                                        <td> <?= rupiah($detailPenjualan->diskon); ?> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <h6><b>Ongkos Mekanik</b></h6>
                                        </td>
                                        <td> <?= rupiah($detailPenjualan->ongkos); ?> </td>
                                    </tr>
                                    <tr class="bg-dark">
                                        <td colspan="3">
                                            <h6 style="color: white;"><b>Total Pembelian</b></h6>
                                        </td>
                                        <td style="color: white;"> <?= rupiah($detailPenjualan->grand_total); ?> </td>
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

<?php function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}


?>
<script>

</script>