<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--
    <link rel="icon" href="../../favicon.ico">
    -->

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url();?>css/navbar-fixed-top.css" rel="stylesheet">
<link rel="icon" href="<?php echo base_url();?>images/ic.gif">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   
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
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">
      

      <?php echo $map['html']; ?>
    </div> <!-- /container -->

    <footer class="footer">
      <div class="container">
        
        <img src="<?php echo base_url();?>images/bpbd.png" class="img-responsive pull-right" alt="BPBD" width="40" height="40" title="Badan Penanggulangan Bencana Daerah" style="padding-left:5px; padding-top:5px;">
        <img src="<?php echo base_url();?>images/uajy.png" class="img-responsive pull-right" alt="UAJY" width="40" height="40" title="Universitas Atma Jaya Yogyakarta" style="padding-left:5px; padding-top:5px;">
        <p class="text-muted pull-left" style="padding-top:15px;">Aplikasi Web untuk Pemetaan Pengungsi Bencana Alam</p>
        <!--<p class="text-muted">Place sticky footer content here.</p>-->
      </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url();?>/js/highcharts.js"></script>
    <script src="<?php echo base_url();?>/js/modules/exporting.js"></script>
  </body>
</html>
