<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800" id="titleHide"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg">
            <div class="card mb-5">
                <div class="card-header bg-primary">
                    <h1 class="h5 mt-2 text-gray-100"><?= $subTitle; ?></h1>
                </div>
                <div class="card-body">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-md-5 col-sm-5">
                                <input type="hidden" name="no_pembelian" id="no_pembelian"
                                    value="<?php generateCode($countReceipt); ?>" />
                                <div class="form-group">
                                    <label for="supplier">Supplier Produk</label>
                                    <select name="supplier" id="select_supplier" class="form-control">
                                        <option></option>
                                        <option value="">Pilih Supplier</option>
                                        <?php foreach ($supplier as $s) : ?>
                                        <option value="<?= $s['id']; ?>"><?= $s['nama']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('supplier', ' <small class="text-danger"> ', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_pembelian">Tanggal Pembelian</label>
                                    <input type="text" class="form-control date" id="tgl_pembelian" name="tgl_pembelian"
                                        autocomplete="off">
                                    <?= form_error('tanggal_beli', ' <small class="text-danger"> ', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="status_pembelian">Status</label>
                                    <select name="status_pembelian" id="status_pembelian" class="form-control">
                                        <option value="Lunas">Lunas</option>
                                        <option value="Hutang">Hutang</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <div class="row">
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class=" col-sm col-md col-lg mb-3">
                                        <div class="card border-left-primary shadow h-100 ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                            Grand Total</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800"
                                                            id="grandTotal">
                                                            Rp. 0,00 </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fas fa-money-bill-alt fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Earnings (Monthly) Card Example -->
                                    <div class=" col-sm col-md col-lg mb-3">
                                        <div class="card border-left-success shadow h-100 ">
                                            <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                        <div
                                                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                            Nomor Pembelian</div>
                                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                            <?= generateCode($countReceipt); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <i class="fas fas fa-receipt fa-2x text-gray-300"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="catatan">Catatan Pembelian</label>
                                    <textarea class="form-control" name="catatan_pembelian" id="catatan_pembelian"
                                        rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="h5 font-weight-bold text-gray-800"> Tambah Produk</div>
                                <small class="text-danger">
                                    **Rekomendasi pembelian dari data peramalan akan muncul di kolom jumlah saat produk
                                    dipilih
                                </small>
                            </div>
                        </div>
                        <hr class="mb-1">
                        <div class="col-md-12 col-xs-12 col-lg-12" id="tabelBarang">
                            <div class="row border-bottom align-middle p-2">
                                <div class="col-5 pl-0">
                                    <b>Nama Barang</b>
                                </div>
                                <div class="col-2">
                                    <b>Jumlah</b>
                                </div>
                                <div class="col-2">
                                    <b>Harga Satuan</b>
                                </div>
                                <div class="col-2">
                                    <b>Harga Total</b>
                                </div>
                            </div>
                            <div class="row border-bottom p-2 align-items-center">
                                <div class="col-5 pl-0 ">
                                    <select name="select_produk[]" class="select_produk_masuk form-control"
                                        id="pilih_produk" required>
                                        <option value="">Pilih Produk</option>
                                        <?php foreach ($produk as $p) : ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['nama']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="number" class="jumlah_produk form-control" id="jumlah_produk1"
                                        name="jumlah_produk[]" autocomplete="off" id-input="1" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" class="harga_produk form-control" id="harga_produk1"
                                        name="harga_produk[]" autocomplete="off" id-input="1" required>
                                </div>
                                <div class="col-2">
                                    <input type="number" class="total_produk form-control" id="total_produk1"
                                        name="total_produk[]" autocomplete="off" id-input="1" required>
                                </div>
                            </div>
                            <div id="slots">

                            </div>
                        </div>
                        <div class="col-md-12 col-xs-12 col-xl-12 mt-2">
                            <button type="button" id="tambah_produk" onclick="addSlot()" class="btn btn-success">Tambah
                                Produk</button>
                            <a href="<?= base_url('inventori/stokmasuk') ?>"
                                class="btn btn-danger float-right ">Batal</a>
                            <button type="submit" class="btn ml-2 mr-3 btn-primary float-right">Simpan Catatan</button>
                        </div>
                    </form>
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
    $name = "#PORWJ";
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

    $("#tgl_pembelian").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        orientation: "top",
        endDate: "today",
    });

    today = yyyy + "-" + mm + "-" + dd;
    $("#tgl_pembelian").val(today);

    $("#tgl_pembelian").on("change", function() {
        var selected = $(this).val();
        // alert(selected);
    });

    $("#select_supplier.form-control").select2({
        placeholder: "Pilih Supplier",
        width: "100%",
    });


    $("#tabelBarang .select_produk_masuk").select2({
        placeholder: "Pilih Produk",
        width: "100%",

    });

    //Untuk view stok masuk baru 
    $('#tabelBarang .select_produk_masuk').on("select2:select", function() {
        var tgl_pembelian = $('#tgl_pembelian').val();
        var produk = $(this).val();
        $.ajax({
            url: "http://localhost/pos-rajawali/inventori/rekomendasiPembelianStokMasuk",
            data: {
                idProduk: produk,
                tgl_pembelian: tgl_pembelian,
            },
            method: "post",
            dataType: "JSON",
            success: function(data) {
                if (data.jumlah <= data.batas_bawah) {
                    $('#jumlah_produk1').val(data.hasil);
                    $('#harga_produk1').val(data.harga_beli);
                    $('#total_produk1').val(data.hasil * data.harga_beli);
                    showGrandTotal();
                } else {
                    let text =
                        "Jumlah stok masih di atas batas minimal, apakah anda yakin untuk melakukan pembelian?";
                    if (confirm(text) == true) {
                        $('#jumlah_produk1').val(data.hasil);
                        $('#harga_produk1').val(data.harga_beli);
                        $('#total_produk1').val(data.hasil * data.harga_beli);
                        showGrandTotal();
                    } else {
                        alert('Pembelian dibatalkan');
                        $('#pilih_produk').val(null).trigger('change');
                    }
                }
            },
        });
    });


});

var grandTotal = 0;

showGrandTotal();


$(".harga_produk").on("keyup", function() {
    var id = $(this).attr('id-input');
    // alert(id);
    var total = $("#harga_produk" + id).val() * $("#jumlah_produk" + id).val();
    $("#total_produk" + id).val(total);
    showGrandTotal();
});

$(".jumlah_produk").on("keyup", function() {
    var id = $(this).attr('id-input');
    var total = $("#harga_produk" + id).val() * $("#jumlah_produk" + id).val();
    $("#total_produk" + id).val(total);
    showGrandTotal();
});


var j = 2;

function addSlot() {

    var html =
        '<div class="row border-bottom p-2 align-items-center" id="slot' +
        j +
        '">' +
        '<div class="col-5 pl-0 ">' +
        '<select name="select_produk[]" id="pilih_produk' + j +
        '" class="select_produk_masuk_add form-control" id-input="' + j + '" required>' +
        '<option value="">Pilih Produk</option> ' +
        <?php foreach ($produk as $p) : ?> '<option value="<?= $p["id"]; ?>"><?= $p["nama"]; ?></option>' +
        <?php endforeach; ?> "</select>" +
        "</div>" +
        '<div class="col-2">' +
        '<input type="number" class="jumlah_produk form-control" id="jumlah_produk' + j + '"' +
        'name="jumlah_produk[]" autocomplete="off" id-input="' + j + '" required>' +
        "</div>" +
        '<div class="col-2">' +
        '<input type="number" class="harga_produk form-control" id="harga_produk' + j + '"' +
        'name="harga_produk[]" autocomplete="off" id-input="' + j + '" required >' +
        "</div>" +
        '<div class="col-2">' +
        '<input type="number" class="total_produk form-control" id="total_produk' + j + '"' +
        'name="total_produk[]" autocomplete="off" id-input="' + j + '" required>' +
        "</div>" +
        '<div class="col-1">' +
        '<button type="button" onclick="deleteSlot(' +
        j +
        ')" class="btn btn-outline-danger">Hapus</button>' +
        "</div>" +
        "</div>" +
        "</div>";
    $("#slots").append(html);


    $("#tabelBarang .select_produk_masuk_add").select2({
        placeholder: "Pilih Produk",
        width: "100%",
    });


    $(".harga_produk").on("keyup", function() {
        var id = $(this).attr('id-input');
        // alert(id);
        var total = $("#harga_produk" + id).val() * $("#jumlah_produk" + id).val();
        $("#total_produk" + id).val(total);
        showGrandTotal();
    });

    $(".jumlah_produk").on("keyup", function() {
        var id = $(this).attr('id-input');
        var total = $("#harga_produk" + id).val() * $("#jumlah_produk" + id).val();
        $("#total_produk" + id).val(total);
        showGrandTotal();
        // grandTotal += total;
    });


    $('#tabelBarang .select_produk_masuk_add').on("select2:select", function() {
        // alert('Test hehe');
        var tgl_pembelian = $('#tgl_pembelian').val();
        var produk = $(this).val();
        var id = $(this).attr('id-input');
        $.ajax({
            url: "http://localhost/pos-rajawali/inventori/rekomendasiPembelianStokMasuk",
            data: {
                idProduk: produk,
                tgl_pembelian: tgl_pembelian,
            },
            method: "post",
            dataType: "JSON",
            success: function(data) {
                if (data.jumlah <= data.batas_bawah) {
                    $('#jumlah_produk' + id).val(data.hasil);
                    $('#harga_produk' + id).val(data.harga_beli);
                    $('#total_produk' + id).val(data.hasil * data.harga_beli);
                    showGrandTotal();
                } else {
                    let text =
                        "Jumlah stok masih di atas batas minimal, apakah anda yakin untuk melakukan pembelian?";
                    if (confirm(text) == true) {

                        $('#jumlah_produk' + id).val(data.hasil);
                        $('#harga_produk' + id).val(data.harga_beli);
                        $('#total_produk' + id).val(data.hasil * data.harga_beli);
                        showGrandTotal();
                    } else {
                        alert('Pembelian dibatalkan');
                        $('#pilih_produk' + id).val(null).trigger('change');
                    }
                }
            },
        });
    });

    j++;
}

function deleteSlot(id) {

    grandTotal = grandTotal - $('#total_produk' + id).val();

    $("#slot" + id).remove();
    showGrandTotal();

}

function showGrandTotal() {
    var grandTotal = 0;
    $('.total_produk').each(function(i, obj) {
        grandTotal += parseInt($(obj).val());
    });

    // $('#grandTotal').html(grandTotal);
    currencyDelimiter = Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
    }).format(grandTotal);

    currencyDelimiter = Number.isNaN(grandTotal) ? 'Rp 0' : currencyDelimiter;

    $('#grandTotal').html(currencyDelimiter);
    // }
    // $('#grandTotal').html((grandTotal).toLocaleString('en'));
}
</script>