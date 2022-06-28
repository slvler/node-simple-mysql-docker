		<script src="assets/admin/vendors/bower_components/jquery/dist/jquery.min.js"></script>
		<script src="assets/admin/vendors/jquery-ui.min.js"></script>
		<script src="assets/admin/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="assets/admin/vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>
		<script src="assets/admin/vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="assets/admin/vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
		<script src="assets/admin/vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
		<script src="assets/admin/vendors/bower_components/switchery/dist/switchery.min.js"></script>
		<script src="assets/admin/vendors/bower_components/sweetalert/dist/sweetalert.min.js"></script>
		<script src="assets/admin/vendors/bower_components/tinymce/tinymce.min.js"></script>
		<script src="assets/admin/vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
		<script src="assets/admin/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/admin/vendors/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="assets/admin/dist/js/jquery.slimscroll.js"></script>
		<script src="assets/admin/dist/js/lightgallery-all.js"></script>
		<script src="assets/admin/dist/js/gallery-data.js"></script>
		<script src="assets/admin/dist/js/sweetalert-data.js"></script>
		<script src="assets/admin/dist/js/dropdown-bootstrap-extended.js"></script>
		<script src="assets/admin/dist/js/form-advance-data.js"></script>
		<script src="assets/admin/dist/js/init.js"></script>
		<script>
            tinymce.init({
                selector: '.tinymce',
                height: '300',
                language: 'tr_TR',
                verify_html: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste jbimages textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
                relative_urls : true,
                document_base_url: '<?php echo base_url(); ?>',
                remove_script_host : false,
                convert_urls : true,
            });
        </script>
	</body>
</html>