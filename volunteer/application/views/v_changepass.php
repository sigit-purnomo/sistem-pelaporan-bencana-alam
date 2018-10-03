<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ganti kata sandi</title>

    <link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/bpbd.ico" type="image/x-icon" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>aset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>aset/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
    <!-- Alertify CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>aset/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]-->
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <!--[endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
				<?php echo form_open('admin/c_changepass/updatePass'); ?>
				<legend></legend>
                    <div class="panel-heading">
						<div class="panel-heading">
							<img src="<?php echo base_url(); ?>images/ic_bpbd.png" class="img-responsive"> 						
						</div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                                    <input id ="currentPassword" class="form-control" placeholder="Kata Sandi Lama" name="passlama" type="password" autofocus required>
                                    <?php echo form_error('passlama', '<p class="field_error">', '</p>'); ?>                                    
                                </div>
                                <div class="form-group">
                                    <input id ="newPassword" class="form-control" placeholder="Kata Sandi Baru" name="passbaru" type="password" autofocus required>
                                    <?php echo form_error('passbaru', '<p class="field_error">', '</p>'); ?>
                                    <div class="help-error">
                                        <small id="password_strengh_feedback" ></small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input id ="verifyPassword" class="form-control" placeholder="Konfirmasi Kata Sandi Baru" name="password" type="password" required>
                                    <?php echo form_error('password', '<p class="field_error">', '</p>'); ?>
                                    <div class="help-error">
                                        <small id="password_match" ></small>
                                    </div>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" value="Simpan" class="btn btn-lg btn-primary btn-block"/>
                       <!-- <button class="btn btn-lg btn-danger btn-block" onclick="location.href='<?= base_url(); ?>admin/c_changepass/back'">Kembali</button> -->
					
					<?php echo form_close(); ?>
                     
                    </div>
                    <div class="panel-body">
                     <button class="btn btn-lg btn-danger btn-block" onclick="location.href='<?= base_url(); ?>admin/c_admin'">Kembali</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>aset/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>aset/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>aset/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Change Password -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/change-password.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery.form.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>
    <!-- Alertify JavaScript -->
    <script src="<?php echo base_url(); ?>assetku/alertify/lib/alertify.min.js"></script> 
    
    <script>
    $(document).ready(function(){  
        
    
    


        if(<?php echo $cek;?>=='0')
        {
            alertify.error("Kata Sandi Baru dan Konfirmasi tidak cocok !");
        }
        if(<?php echo $cek;?>=='2')
        {
            alertify.error("Kata Sandi Lama tidak cocok !");
        }
        
        
    });
    </script>  
    <script>
    function reset () {
        $("#toggleCSS").attr("href", "<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css");
        alertify.set({
            labels : {
                ok     : "OK",
                cancel : "Cancel"
            },
            delay : 5000,
            buttonReverse : false,
            buttonFocus   : "ok"
        });
    }
      $(function() {
    $('#currentPassword').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });});
     $(function() {
    $('#newPassword').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });});
       
    
</script>

</body>

</html>
