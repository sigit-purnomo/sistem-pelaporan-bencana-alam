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
    <title><?php echo $title;?></title>

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
    
<script type="text/javascript">
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#chart1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Grafik Jumlah Bencana <?php if($tahun==0){}else{echo "Tahun ".$tahun;}
                ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    },
                    showInLegend: true
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 1
            },
            <?php if(count($detail) > 0) {
                foreach($detail as $rows) {
                    $j1=$rows['j1'];
                    $j2=$rows['j2'];
                    $j3=$rows['j3'];
                    $j4=$rows['j4'];
                    $j5=$rows['j5'];

                    $j6=$rows['j6'];
                    $j7=$rows['j7'];
                    $j8=$rows['j8'];
                    $j9=$rows['j9'];
                    $j10=$rows['j10'];

                    $j11=$rows['j11'];
            }}?>
            series: [{
                type: 'pie',
                name: 'Jumlah Kejadian',
                data: [<?php
                        if($j1>0) echo "['Gempa Bumi',".$j1."],";
                        if($j2>0) echo "['Gunung Berapi',".$j2."],";
                        if($j3>0) echo "['Tsunami',".$j3."],";
                        if($j4>0) echo "['Tanah Longsor',".$j4."],";
                        if($j5>0) echo "['Banjir',".$j5."],";
                        if($j6>0) echo "['Kekeringan',".$j6."],";
                        if($j7>0) echo "['Kebakaran',".$j7."],";
                        if($j8>0) echo "['Kebakaran Hutan',".$j8."],";
                        if($j9>0) echo "['Angin Puting Beliung',".$j9."],";
                        if($j10>0) echo "['Gelombang Laut Pasang',".$j10."],";
                        if($j11>0) echo "['Abrasi',".$j11."]";
                        ?>
                ]
            }],
            exporting: {
                buttons: {
                    contextButton: {
                        text: 'Unduh'
                    }
                }
            }
        });
    });

});
    </script>


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
      <h2>Grafik Bencana</h2>
      <?php
          $attributes = array('id' => 'chooseform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('report/search/',$attributes);
        ?>
        <div class="form-group">
            <div class="col-sm-6">
                <?php
                    $attribute ='class="selectpicker form-control"';
                    echo form_dropdown('tahun', $detail_tahun, set_value('tahun'),$attribute);?>
            </div>
            <div class="col-sm-2">
            <?php
                $data = array(
                  'type'    => 'submit',
                  'name'    => 'caridatar6',
                  'class'   => 'button btn btn-primary btn-block',
                  'value'   => 'Tampil',
                );
                echo form_input($data); ?>
            </div>
        </div>
      
      <div class="col-sm-8">
        <div id="chart1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>
      
      <div class="alert alert-dismissible alert-info fade in" id="myAlert">
          <!--<button type="button" class="close" data-dismiss="alert">×-->
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h5>
          Anda dapat melakukan pemilihan yang lebih spesifik dengan memilih data pada legenda.</h5>
        </div>
    </div> <!-- /container -->

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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url();?>/js/highcharts.js"></script>
    <script src="<?php echo base_url();?>/js/modules/exporting.js"></script>
  </body>
</html>
