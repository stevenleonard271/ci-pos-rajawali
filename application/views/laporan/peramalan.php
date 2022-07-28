<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-7">
            <form action="<?= base_url('laporan/hitungPeramalan') ?>" method="post">
                <div class="card shadow">
                    <div class="card-body">
                        <!-- <small class="col-sm-12 mt-3 text-primary">**Metode peramalan yang digunakan adalah metode
                            Single Moving Average</small> -->
                        <div class="form-group row">

                            <label for="sparepart" class="col-sm-4 col-form-label">Sparepart</label>
                            <div class="col-sm-8 ">
                                <select name="sparepart" id="sparepart" class="select_produk form-control">
                                    <option value="">Masukkan nama produk</option>
                                    <?php foreach ($produk as $pro) : ?>
                                    <option value="<?= $pro['id']; ?>"><?= $pro['nama'] . ' || ' ?>
                                        <strong><?= 'Kategori ' . $pro['nama_kategori'] ?></strong>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_peramalan" class="col-sm-4 col-form-label">Tanggal yang
                                diramalkan</label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control date-picker" id="tgl_peramalan"
                                    name="tgl_peramalan" placeholder="Masukkan tanggal yang hendak diramalkan "
                                    autocomplete="off">
                            </div>

                        </div>
                        <div class="form-group row tanggal_awal" style="display:none">
                            <label for="tanggal_peramalan" class="col-sm-4 col-form-label"> Batas Tanggal awal
                            </label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control date-picker" id="tgl_awal" name="tgl_awal"
                                    placeholder="Masukkan batas awal tanggal pengambilan data " autocomplete="off">
                            </div>

                        </div>
                        <div class="form-group row" hidden>
                            <label for="moving_average" class="col-sm-4 col-form-label">Moving average</label>
                            <div class="col-sm-8 ">
                                <select name="moving_average" id="moving_average" class="form-control">
                                    <option value="">Masukkan Moving Average</option>
                                    <option value=3>3</option>
                                    <option value=4>4</option>
                                    <option value=5>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row float-right" hidden>
                            <button type="button" class="btn ml-2 mr-3 btn-primary">Cek Data Peramalan</button>
                            <a href="<?= base_url('laporan/peramalan') ?>" class="btn btn-danger mr-3">Batal </a>
                        </div>
                    </div>
                    <div class="card-body" id="riwayatPenjualan" style="display:none">
                        <h5><b>Data Penjualan Produk</b></h5>
                        <div class="table-responsive">
                            <table class="table table-hover display" id="tableRiwayatPenjualan">
                                <thead>
                                    <tr>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Jumlah Terjual</th>
                                    </tr>
                                </thead>
                                <tbody id="dtRiwayat">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
$(document).ready(function() {

    $("#tgl_peramalan").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "top",

        // startView: "months",
        // minViewMode: "months"
    });
    $("#tgl_awal").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "top",

        // startView: "months",
        // minViewMode: "months"
    });

    $('#tgl_peramalan').change(function() {
        var _sparepart = $('#sparepart').val();
        var _tgl_ramal = $('#tgl_peramalan').val();
        $.ajax({
            url: "<?= base_url('laporan/riwayatPenjualan'); ?>",
            data: {
                sparepart: _sparepart,
                tgl_ramal: _tgl_ramal,
            },
            method: "post",
            success: function(data) {
                $('#dtRiwayat').html(data)
            },
        });
        // alert('hehe');
        $('.tanggal_awal').show();
        $('#riwayatPenjualan').show();
    });

});
</script>