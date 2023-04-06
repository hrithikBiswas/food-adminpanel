<!-- REQUIRED SCRIPTS -->
<!-- Bootstrap -->
<script src="<?php echo base_url; ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?php echo base_url; ?>node_modules/admin-lte/dist/js/adminlte.min.js"></script>
<!-- Datatable -->
<script src="<?php echo base_url; ?>node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url; ?>node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(() => {
		'use strict'

		// Fetch all the forms we want to apply custom Bootstrap validation styles to
		const forms = document.querySelectorAll('.needs-validation')

		// Loop over them and prevent submission
		Array.from(forms).forEach(form => {
			form.addEventListener('submit', event => {
				if (!form.checkValidity()) {
					event.preventDefault()
					event.stopPropagation()
				}

				form.classList.add('was-validated')
			}, false)
		})
	})()
	$(document).ready(function () {
		$('#example').DataTable({
			scrollX: true,
		});
	});
</script>
