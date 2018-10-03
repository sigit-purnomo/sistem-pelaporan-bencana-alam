<!DOCTYPE html>
<html lang="en">

<head>
	<title><?= $page_title ?></title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assetku/img/bpbd.ico" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assetku/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assetku/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>assetku/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assetku/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assetku/font/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- Alertify CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assetku/alertify/themes/alertify.default.css" id="toggleCSS" />	 

	<!-- jQuery Version 1.11.0 -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/jquery-1.11.0.js"></script>
	

	<!-- Bootstrap Core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/plugins/metisMenu/metisMenu.min.js"></script>
	
    <!-- Custom Theme JavaScript -->
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/js/sb-admin-2.js"></script>
	
	 <!-- Auto Complete Library -->
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.structure.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/plugin/ui/jquery-ui.min.js"></script>  
    
	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/pesanDua.js"></script> 
    	<script type="text/javascript" src="<?php echo base_url(); ?>assetku/pesanTiga.js"></script> 
	<link href="<?php echo base_url(); ?>assetku/pesanSatu.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>assetku/cobaKlik.css" rel="stylesheet" type="text/css" />
	
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assetku/js/sb-admin-2.js"></script>
	
	
    <script src="<?= base_url() ?>js/utility.js" type="text/javascript"></script>
     <!-- Custom Theme JavaScript -->
	<link href="<?php echo base_url(); ?>datepicker/rfnet.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="<?php echo base_url(); ?>datepicker/datetimepicker_css.js"></script> 

<script type="text/javascript">

var ids = [];
var checked = [];

function markID(id_user, reg_id){
	if(!checked[id_user]){
		checked[id_user] = true;
		ids[id_user] = reg_id;
	}
	else{
		checked[id_user] = false;
		ids[id_user] = '';
	}
	document.form_pesan.data_reg.value = ids;
}

function change() // no ';' here
{
    var elem = document.getElementById("btn1");
    if (elem.value=="Pilih Semua Relawan") elem.value = "Hapus Semua Tanda";
    else elem.value = "Pilih Semua Relawan";
}
</script>


	
</head>

<body>

    <div id="wrapper">
		<?php 
			$session['hasil'] = $this->session->userdata('logged_in');
			$nama = $session['hasil']->nama_lengkap;
            $id_role = $session['hasil']->id_role;
		?>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">

          <img src="<?php  echo base_url(); ?>images/logo.png" style="position:relative"> <a class="navbar-brand" style="color:white" href="<?php  echo site_url('admin/c_admin'); ?>">  <br/><br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SISTEM MONITORING DAN PENCARIAN RELAWAN</a>  
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" style="color:black"data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  
							 <?php echo $nama." "; ?> 
                                 <?php 
   
    if ($id_role=='1') {
        echo "(Admin)";
    }

    elseif ($id_role=='2') {
        echo "(Petugas)";
    }

    ?>
						<i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url('admin/c_changepass');?>"><i class="fa fa-gear fa-fw"></i>Ganti Kata Sandi</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('c_login/logout');?>"><i class="fa fa-sign-out fa-fw"></i> Keluar</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
<br/><br/><br/>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo site_url('admin/c_admin');?>" id="beranda" ><i class="fa fa-home fa-fw"></i> Beranda</a>
                        </li>
                        <?php if(isset($id_role))
                        { 
                            if($id_role=='2')
                            {
                                    
                            }
                            else if($id_role=='1')
                            {
                                ?>
                    <li><a href="<?php echo site_url('admin/c_petugas');?>" id="petugas"><i class="fa fa-list-alt fa-fw"></i> Kelola Petugas</a></li>
                                <?php
                            }
                        }
                        ?>
                        <li>
                            <a href="<?php echo site_url('admin/c_relawan');?>" id="relawan" ><i class="fa fa-list-alt fa-fw"></i> Kelola Relawan</a>
                        </li>
			<li>
	                            <a href="<?php echo site_url('admin/c_pesan');?>" id="pesan" ><i class="fa fa-list-alt fa-fw"></i>Kirim Pemberitahuan</a>
                        </li>					
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
					<?= $content ?>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="<?php echo base_url(); ?>assetku/alertify/lib/alertify.min.js"></script>

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

	</script>

</body>
</html>