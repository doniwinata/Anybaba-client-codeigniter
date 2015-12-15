<script>
<?php if($this->session->flashdata('message')) {
	?>
	alertify.success('<?php echo $this->session->flashdata('message') ?>');
	
	<?php } ?>

	$(document).ready(function() {
		//using datatables
		 if( $('#tableData').length )         // use this if you are using id to check
		 {
		 	$('#tableData').DataTable( {
		 		"dom": '<"top"f>lrt<"bottom"ip><"clear">'
		 	} );

		 }
		 //get object of edit 
		 $( ".actionTable" ).click(function() {
		 	var id = $(event.target).attr('data-item-id');
		 	$.ajax({ url: '<?php echo site_url()."/members/get"; ?>',
		 		data: {id: id},
		 		type: 'POST',
		 		success: function(output) {

		 			
		 			$('#titleUpdate').html('Update Member');
		 			var member =JSON.parse(output)[0];
		 			//$('#titleUpdate').html('Delete Member: ' + member.id);
		 			$('#form_name').html(member.first_name +' '+member.last_name);
		 			$('#form_email').html( member.email);
		 			$('#form_status').val( member.status);
		 			$('#delete_confirm').html('Delete: '+member.first_name +' '+member.last_name);	
		 			$('#delete_submit').attr('id-member', id); 	
		 		},
		 		error: function(xhr, textStatus, errorThrown){
		 			alert('request failed');
		 		}
		 	});



		 });

		 $( "#delete_submit" ).click(function() {
		 	var id = $(event.target).attr('id-member');

		 	$.ajax({ url: '<?php echo site_url()."/members/delete"; ?>',
		 		data: {id: id},
		 		type: 'POST',
		 		success: function(output) {
		 			
		 			$('#tableData').html(output);
		 			$('#deleteModal').modal('hide');
		 		},
		 		error: function(xhr, textStatus, errorThrown){
		 			alert('request failed');
		 		}
		 	});
		 });
		


		} );
</script>
</html>