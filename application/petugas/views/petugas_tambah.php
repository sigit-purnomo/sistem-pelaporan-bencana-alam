<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengelolaan Petugas - Tambah Data</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="<?php echo base_url();?>../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?php echo base_url();?>../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="<?php echo base_url();?>../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
   <link href="<?php echo base_url();?>assets/css/fonts.css" rel="stylesheet" />
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
font-size: 16px;"> Selamat Datang <?php echo $username; ?> <a href="<?php echo site_url('login_control/logout');?>" class="btn btn-danger square-btn-adjust">Keluar</a> </div>
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
                                <a class="active-sub-menu" href="<?php echo site_url('petugas_control/view_tambah_petugas');?>">Tambah Data</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('petugas_control/view_ubah_petugas');?>">Ubah Data</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('petugas_control/view_hapus_petugas');?>">Hapus Data</a>
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
                    </li>   -->
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Pengelolaan Petugas - Tambah Data</h2>   
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
                            Form Tambah Data
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Isi Data Petugas</h3>
                                    <!-- <form role="form" action="<?php echo site_url('petugas_control/view_pesan_terkirim');?>"> -->
                                    <?php echo form_open("petugas_control/tambah_petugas"); ?> 
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap: </label>
                                        <label for="nama" style="color:red;"><?php echo form_error('nama', '* <span class="error">', '</span>'); ?></label>
                                        <input class="form-control" id="nama" name="nama" placeholder="Nama Lengkap"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username: </label>
                                        <label for="username" style="color:red;"><?php echo form_error('username', '* <span class="error">', '</span>'); ?></label>
                                        <input class="form-control" id="username" name="username" placeholder="Username"/>                                        
                                    </div>

                                    <div class="form-group">
                                        <fieldset disabled="disabled">
                                            <label for="password">Password: </label>
                                            <label for="password" style="color:blue;">*password default</label>
                                            <input class="form-control" type="text" id="password" name="password" placeholder="Password" value="12345"/>
                                        </fieldset>
                                    </div>
                                   
                                    <label for="nomor_telepon">Nomor Telepon: </label>
                                    <label for="nomor_telepon" style="color:red;"><?php echo form_error('nomor_telepon', '* <span class="error">', '</span>'); ?></label>

                                    <div class="form-group input-group">
                                        <span class="input-group-addon">+62</span>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon">
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role Petugas : </label>
                                        <label for="role" style="color:red;"><?php echo form_error('role', '* <span class="error">', '</span>'); ?></label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="Petugas" selected>Petugas</option>
                                            <option value="Relawan" >Relawan</option>
                                        </select>
                                    </div>
                                    
                                    <input type="reset" class="btn btn-primary" value="Reset">
                                    <input type="submit" class="btn btn-default" onClick="return checkInsert()" value="Simpan Data"/>
                                    <!-- <input type="submit" class="btn btn-default" data-href="<?php echo site_url('petugas_control/tambah_petugas');?>" data-toggle="modal" data-target="#confirm-save" value="Simpan Data"/> -->
                                     
                                    <?php echo form_close(); ?>

                                    <!-- </form>                                -->
                                    
                                    <div class="modal fade" id="confirm-save" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Tambah Data</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                    <p>Anda yakin menambah data petugas ini</p>
                                                    </center>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-primary btn-ok">Simpan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
    <script language="JavaScript" type="text/javascript">
            function checkInsert(){
                return confirm('Anda yakin menambah data petugas ini?');
            }
    </script>
    <script>
        $('#confirm-save').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
   
</body>
</html>
