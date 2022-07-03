$(function () {
	//Add Menu
	$(".tombolTambahMenu").on("click", function () {
		$("#newMenuModalLabel").html("Tambah Menu ");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#menu").val("");
		$("#urutan").val("");
		$("#id").val("");
	});

	//Edit Menu from Add Menu
	$(".tampilModalUbahMenu").on("click", function () {
		$("#newMenuModalLabel").html("Edit Menu ");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/pos-rajawali/menu/ubahMenu"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/pos-rajawali/menu/getUbahMenu",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#menu").val(data.menu);
				$("#urutan").val(data.urutan);
				$("#id").val(data.id);
			},
		});
	});

	// Edit and get Data SubMenu
	$(".tampilModalUbahSubMenu").on("click", function () {
		$("#newSubMenuModalLabel").html("Edit Sub Menu");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/pos-rajawali/menu/ubahSubMenu"
		);
		// $.ajax({
		// 	url: "http://localhost/pos-rajawali/menu/ubahSubMenu",
		// 	data: {
		// 		id: id,
		// 	},
		// 	method:post
		// });

		const id = $(this).data("id");

		// console.log(data);

		$.ajax({
			url: "http://localhost/pos-rajawali/menu/getUbahSubMenu",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				// console.log(data);
				$("#title").val(data.judul);
				$("#url").val(data.url);
				$("#menu_id").val(data.menu_id);
				$("#is_active").val(data.is_active);
				$("#is_active").prop("checked", data.is_active == 1 ? true : false);
				// $("#is_active").val(data.is_active,	$('#is_active').prop('checked')==true)? 1 :0);

				$("#icon").val(data.icon);
				$("#id").val(data.id);
			},
		});
		// console.log(test);
	});

	$("#is_active").click(function () {
		if ($(this).val(this.checked)) {
			$(this).val(1);
		}
	});

	//Add SubMenu
	$(".tombolTambahSubMenu").on("click", function () {
		$("#newSubMenuModalLabel").html("Tambah Sub Menu");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#title").val("");
		$("#url").val("");
		$("#menu_id").val("");
		$("#icon").val("");
		$("#is_active").val("1");
		$("#id").val("");
	});

	//Add Role
	$(".tombolTambahRole").on("click", function () {
		$("#newRoleModalLabel").html("Tambah User ");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#role").val("");
		$("#id").val("");
	});

	//Add Role
	$(".tombolTambahSupplier").on("click", function () {
		$("#newSupplierModalLabel").html("Tambah Supplier ");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#deskripsi").val("");
		$("#nomor").val("");
		$("#nama").val("");
		$("#id").val("");
	});

	//Edit Role from Add Role
	$(".tampilModalUbahRole").on("click", function () {
		$("#newRoleModalLabel").html("Edit User ");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/pos-rajawali/admin/ubahRole"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/pos-rajawali/admin/getUbahRole",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#role").val(data.role);
				$("#id").val(data.id);
			},
		});
	});

	//Add Kategori
	$(".tombolTambahKategori").on("click", function () {
		$("#newKategoriModalLabel").html("Tambah Kategori");
		$(".modal-footer button[type=submit]").html("Tambah");
		$("#kategori").val("");
		$("#id").val("");
	});

	//Edit Kategori from Add Kategori
	$(".tampilModalUbahKategori").on("click", function () {
		$("#newKategoriModalLabel").html("Edit Kategori ");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/pos-rajawali/produk/ubahKategori"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/pos-rajawali/produk/getUbahKategori",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#kategori").val(data.kategori);
				$("#id").val(data.id);
			},
		});
	});

	//Edit Supplier from Add Supplier
	$(".tampilModalUbahSupplier").on("click", function () {
		$("#newSupplierModalLabel").html("Edit Supplier ");
		$(".modal-footer button[type=submit]").html("Edit");
		$(".modal-body form").attr(
			"action",
			"http://localhost/pos-rajawali/inventori/ubahSupplier"
		);

		const id = $(this).data("id");

		$.ajax({
			url: "http://localhost/pos-rajawali/inventori/getUbahSupplier",
			data: {
				id: id,
			},
			method: "post",
			dataType: "json",
			success: function (data) {
				$("#deskripsi").val(data.deskripsi);
				$("#nomor").val(data.nomor);
				$("#nama").val(data.nama);
				$("#id").val(data.id);
			},
		});
	});

	//Tambah Produk di Catatan Stok Masuk
	$("#tambah_produk").on("click", function () {
		// get the last DIV which ID starts with ^= "form_produk_masuk"
		var $div = $('div[id^="form_produk_masuk"]:last');

		// Read the Number from that DIV's ID (i.e: 3 from "klon3")
		// And increment that number by 1
		var num = parseInt($div.prop("id").match(/\d+/g), 10) + 1;

		// Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
		var $klon = $div.clone().prop("id", "form_produk_masuk" + num);

		// Finally insert $klon wherever you want
		$div.after($klon);
	});

	//Change #laba when #harga_beli changed
	$("#harga_beli").on("keyup", function () {
		// alert("Hello World");
		var laba = $("#harga_jual").val() - $("#harga_beli").val();
		$("#laba").val(laba);
	});
	//Change #laba when #harga_jual changed
	$("#harga_jual").on("keyup", function () {
		var laba = $("#harga_jual").val() - $("#harga_beli").val();
		$("#laba").val(laba);
	});
	$("#harga_produk").on("keyup", function () {
		var laba = $("#harga_produk").val() * $("#jumlah_produk").val();
		$("#total_produk").val(laba);
	});
	$("#jumlah_produk").on("keyup", function () {
		var laba = $("#harga_produk").val() * $("#jumlah_produk").val();
		$("#total_produk").val(laba);
	});
});
