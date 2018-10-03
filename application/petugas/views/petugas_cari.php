<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pengelolaan Petugas - Cari Data</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="<?php echo base_url();?>../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="<?php echo base_url();?>../assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="<?php echo base_url();?>../assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
   <link href="<?php echo base_url();?>../assets/css/fonts.css" rel="stylesheet" />
     <!-- TABLE STYLES-->
    <link href="<?php echo base_url();?>../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                                <a class="active-sub-menu" href="<?php echo site_url('petugas_control');?>">Tampil Data</a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('petugas_control/view_tambah_petugas');?>">Tambah Data</a>
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
                    </li>  --> 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Pengelolaan Petugas - Cari Data</h2>    
                     
                        <!-- <h5>Welcome Jhon Deo , Love to see you back. </h5> -->
                       
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <!-- Advanced Tables -->
                             Data Petugas
                             &nbsp; 
                            <button class="btn btn-primary btn-xs" onClick="location.href='<?php echo site_url('petugas_control/view_tambah_petugas');?>'"><i class="fa fa-pencil "></i> Tambah Data</button>
                            &nbsp; <button class="btn btn-default btn-xs" style="float: right;" onClick="refresh()"><i class="fa fa-refresh "></i> Perbaharui Data</button>
                            <!-- |  -->
                        </div>
                        <div class="panel-body">
                            <?php                             
                            if(!empty($cari_petugas))
                            {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Petugas</th>
                                            <th>Nama Petugas</th>
                                            <th>Username</th>
                                            <th>Nomor Telepon</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php
                                        $i = 0;
                                        if(!empty($cari_petugas))
                                        {
                                            foreach ($cari_petugas as $rows) { 
                                                $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $rows->id_user; ?></td>
                                                <td><?php echo $rows->nama_lengkap; ?></td>
                                                <td><?php echo $rows->username; ?></td>
                                                <!-- <td><?php echo $rows->password; ?></td> -->
                                                <td><?php echo $rows->no_hp; ?></td>
                                                <td><?php if($rows->id_role == 1){
                                                    echo "Petugas";
                                                }
                                                else if($rows->id_role == 2)
                                                {
                                                    echo "Relawan";
                                                }
                                                ?></td>
                                                <td>
                                                <center>
                                                    <button class="btn btn-primary btn-xs" onClick="if(confirm('Anda yakin mengubah data petugas ini?')) location.href='<?php echo site_url('petugas_control/view_ubah_petugas2/'.$rows->id_user);?>'"><i class="fa fa-edit "></i> Ubah</button> 
                                                    <!-- <button class="btn btn-primary btn-xs" data-href="<?php echo site_url('petugas_control/view_ubah_petugas2/'.$rows->id_user);?>" data-toggle="modal" data-target="#confirm-edit"><i class="fa fa-edit "></i> Ubah Data</button> -->
                                                    | 
                                                    <button class="btn btn-danger btn-xs" onClick="if(confirm('Anda yakin menghapus data petugas ini?')) location.href='<?php echo site_url('petugas_control/delete_petugas/'.$rows->id_user);?>'"><i class="fa fa-trash-o "></i> Hapus</button> 
                                                    <!-- <button class="btn btn-danger btn-xs" data-href="<?php echo site_url('petugas_control/delete_petugas/'.$rows->id_user);?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o "></i> Hapus Data</button> -->
                                                    | 
                                                    <button class="btn btn-danger btn-xs" onClick="if(confirm('Anda yakin mereset password petugas ini?')) location.href='<?php echo site_url('petugas_control/reset_password/'.$rows->id_user);?>'"><i class="fa fa-exclamation-triangle "></i> Reset Password</button> 
                                                </center>
                                                </td>
                                            </tr>   
                                            <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus Data</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                    <p>Anda yakin menghapus data petugas ini</p>
                                                    </center><!-- <p class="debug-url"></p>  -->
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-danger btn-ok">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="confirm-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Ubah Data</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                    <p>Anda yakin mengubah data petugas ini</p>
                                                    </center><!-- <p class="debug-url"></p>  -->
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                    <a class="btn btn-primary btn-ok">Ubah</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </table>
                            </div>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
        </div>      
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="<?php echo base_url();?>../assets/js/custom.js"></script>
    
    <script language="JavaScript" type="text/javascript">
            function checkEdit(){
                return confirm('Anda yakin mengubah data petugas ini?');
            }
    </script>
    <script language="JavaScript" type="text/javascript">
        function checkDelete(){
            return confirm('Anda yakin menghapus data petugas ini?');
        }
    </script>
    <script>
        function refresh() {
            location.reload();
        }
    </script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
    <script>
        $('#confirm-edit').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Edit URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
    </script>
      
</body>
</html>
