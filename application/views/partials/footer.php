



<!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
<script src="<?php echo base_url('assets/js/vendor/jquery.min.js');?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('assets/js/vendor/video.js');?>"></script>
<script src="<?php echo base_url('assets/js/flat-ui.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/alertify.min.js');?>"></script>
</body>

<script>
<?php if($this->session->flashdata('message')) {
	?>
	alertify.success('<?php echo $this->session->flashdata('message') ?>');
	
	<?php } ?>

	
	</script>
	</html>
