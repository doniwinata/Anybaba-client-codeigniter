<script>
<?php if($this->session->flashdata('message')) {
	?>
	alertify.success('<?php echo $this->session->flashdata('message') ?>');
	
	<?php } ?>

	$(document).ready(function() {
		//using datatables

		<?php if(isset($data)){ ?>
			$("#select_type").val('<?php echo $data['type'] ?>');
			$("#select_status").val('<?php echo $data['status'] ?>');
			<?php } ?>		
		 if( $('#tableData').length )         // use this if you are using id to check
		 {
		 	$('#tableData').DataTable( {
		 		"dom": '<"top"f>lrt<"bottom"ip><"clear">'
		 	} );

		 }
		 //get object of edit 
		 $( ".actionTable" ).click(function() {
		 	//alert('wew');
		 	var id = $(event.target).attr('data-item-id');

		 	$('#titleDelete').html('Delete Products');
		 	$('#delete_submit').attr('href', '<?php echo site_url()."/products/delete/"?>'+id);
		 		//$('#deleteModal').modal('show'); 	
		 });

		 $( ".addNew" ).click(function() {

		 });

		


		} );
</script>
</html>