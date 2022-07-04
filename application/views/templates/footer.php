 <!-- Footer -->
 <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; POS Rajawali Motor <?=date('Y');?></span>
         </div>
     </div>
 </footer>
 <!-- End of Footer -->

 </div>
 <!-- End of Content Wrapper -->

 </div>
 <!-- End of Page Wrapper -->

 <!-- Scroll to Top Button-->
 <a class="scroll-to-top rounded" href="#page-top">
     <i class="fas fa-angle-up"></i>
 </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Apakah Anda yakin untuk Logout?</h5>
                 <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">Pilih "Logout" untuk keluar.</div>
             <div class="modal-footer">
                 <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                 <a class="btn btn-primary" href="<?=base_url('auth/logout');?>">Logout</a>
             </div>
         </div>
     </div>
 </div>

 <!-- Bootstrap core JavaScript-->
 <script src=" <?=base_url('assets/');?>vendor/jquery/jquery.min.js"></script>
 <script src="<?=base_url('assets/');?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <!-- Data Tables -->
 <!-- <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
 <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js"></script>

 <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>


 <!-- Core plugin JavaScript-->
 <script src="<?=base_url('assets/');?>vendor/jquery-easing/jquery.easing.min.js"></script>

 <!-- Custom scripts for all pages-->
 <script src="<?=base_url('assets/');?>js/sb-admin-2.min.js"></script>
 <script src="<?=base_url('assets/');?>js/my-script.js"></script>
 <script src="<?=base_url('assets/');?>js/pagination.js"></script>
 <script src="<?=base_url('assets/');?>js/select2.js"></script>
 <script src="<?=base_url('assets/');?>js/jquery.nicescroll.js"></script>
 <script src="<?=base_url('assets/');?>js/plugins.js"></script>




 <script>
// mengganti nama file foto yang terkirim
$(".custom-file-input").on("change", function() {
    let fileName = $(this).val().split("//").pop();
    $(this).next(".custom-file-label").addClass("selected").html(fileName);
});

//Script checkbox pada hak akses user
$("#change-access.form-check-input").on("click", function() {
    //mendapatkan data dari data-menu dan data-role
    const menuId = $(this).data("menu");
    const roleId = $(this).data("role");

    $.ajax({
        url: "<?=base_url('admin/changeaccess');?>",
        type: "post",
        data: {
            menuId: menuId,
            roleId: roleId,
        },
        success: function() {
            //mengarahkan ke method ini
            document.location.href = "<?=base_url('admin/roleaccess/');?>" + roleId;
        },
    });
});
 </script>

 </body>

 </html>