<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?php echo $this->session->flashdata('message');
    ?>

    <form method="post" action="<?= base_url('laporan/hasilPeramalan') ?>">
        <div class="row">
            <div class="col-9">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-3 text-gray-800">Peramalan Satu Produk</h5>
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
                                    autocomplete="off" required>
                            </div>
                        </div>
                        <small class="col-sm-12 mt-3 text-primary">**Metode peramalan yang digunakan adalah metode
                            Single Moving Average</small>
                        <div class="row float-right" style="display:none ;" id="buttonAksi">
                            <button type="submit" class="btn ml-2 mr-3 btn-primary hitungPeramalan">Hitung
                                Peramalan Produk</button>
                            <a href="#" class="btn btn-danger mr-3 batal" id="batal">Batal </a>
                        </div>
                    </div>
                    <div class="card-body" id="riwayatPenjualan" style="display:none">
                        <h5><b>Data Penjualan Produk</b></h5>
                        <div class="table-responsive">
                            <table class="table table-hover display" id="tableRiwayatPenjualan">
                                <thead>
                                    <tr>
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">Jumlah Terjual</th>
                                    </tr>
                                </thead>
                                <tbody id="dtRiwayat">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="post">
        <div class="row">
            <div class="col-9 mt-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="mb-3 text-gray-800">Peramalan Semua Produk</h5>
                        <div class="form-group row">
                            <label for="tgl_peramalan_semua" class="col-sm-4 col-form-label">Tanggal yang
                                diramalkan</label>
                            <div class="col-sm-8 ">
                                <input type="text" class="form-control date-picker" id="tgl_peramalan_semua"
                                    name="tgl_peramalan_semua" placeholder="Masukkan tanggal yang hendak diramalkan "
                                    autocomplete="off" required>
                            </div>
                        </div>

                        <small class="col-sm-12 mt-3 text-primary">**Metode peramalan yang digunakan adalah metode
                            Single Moving Average</small>

                        <div class="row float-right" style="display:none ;" id="buttonAksiSemua">
                            <button type="submit" class="btn ml-2 mr-3 btn-primary hitungPeramalanSemua">Hitung
                                Peramalan Semua Produk</button>
                            <!-- <a href="#" class="btn ml-2 mr-3 btn-info hitungPeramalanSemua">Hitung Peramalan Semua
                                Produk</a> -->
                            <a href="#" class="btn btn-danger mr-3 batal">Batal </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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
        startView: "months",
        minViewMode: "months"
    });

    $("#tgl_peramalan_semua").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "top",
        startView: "months",
        minViewMode: "months"
    });
    // $("#tgl_awal").datepicker({
    //     format: "yyyy-mm-dd",
    //     autoclose: true,
    //     orientation: "top",

    //     // startView: "months",
    //     // minViewMode: "months"
    // });

    $('.select_produk').change(function() {
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
        // $('.tanggal_awal').show();
        $('#riwayatPenjualan').show();
        $('#moving_average_form').show();
        $('#buttonAksi').show();

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
        // $('.tanggal_awal').show();
        $('#riwayatPenjualan').show();
        $('#moving_average_form').show();
        $('#buttonAksi').show();
        // $('#buttonHitungPeramalanSemuaProduk').show();

    });

    $('#tgl_peramalan_semua').change(function() {
        var _tgl_ramal_semua = $('tgl_peramalan_semua').val();

        $('#buttonAksiSemua').show();

    });

    $('.hitungPeramalan').click(function() {
        var _sparepart = $('#sparepart').val();
        var _tgl_ramal = $('#tgl_peramalan').val();

        $.ajax({
            url: "<?= base_url('laporan/hasilPeramalan'); ?>",
            data: {
                sparepart: _sparepart,
                tgl_peramalan: _tgl_ramal,
            },
            method: "post",
            success: function(data) {},
        });

    });


    $('.hitungPeramalanSemua').click(function() {
        var _tgl_ramal_semua = $('#tgl_peramalan_semua').val();
        $.ajax({
            url: "<?= base_url('laporan/hitungPeramalanSemuaProduk'); ?>",
            data: {
                // sparepart: _sparepart,
                tgl_peramalan: _tgl_ramal_semua,
            },
            method: "post",
            success: function(data) {
                // window.location.href = "peramalan";
                //kalau bisa, tampilkan flash message setelah peramalan
                // $('alert').alert();
            },
        });

    });

    $('.batal').click(function() {
        window.location.href = "peramalan";
    });



});
</script>