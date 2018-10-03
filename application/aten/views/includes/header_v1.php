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
    <link href="<?php echo base_url();?>css/carousel.css" rel="stylesheet">
    <link href="<?php echo base_url();?>css/navbar-fixed-top.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url();?>images/ic.gif">
    
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
            <li class="active"><a href="<?php echo base_url();?>index.php/home">Beranda</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pengelolaan Data<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo base_url();?>index.php/db">Data Bencana</a></li>
                <li><a href="<?php echo base_url();?>index.php/dlb">Data Laporan Bencana</a></li>
                <li><a href="<?php echo base_url();?>index.php/dp">Data Posko</a></li>
                <li><a href="<?php echo base_url();?>index.php/dlp">Data Laporan Posko</a></li>
              </ul>
            </li>
            <li><a href="<?php echo base_url();?>index.php/report">Laporan</a></li>
            <li><a href="<?php echo base_url();?>index.php/map">Peta Bencana</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo base_url();?>index.php/<?php echo $link;?>"><?php echo $link2;?></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>