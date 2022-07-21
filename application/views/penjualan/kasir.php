<!-- Begin Page Content -->
<form action="<?= base_url('penjualan/tambahPenjualan') ?>" method="post">
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
      <div class="col-6">
        <div class="card shadow">
          <div class="card-body">
            <div class="form-group row">
              <input type="hidden" name="no_penjualan" id="no_penjualan" value="<?php generateCode($countReceipt); ?>" />
              <label for="tanggal_penjualan" class="col-sm-4 col-form-label">Tanggal</label>
              <div class="col-sm-8 ">
                <input type="text" class="form-control" id="tgl_penjualan" name="tgl_penjualan" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="kasir" class="col-sm-4 col-form-label">Kasir</label>
              <div class="col-sm-8 ">
                <input type="text" class="form-control date" id="kasir" name="kasir" value="<?= $user['nama']; ?>" readonly>
              </div>
            </div>
            <div class="form-group row">
              <label for="pelanggan" class="col-sm-4 col-form-label">Pelanggan</label>
              <div class="col-sm-8 ">
                <select name="pelanggan" id="pelanggan" class="select_pelanggan form-control" required>
                  <option value="">Pilih Pelanggan</option>
                  <?php foreach ($pelanggan as $pel) : ?>
                    <option value="<?= $pel['id']; ?>"><?= $pel['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row select_mtr" style="display: none;">
              <label for="motor" class="col-sm-4 col-form-label">Motor</label>
              <div class="col-sm-8 ">
                <select name="motor" id="motor" class="select_motor form-control">
                  <option value="">Pilih Motor</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6" id="sparepartForm" style="display: none;">
        <div class="card shadow">
          <div class="card-body">
            <div class="form-group row">
              <label for="sparepart" class="col-sm-4 col-form-label">Sparepart</label>
              <div class="col-sm-8 ">
                <select name="sparepart" id="sparepart" class="select_produk form-control">
                  <option value="">Masukkan nama sparepart</option>
                  <?php foreach ($produk as $pro) : ?>
                    <option value="<?= $pro['id']; ?>"><?= $pro['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row detail_pro" style="display: none;">
              <label for="harga_pro" class="col-sm-4 col-form-label">Harga</label>
              <div class="col-sm-8 ">
                <input type="number" class="form-control" id="harga_pro" name="harga_pro" readonly>
              </div>
            </div>
            <div class="form-group row detail_pro" style="display: none;">
              <label for="jumlah_pro" class="col-sm-4 col-form-label">Jumlah</label>
              <div class="col-sm-8 ">
                <input type="number" class="form-control" id="jumlahPro" hidden>
                <input type="number" class="form-control" id="jumlah_pro" name="jumlah_pro" value=1>
              </div>
            </div>
            <button type="button" class="btn btn-success addsparepart" disabled>Tambah Sparepart</button>
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
              <h3><span id="grandttl">Rp.0</span>
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-12">
        <div class="card shadow">
          <div class="card-body p-2">
            <table class="table table-stripped table-bordered" id="tableBarang">
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
              <tbody class="data-cart" id="data">
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
                <select name="mekanik" id="mekanik" class="select_mekanik form-control" required>
                  <option value="">Masukkan nama mekanik</option>
                  <?php foreach ($mekanik as $mek) : ?>
                    <option value="<?= $mek['id']; ?>"><?= $mek['nama']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group row"><label for="biaya_servis" class="col-sm-4 col-form-label">Biaya Service</label>
              <div class="col-sm-8"><input type="number" id="biaya_servis" name="biaya_servis" class="form-control shadow-none" value=0></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <div class="form-group row"><label for="subtotal" class="col-sm-4 col-form-label">Sub total</label>
              <div class="col-sm-8">
                <div disabled="disabled" id="subtotal" readonly="readonly" class="form-control shadow-none">
                  Rp 0,00
                </div>
                <input type="number" name="subtotal" id="subtotal_form" hidden>
              </div>
            </div>
            <div class="form-group row"><label for="diskon" class="col-sm-4 col-form-label">Discount</label>
              <div class="col-sm-8"><input type="number" name="diskon" id="diskon" class="form-control shadow-none" value=0></div>
            </div>
            <div class="form-group row"><label for="hargatotal" class="col-sm-4 col-form-label">Harga Total</label>
              <div class="col-sm-8">
                <div disabled="disabled" readonly="readonly" id="hargatotal" class="form-control shadow-none">
                  Rp 0,00
                </div>
                <input type="number" name="grandtotal" id="grandtotal_form" hidden>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <div class="form-group row"><label for="keterangan" class="col-sm-4 col-form-label">Keterangan</label>
              <div class="col-sm-8"><input type="text" name="keterangan" class="form-control shadow-none" value="-"></div>
            </div>
            <div class="row">
              <div class="col-6"><button type="submit" class="btn btn-block btn-primary btn-flat" type="submit">
                  Simpan
                </button></div>
              <div class="col-6"><a href="<?= base_url('penjualan/kasir') ?>" class="btn btn-block btn-danger btn-flat">
                  Batal
                </a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</form>
</div>
<!-- End of Main Content -->


<?php

//generate Code Pembelian
function generateCode($order)
{

  date_default_timezone_set('Asia/Jakarta');
  $name = "#ORD";
  $today = date('dmy');
  $order = $order + 1;

  $order = sprintf('%04d', $order);

  $code = $name . $today . $order;

  echo $code;
}
?>

<script>
  //menampilkan grand total
  function grandttl(idpelanggan, biayaservis, diskon) {

    $.ajax({
      url: "<?= base_url('penjualan/grandTotal'); ?>",
      data: {
        pelanggan: idpelanggan,
        biayaservis: biayaservis,
        diskon: diskon
      },
      method: "post",
      success: function(data) {
        //delimiter format
        currencyDelimiter = Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0,
        }).format(data);

        currencyDelimiter = Number.isNaN(data) ? 'Rp 0' : currencyDelimiter;
        $("#grandttl").html(currencyDelimiter);
        $("#hargatotal").html(currencyDelimiter);
        $('#grandtotal_form').val(data);
        var subtotal = parseInt(data - $('#biaya_servis').val()) + parseInt($('#diskon').val());

        currencySubtotal = Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0,
        }).format(subtotal);
        $("#subtotal").html(currencySubtotal);
        $('#subtotal_form').val(subtotal);
      },
    });

  }


  //menampilkan cart list
  function cartList(idpelanggan) {
    $.ajax({
      url: "<?= base_url('penjualan/cartlist'); ?>",
      data: {
        pelanggan: idpelanggan,
      },
      method: "post",
      success: function(data) {
        $(".data-cart").html(data);
      },
    });
    grandttl(idpelanggan);
  }
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

    //show #sparepartForm when pelanggan has a value
    $("#pelanggan").change(function() {
      $('#sparepartForm').show();
    });


    $(".select_pelanggan").change(function() {
      $(".select_mtr").show();
      var selected = $(this).val();
      $.ajax({
        url: "<?= base_url('penjualan/getMotor'); ?>",
        data: {
          id: selected,
        },
        method: "post",
        success: function(data) {
          $(".select_motor").html(data);
          $('#biaya_servis').val(0);
          $('#diskon').val(0);
          $('#subtotal').val(0);
        },
      });
      cartList(selected);
    });

    $('.select_motor').change(function() {
      var data = $(this).val();

    });


    //show detail produk when produk selected 
    $('.select_produk').change(function() {
      $(".detail_pro").show();
      var selected = $(this).val();
      $.ajax({
        url: "<?= base_url('penjualan/getDetailPro'); ?>",
        data: {
          id: selected,
        },
        method: "post",
        dataType: "json",
        success: function(data) {
          $("#harga_pro").val(data.harga_jual);
          $('#jumlahPro').val(data.jumlah);
          $('.addsparepart').removeAttr('disabled');
        }
      });

    });

    //jumlah_pro limit
    $('#jumlah_pro').change(function() {
      var jumlah_produk = $("#jumlah_pro").val();
      var jumlahPro = $('#jumlahPro').val();

      if (parseInt(jumlah_produk) > parseInt(jumlahPro)) {
        $('#jumlah_pro').val(jumlahPro);
      } else {
        // $('#jumlah_pro').val(jumlahPro)
        // $('#jumlah_pro').val($(this).val());
        $('#jumlah_pro').val(jumlah_produk);
      }

      if ($('#jumlah_pro').val().trim() == "") {
        parseInt($("#jumlah_pro").val(1));
        // diskon = parseInt(0);
      }

    });

    //add sparepart when clicked
    $(".addsparepart").click(function() {
      var pelanggan = $("#pelanggan").val();
      var sparepart = $("#sparepart").val();
      var jumlah = $("#jumlah_pro").val();
      //send data input using ajax to controller
      $.ajax({
        url: "<?= base_url('penjualan/tambahCart'); ?>",
        data: {
          pelanggan: pelanggan,
          sparepart: sparepart,
          jumlah: jumlah,
        },
        method: "post",
        success: function(data) {},
      });
      //method cardList pelanggan
      cartList(pelanggan);
    });

    //delete sparepart when clicked
    $('#data').on("click", '.deletesparepart', function() {
      var biaya_servis = $("#biaya_servis").val();
      var pelanggan = $("#pelanggan").val();
      var diskon = $("#diskon").val();
      var id = $(this).data('id');
      $.ajax({
        url: "<?= base_url('penjualan/hapusCart/'); ?>",
        data: {
          id: id,
        },
        method: "post",
        success: function(data) {

        },
      });
      $(this).closest('tr').remove();
      grandttl(pelanggan, biaya_servis, diskon);
    });
  });

  $('#biaya_servis').change(function() {
    var biaya_servis = $("#biaya_servis").val();
    var pelanggan = $("#pelanggan").val();
    var diskon = $("#diskon").val();

    if ($(this).val().trim() == "") {
      parseInt($(this).val(0));
      biaya_servis = parseInt(0);
    }
    grandttl(pelanggan, biaya_servis, diskon);
  });

  $("#diskon").change(function() {
    var biaya_servis = $("#biaya_servis").val();
    var pelanggan = $("#pelanggan").val();
    var diskon = $("#diskon").val();

    if ($(this).val().trim() == "") {
      parseInt($(this).val(0));
      diskon = parseInt(0);
    }
    grandttl(pelanggan, biaya_servis, diskon);

  });
</script>