<?php $this->load->view('includes/header_v4'); ?>

<div class="container">
	<h2>Pemetaan Bencana</h2>
	<div class="row">
		<div id="main_content">
			<?php $this->load->view($main_content); ?>
		</div>
	</div>
	
	<div class="row">
		<div id="map_content2">
			<?php $this->load->view($map_content2); ?>
		</div>
	</div>
	<?php echo br(1);?>
	
	<div class="row">
		<div id="map_content1">
			<?php $this->load->view($map_content1); ?>
		</div>
	</div>
</div> <!-- /container -->
<?php $this->load->view('includes/footer_v'); ?>