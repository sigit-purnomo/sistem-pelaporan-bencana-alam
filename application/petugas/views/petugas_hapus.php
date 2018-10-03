<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengelolaan Petugas - Hapus Data</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="<?php echo base_url();?>../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?php echo base_url();?>../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?php echo base_url();?>../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
   <link href="<?php echo base_url();?>../assets/css/fonts.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">UAJY - BPBD</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Selamat Datang <?php echo $username; ?> &nbsp; <a href="<?php echo site_url('login_control/logout');?>" class="btn btn-danger square-btn-adjust">Keluar</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="<?php echo base_url('../assets/img/find_user.png');?>" class="user-image img-responsive"/>
                    </li>

                    <!-- <li>
                        <a href="<?php echo site_url('home_control');?>"><i class="fa fa-home fa-3x"></i> Halaman Utama</a>
                    </li> -->
                    <li>
                        <a class="active-menu" href="<?php echo site_url('petugas_control');?>"><i class="fa fa-users fa-3x"></i> Pengelolaan Petugas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('petugas_control');?>">Tampil Data</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('petugas_control/view_tambah_petugas');?>">Tambah Data</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('petugas_control/view_ubah_petugas');?>">Ubah Data</a>
                            </li>
                            <li>
                                <a class="active-sub-menu" href="<?php echo site_url('petugas_control/view_hapus_petugas');?>">Hapus Data</a>
                            </li>
                        </ul>
                    </li>   
                    <!-- <li>
                        <a href="#"><i class="fa fa-envelope-o fa-3x"></i> Pengelolaan Pesan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo site_url('pesan_control');?>">Pesan Masuk</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('pesan_control/view_pesan_terkirim');?>">Pesan Terkirim</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('pesan_control/view_tulis_pesan');?>">Tulis Pesan</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('pesan_control/view_broadcast_bencana');?>">Broadcast Informasi Bencana</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('pesan_control/view_broadcast_posko');?>">Broadcast Informasi Posko</a>
                            </li>
                        </ul>
                    </li> -->  
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Pengelolaan Petugas - Hapus Data</h2>   
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
           <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Cari Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Cari Data Petugas</h3>
                                    <!-- <form role="form"> -->
                                    <?php echo form_open("petugas_control/cari_petugas"); ?>
                                    <div class="form-group">
                                        <label>Cari Petugas: </label>
                                        <input class="form-control" id="cari" name="cari" placeholder="Masukan Data Petugas"/>
                                    </div>
                                    <input type="submit" class="btn btn-default" value="Cari Data"/>

                                    <?php echo form_close(); ?>
                                    <!-- </form>                                -->
                                </div> 
                            </div>
                        </div>
                     <!-- End Form Elements -->
                    </div>
                </div>
            </div>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
</div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/custom.js"></script>
    
   
</body>
</html>
