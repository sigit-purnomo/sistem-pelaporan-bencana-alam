<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Monitoring dan Pencarian Relawan</title>

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
    <!-- jQuery -->
    <script src="<?php echo base_url();?>aset/jquery/dist/jquery.min.js"></script>
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
<script type="text/javascript">
 $(document).ready(function() {
     $(function() {
    $('#password').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
       });
 $(function() {
    $('#username').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
       });

          });
</script>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
				<?php echo form_open('c_login/check_login'); ?>
				<legend></legend>
                    <div class="panel-heading">
						<div class="panel-heading">
							<img src="<?php echo base_url(); ?>images/ic_bpbd.png" class="img-responsive"> 						
						</div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <input class="form-control" placeholder="Nama Pengguna" id="username" name="username" type="text" autofocus required>
							<span class="help-block"><?php echo form_error('username', '<p class="field_error">', '</p>'); ?></span>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Kata Sandi" name="password" id="password" type="password" value="">
							<span class="help-block"><?php echo form_error('password', '<p class="field_error">', '</p>'); ?></span>
                        </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
                        <input type="submit" value="Masuk" class="btn btn-lg btn-primary btn-block"/>
					<legend></legend>
					<?php echo form_close(); ?>
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

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>dist/js/sb-admin-2.js"></script>
    <!-- Alertify JavaScript -->
    <script src="<?php echo base_url(); ?>assetku/alertify/lib/alertify.min.js"></script>   
    <script>
    $(document).ready(function(){  
        var cek = <?php echo $cek;?>;
        if(cek =='0')
        {
            alertify.error("Nama Pengguna dan kata sandi tidak cocok !");
        }
    }); 
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
</script>

</body>

</html>
