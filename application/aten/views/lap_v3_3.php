      <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>css/navbar-fixed-top.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url();?>images/ic.gif">
     <?php echo $map['js']; ?> 
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo base_url();?>index.php/home">Beranda</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pengelolaan Data<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url();?>index.php/db">Data Bencana</a></li>
                <li><a href="<?php echo base_url();?>index.php/dlb">Data Laporan Bencana</a></li>
                <li><a href="<?php echo base_url();?>index.php/dp">Data Posko</a></li>
                <li><a href="<?php echo base_url();?>index.php/dlp">Data Laporan Posko</a></li>
              </ul>
            </li>
            <li class="active"><a href="<?php echo base_url();?>index.php/report">Laporan</a></li>
            <li><a href="<?php echo base_url();?>index.php/map">Peta Bencana</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url();?>index.php/<?php echo $link;?>"><?php echo $link2;?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<div class="container">
        <div class="row">
          <div class="col-sm-offset-2 col-sm-8">
          <?php
            
            if(count($detail) > 0) 
            {
              foreach($detail as $rows) 
              {
                $date = new DateTime($rows['tgl_lap_posko']);
                $tgl_lap_posko=new DateTime($rows['tgl_lap_posko']);
                ?>
                
                <?php
                echo "<h5><strong>Nama Posko:</strong> ". $rows['nama_posko'] ."</h5>";
                echo "<h5><strong>Lokasi Posko: </strong>". $rows['lokasi_posko_dusun'] .
                      ", ". $rows['lokasi_posko_kecamatan'] .
                      ", ". $rows['lokasi_posko_kota'] .
                      ", ". $rows['lokasi_posko_provinsi'] .
                      ".</h5>";
                echo "<h5><strong>Koordinat Posko: </strong></h5>". 
                      "<div class='indent5'>".
                        "<h5>Latitude: ". $rows['latitude'] ."</h5>".
                        "<h5>Longitude: ". $rows['longitude'] ."</h5>".
                      "</div>";
                ?>
              </div></div>
              <div class="row">
              <div class="col-sm-offset-2 col-sm-6">
                <?php echo $map['html']; ?>
                 </div>
                  <div class="col-sm-4">
              <?php
                echo "<h5><strong>Tanggal/Jam Laporan Posko: </strong>". $date->format('d-m-Y') ."/ ". $rows['jam_lap_posko'] ."</h5>";
                echo "<h5><strong>Nama Pengguna: </strong>". $rows['nama_lengkap'] ."</h5>";
                echo "<h5><strong>Kapasitas Posko: </strong>". $rows['kapasitas'] ." orang.</h5>";
                echo "<h5><strong>Fasilitas Posko: </strong></h5>".
                      "<div class='indent5'>".
                        "<h5>". $rows['fasilitas_dapur'] ." fasilitas dapur,</h5>".
                        "<h5>". $rows['fasilitas_kesehatan'] ." fasilitas kesehatan,</h5>".
                        "<h5>". $rows['fasilitas_mck'] ." fasilitas mck.</h5>".
                      "</div>";
                echo "<h5><strong>Pengungsi: </strong></h5>".
                      "<div class='indent5'>".
                        "<h5>". $rows['jumlah_kk'] . " kk,</h5>".
                        "<h5>". $rows['jumlah_pria'] . " orang pria,</h5>".
                        "<h5>". $rows['jumlah_wanita'] . " orang wanita,</h5>".
                        "<h5>". $rows['jumlah_balita'] . " orang balita.</h5>".
                      "</div>";
              }
            } 
          ?>
            </div> 
          </div>
</div><!-- container-->
<footer class="footer">
      <div class="container">
        
        <img src="<?php echo base_url();?>images/bpbd.png" class="img-responsive pull-right" alt="BPBD" width="40" height="40" title="Badan Penanggulangan Bencana Daerah" style="padding-left:5px; padding-top:5px;">
        <img src="<?php echo base_url();?>images/uajy.png" class="img-responsive pull-right" alt="UAJY" width="40" height="40" title="Universitas Atma Jaya Yogyakarta" style="padding-left:5px; padding-top:5px;">
       
            <p class="text-muted pull-left" style="padding-top:15px;">Aplikasi Web untuk Pelaporan Data Bencana Alam</p>

        <!--<p class="text-muted">Place sticky footer content here.</p>-->
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    
    <!-- jQuery -->
    <script src="<?php echo base_url();?>js/jquery.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>js/ie10-viewport-bug-workaround.js"></script>

     <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/docs.min.js"></script>

    


  </body>
</html>
