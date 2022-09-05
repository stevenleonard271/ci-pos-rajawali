$(document).ready(function () {
	//DROPDOWN FROM SELECT 2
	// $("#select_kategori.form-control").select2({
	// 	placeholder: "Pilih Kategori",
	// 	width: "100%",
	// });
	// $("#select_supplier.form-control").select2({
	// 	placeholder: "Pilih Supplier",
	// 	width: "100%",
	// });
	// $(".select_produk").select2({
	// 	placeholder: "Pilih Produk",
	// 	width: "100%",
	// });
	// $("#tabelBarang .select_produk_masuk").select2({
	// 	placeholder: "Pilih Produk",
	// 	width: "100%",
	// });
	// $(".select_pelanggan").select2({
	// 	placeholder: "Pilih Pelanggan",
	// 	width: "100%",
	// });

	// $(".select_motor").select2({
	// 	// placeholder: "Pilih Motor",
	// 	width: "100%",
	// });
	// $(".select_mekanik").select2({
	// 	placeholder: "Pilih Mekanik",
	// 	width: "100%",
	// });

	// //Untuk view stok masuk baru 
	// $('#tabelBarang .select_produk_masuk').on("select2:select", function() {

	// 	// alert('Test hehe');
	// 	var tgl_pembelian = $('#tgl_pembelian').val();
	// 	var produk = $(this).val();
	// 	$.ajax({
	// 		url: "http://localhost/pos-rajawali/inventori/rekomendasiPembelianStokMasuk",
	// 		data: {
	// 			idProduk: produk,
	// 			tgl_pembelian: tgl_pembelian,
	// 		},
	// 		method: "post",
	// 		dataType:"JSON",
	// 		success: function(data) {
	// 			// alert(data.hasil);
	// 			// alert('test');
	// 			$('#jumlah_produk1').val(data.hasil);
	// 		},
	// 	});
	// });

	
	



	//DATE PICKER JQUERY

	/* Date Picker pindah ke view stokmasukbaru dan stokkeluarbaru
	*/

	// var today = new Date();
	// var dd = String(today.getDate()).padStart(2, "0");
	// var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
	// var yyyy = today.getFullYear();

	// $("#tgl_pembelian").datepicker({
	// 	format: "yyyy-mm-dd",
	// 	autoclose: true,
	// 	orientation: "top",
	// 	endDate: "today",
	// });
	// $("#edit_tgl_pembelian").datepicker({
	// 	format: "yyyy-mm-dd",
	// 	autoclose: true,
	// 	orientation: "top",
	// 	endDate: "today",
	// });
	// $("#tgl_keluar").datepicker({
	// 	format: "yyyy-mm-dd",
	// 	autoclose: true,
	// 	orientation: "top",
	// 	endDate: "today",
	// });
	// $("#edit_tgl_keluar").datepicker({
	// 	format: "yyyy-mm-dd",
	// 	autoclose: true,
	// 	orientation: "top",
	// 	endDate: "today",
	// });
	// today = yyyy + "-" + mm + "-" + dd;
	// $("#tgl_pembelian").val(today);
	// $("#tgl_pembelian").on("change", function () {
	// 	var selected = $(this).val();
	// 	// console.log(selected);
	// });
	// $("#tgl_keluar").val(today);
	// $("#tgl_keluar").on("change", function () {
	// 	var selected = $(this).val();
	// });

	//NICE SCROLL
	// $(function () {
	// 	$("body").niceScroll();
	// });
});
