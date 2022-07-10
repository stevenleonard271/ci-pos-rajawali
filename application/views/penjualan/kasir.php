<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-6">
      <div class="card shadow">
        <div class="card-body">
          <div class="form-group row">
            <label for="tanggal_penjualan" class="col-sm-4 col-form-label">Tanggal</label>
            <div class="col-sm-8 ">
              <input type="text" class="form-control date" id="tgl_penjualan" name="tgl_penjualan" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="kasir" class="col-sm-4 col-form-label">Kasir</label>
            <div class="col-sm-8 ">
              <input type="text" class="form-control date" id="kasir" name="kasir" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
            <div class="col-sm-8 ">
              <select name="pelanggan" id="pelanggan" class="select form-control" required>
                <option value="">Pilih Pelanggan</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-6">
      <div class="card shadow">
        <div class="card-body">
          <div class="form-group row">
            <label for="sparepart" class="col-sm-4 col-form-label">Sparepart</label>
            <div class="col-sm-8 ">
              <select name="sparepart" id="sparepart" class="select form-control" required>
                <option value="">Masukkan nama sparepart</option>
              </select>
            </div>
          </div>
          <button type="button" id="tambah_produk" onclick="addSlot()" class="btn btn-success">Tambah Sparepart</button>
        </div>
      </div>
    </div>
    <div class="col-12 mt-3">
      <div class="card shadow">
        <div class="card-body row">
          <div class="col-6">
            <h3><strong>Grand Total</strong> | #</h3>
          </div>
          <div class="col-6 float-right">
            <h3>Rp,0.0</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-12">
      <div class="card shadow">
        <div class="card-body p-2">
          <table class="table table-stripped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Barang</th>
                <th scope="col" width="200px">Jumlah</th>
                <th scope="col">Harga Satuan</th>
                <th scope="col">Harga Total</th>
                <th scope="col" width="200px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="6" class="text-center"><b>Masukkan item yang dibeli</b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label for="mekanik" class="col-sm-4 col-form-label">Mekanik</label>
            <div class="col-sm-8">
              <select name="mekanik" id="mekanik" class="select form-control" required>
                <option value="">Masukkan nama mekanik</option>
              </select>
            </div>
          </div>
          <div class="form-group row"><label for="servis" class="col-sm-4 col-form-label">Biaya Service</label>
            <div class="col-sm-8"><input type="text" id="servis" name="servis" class="form-control shadow-none"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group row"><label for="" class="col-sm-4 col-form-label">Sub total</label>
            <div class="col-sm-8">
              <div disabled="disabled" readonly="readonly" class="form-control shadow-none">
                Rp 0,00
              </div>
            </div>
          </div>
          <div class="form-group row"><label for="" class="col-sm-4 col-form-label">Discount</label>
            <div class="col-sm-8"><input type="text" class="form-control shadow-none"></div>
          </div>
          <div class="form-group row"><label for="" class="col-sm-4 col-form-label">Harga Total</label>
            <div class="col-sm-8">
              <div disabled="disabled" readonly="readonly" class="form-control shadow-none">
                Rp 0,00
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <div class="form-group row"><label for="" class="col-sm-4 col-form-label">Keterangan</label>
            <div class="col-sm-8"><input type="text" class="form-control shadow-none" value="-"></div>
          </div>
          <div class="row">
            <div class="col-6"><button class="btn btn-block btn-primary btn-flat">
                Simpan
              </button></div>
            <div class="col-6"><button class="btn btn-block btn-danger btn-flat">
                Clear
              </button></div>
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

//generate Code Pembelian
function generateCode($order)
{

  date_default_timezone_set('Asia/Jakarta');
  $name = "ORD";
  $today = date('dmy');
  $order = $order + 1;

  $order = sprintf('%04d', $order);

  $code = $name . $today . $order;

  echo $code;
}
?>

<script>
  //DATEPICKER
  $(document).ready(function() {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + "-" + mm + "-" + dd;
    $("#tgl_penjualan").val(today);
    $("#tgl_penjualan").on("change", function() {
      var selected = $(this).val();
      // console.log(selected);
    });

  });
</script>