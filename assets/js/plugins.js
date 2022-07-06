$(document).ready(function () {
	//DROPDOWN FROM SELECT 2
	$("#select_kategori.form-control").select2({
		placeholder: "Pilih Kategori",
		width: "100%",
	});

	$("#select_supplier.form-control").select2({
		placeholder: "Pilih Supplier",
		width: "100%",
	});
	$(".select_produk").select2({
		placeholder: "Pilih Produk",
		width: "100%",
	});

	//DATE PICKER JQUERY

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
	$("#edit_tgl_pembelian").datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: "top",
		endDate: "today",
	});
	$("#tgl_keluar").datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: "top",
		endDate: "today",
	});
	$("#edit_tgl_keluar").datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		orientation: "top",
		endDate: "today",
	});

	today = yyyy + "-" + mm + "-" + dd;
	$("#tgl_pembelian").val(today);
	$("#tgl_keluar").val(today);
	$("#tgl_pembelian").on("change", function () {
		var selected = $(this).val();
		// console.log(selected);
	});
	$("#tgl_keluar").on("change", function () {
		var selected = $(this).val();
	});

	//NICE SCROLL
	// $(function () {
	// 	$("body").niceScroll();
	// });
});
