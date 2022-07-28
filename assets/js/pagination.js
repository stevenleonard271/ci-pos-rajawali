// DATA TABLE

$(document).ready(function () {
	//Pagination Data Table

	
	$("table.display").DataTable({
		order: [[0, "asc"]],
		// stateSave: true,
		// "bDestroy": true,
		searching: false,
		paging: false,
		info: false,
	});

	$(".table").DataTable({
		order: [[0, "asc"]],
		stateSave: true,
		bDestroy: true,
		pageLength: 10,
		lengthMenu: [5, 10, 20, 25],
	});

	$("#tableBarang").DataTable({
		bDestroy: true,
        paging: false,
        ordering: false,
        info: false,
		searching:false

      });

	  $("#tableRiwayatPenjualan").DataTable({
		bDestroy: true,
        paging: false,
        ordering: false,
        info: false,
		searching:false

      });

	  $("#kriteriaMAPE").DataTable({
		bDestroy: true,
        paging: false,
        ordering: false,
        info: false,
		searching:false

      });

	  $("#keteranganPeramalan").DataTable({
		bDestroy: true,
        paging: false,
        ordering: false,
        info: false,
		searching:false

      });

	  
	
	  $("#tableStokKeluar").DataTable({
		bDestroy: true,
        paging: false,
        ordering: false,
        info: false,
		searching:false

      });
	  

	//show and hide running out stock
	$(".close").click(function () {
		$("#newsHeading").parent().slideUp();
	});

	$("#lihatData").click(function () {
		$("#newsHeading").parent().slideDown();
	});
});
