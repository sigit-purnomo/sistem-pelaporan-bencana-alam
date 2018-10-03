<?php $this->load->view('includes/header_v1'); ?>
<div class="container">
	<div class="row">
        <div class="alert alert-dismissible alert-info fade in" id="myAlert">
          <!--<button type="button" class="close" data-dismiss="alert">×-->
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h5>
          Selamat datang, 
          <strong><?php 
        if($username!='')
            echo $username.'.';
        else
            echo 'pengguna.';
        ?></strong></h5>
        </div>
        <script>
            function showAlert() {
                $("#myAlert").addClass("hideme");
            }

            window.setTimeout(function () {
                showAlert();
            }, 3000);
        </script>
    </div>
	<div id="main_content">
	<?php $this->load->view($main_content); ?>
	</div>
</div>

<?php $this->load->view('includes/footer_v'); ?>