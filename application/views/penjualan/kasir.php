<!-- Begin Page Content -->
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
              <select name="sparepart" id="sparepart" class="select_produk form-control" required>
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
              <input type="number" class="form-control" id="jumlah_pro" name="jumlah_pro">
            </div>
          </div>
          <button type="submit" class="btn btn-success addsparepart" disabled>Tambah Sparepart</button>
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
          <div class="form-group row"><label for="servis_biaya" class="col-sm-4 col-form-label">Biaya Service</label>
            <div class="col-sm-8"><input type="text" id="servis_biaya" name="servis_biaya" class="form-control shadow-none"></div>
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
            </div>
          </div>
          <div class="form-group row"><label for="diskon" class="col-sm-4 col-form-label">Discount</label>
            <div class="col-sm-8"><input type="text" id="diskon" class="form-control shadow-none"></div>
          </div>
          <div class="form-group row"><label for="hargatotal" class="col-sm-4 col-form-label">Harga Total</label>
            <div class="col-sm-8">
              <div disabled="disabled" readonly="readonly" id="hargatotal" class="form-control shadow-none">
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
  //menampilkan grand total
  function grandttl(idpelanggan) {
    // var biaya_servis = $('#biaya_servis').val();
    $.ajax({
      url: "<?= base_url('penjualan/grandTotal'); ?>",
      data: {
        pelanggan: idpelanggan,
        // biaya_servis: biaya_servis
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
        $("#subtotal").html(currencyDelimiter);

        //Diskon applied
        $("#diskon").keyup(function() {
          var test = data - $(this).val();
          currencyFix = Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
          }).format(test);
          currencyFix = Number.isNaN(data) ? 'Rp 0' : currencyFix;
          $("#hargatotal").html(currencyFix);
          $("#grandttl").html(currencyFix);
        });

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
        },
      });
      cartList(selected);
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
    });


  });
</script>