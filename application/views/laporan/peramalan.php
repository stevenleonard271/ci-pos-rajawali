<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-7">
            <div class="card shadow">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="sparepart" class="col-sm-4 col-form-label">Sparepart</label>
                        <div class="col-sm-8 ">
                            <select name="sparepart" id="sparepart" class="select_produk form-control">
                                <option value="">Masukkan nama sparepart</option>
                                <?php foreach ($produk as $pro) : ?>
                                    <option value="<?= $pro['id']; ?>"><?= $pro['nama'] . ' || ' ?> <strong><?= 'Kategori ' . $pro['nama_kategori'] ?></strong></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_peramalan" class="col-sm-4 col-form-label">Bulan Peramalan</label>
                        <div class="col-sm-8 ">
                            <input type="text" class="form-control date-picker" id="tgl_peramalan" name="tgl_peramalan" placeholder="Masukkan bulan yang hendak diramalkan ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="moving_average" class="col-sm-4 col-form-label">Moving average</label>
                        <div class="col-sm-8 ">
                            <select name="moving_average" id="moving_average" class="form-control">
                                <option value="">Masukkan Moving Average</option>
                                <option value=3>3</option>
                                <option value=4>4</option>
                                <option value=5>5</option>
                            </select>
                        </div>
                        <small class="col-sm-12 mt-3 text-primary">**Metode peramalan yang digunakan adalah metode Single Moving Average</small>
                    </div>
                    <div class="row float-right">
                        <button type="submit" class="btn ml-2 mr-3 btn-primary">Hitung Peramalan</button>
                        <a href="<?= base_url('laporan/peramalan') ?>" class="btn btn-danger mr-3">Batal </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function() {


        $("#tgl_peramalan").datepicker({
            format: "yyyy-mm",
            autoclose: true,
            orientation: "top",
            endDate: "today",
        });


    });
</script>