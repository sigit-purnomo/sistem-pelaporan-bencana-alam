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
    $('#chart1').highcharts({
      <?php if(count($detail_bencana) > 0) {
            foreach($detail_bencana as $rows) {
              $nama_bencana=$rows['nama_bencana'];
              $date = new DateTime($rows['tanggal']);
              $jam=$rows['jam'];
              $lokasi=$rows['lokasi'];
            }
          }?>
        title: {
            text: <?php echo "'Grafik Perkembangan Korban Bencana ".$nama_bencana." di ". $lokasi ."'";?>,
            x: -20 //center
        },
        subtitle: {
            text: <?php echo "'Tanggal/Jam Bencana: ". $date->format('d-m-Y')."/". $jam ."'";?>,
            x: -20
        },
        xAxis: {
          title: {
                enabled: true,
                text: 'Tanggal'
            },
            categories: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    $date = new DateTime($rows['tanggal_laporan']);
                    echo "'".$date->format('d-m-Y')."',";
                }}?>
                ]
        },
        yAxis: {
            title: {
                text: 'Rerata Jumlah Korban (orang)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 1
        },
        series: [{
            name: 'Meninggal',
            data: [
                <?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['ameninggal'].",";
                }}?>
                ]
        }, {
            name: 'Luka Berat',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['aluka_berat'].",";
                }}?>
                ]
        }, {
            name: 'Luka Ringan',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['aluka_ringan'].",";
                }}?>
                ]
        }, {
            name: 'Hilang',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['ahilang'].",";
                }}?>
                ]
        }, {
            name: 'Mengungsi',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['amengungsi_jiwa'].",";
                }}?>
                ]
        }, {
            name: 'Mengungsi (kk)',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['amengungsi_kk'].",";
                }}?>
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
    </script>
   <script type="text/javascript">
$(function () {
    $('#chart2').highcharts({
      <?php if(count($detail_bencana) > 0) {
            foreach($detail_bencana as $rows) {
              $nama_bencana=$rows['nama_bencana'];
              $date = new DateTime($rows['tanggal']);
              $jam=$rows['jam'];
              $lokasi=$rows['lokasi'];
            }
          }?>
        title: {
            text: <?php echo "'Grafik Perkembangan Kerusakan Akibat Bencana ".$nama_bencana." di ". $lokasi ."'";?>,
            x: -20 //center
        },
        subtitle: {
            text: <?php echo "'Tanggal/Jam Bencana: ". $date->format('d-m-Y')."/". $jam ."'";?>,
            x: -20
        },
        xAxis: {
          title: {
                enabled: true,
                text: 'Tanggal'
            },
            categories: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    $date = new DateTime($rows['tanggal_laporan']);
                    echo "'".$date->format('d-m-Y')."',";
                }}?>
                ]
        },
        yAxis: {
            title: {
                text: 'Rerata Jumlah Kerusakan (buah)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 1
        },
        series: [{
            name: 'Rumah',
            data: [
                <?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['arumah'].",";
                }}?>
                ]
        }, {
            name: 'Kantor',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['akantor'].",";
                }}?>
                ]
        }, {
            name: 'Fasilitas Kesehatan',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['afasilitas_kesehatan'].",";
                }}?>
                ]
        }, {
            name: 'Fasilitas Pendidikan',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['afasilitas_pendidikan'].",";
                }}?>
                ]
        }, {
            name: 'Fasilitas Umum',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['afasilitas_umum'].",";
                }}?>
                ]
        }, {
            name: 'Sarana Ibadah',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['asarana_ibadah'].",";
                }}?>
                ]
        }, {
            name: 'Jembatan',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['ajembatan'].",";
                }}?>
                ]
        }, {
            name: 'Jalan',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['ajalan'].",";
                }}?>
                ]
        }, {
            name: 'Tanggul',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['atanggul'].",";
                }}?>
                ]
        }, {
            name: 'Sawah',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['asawah'].",";
                }}?>
                ]
        }, {
            name: 'Lahan Pertanian',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['alahan_pertanian'].",";
                }}?>
                ]
        }, {
            name: 'Lain-lain',
            data: [<?php if(count($detail) > 0) {
                  foreach($detail as $rows) {
                    echo $rows['alain_lain'].",";
                }}?>
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
    </script> 
    <script type="text/javascript">
$(function () {
    $('#c1').highcharts({
      <?php if(count($detail_bencana) > 0) {
            foreach($detail_bencana as $rows) {
              $nama_bencana=$rows['nama_bencana'];
              $date = new DateTime($rows['tanggal']);
              $jam=$rows['jam'];
              $lokasi=$rows['lokasi'];
            }
          }?>
        title: {
            text: <?php echo "'Grafik Perkembangan Pengungsi Pria Akibat Bencana ".$nama_bencana." di ". $lokasi ."'";?>,
            x: -20 //center
        },
        subtitle: {
            text: <?php echo "'Tanggal/Jam Bencana: ". $date->format('d-m-Y')."/". $jam ."'";?>,
            x: -20
        },
        xAxis: {
          title: {
                enabled: true,
                text: 'Tanggal'
            },
            categories: [<?php echo $xaxis;?>]
        },
        yAxis: {
            title: {
                text: 'Rerata Jumlah Pengungsi Pria (orang)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 1
        },
        plotOptions: {
            series: {
                connectNulls: false
            }
        },
        series: [<?php echo $series1;?>],
        exporting: {
            buttons: {
                contextButton: {
                    text: 'Unduh'
                }
            }
        }
    });
});
    </script> 
    <script type="text/javascript">
$(function () {
    $('#c2').highcharts({
      <?php if(count($detail_bencana) > 0) {
            foreach($detail_bencana as $rows) {
              $nama_bencana=$rows['nama_bencana'];
              $date = new DateTime($rows['tanggal']);
              $jam=$rows['jam'];
              $lokasi=$rows['lokasi'];
            }
          }?>
        title: {
            text: <?php echo "'Grafik Perkembangan Pengungsi Wanita Akibat Bencana ".$nama_bencana." di ". $lokasi ."'";?>,
            x: -20 //center
        },
        subtitle: {
            text: <?php echo "'Tanggal/Jam Bencana: ". $date->format('d-m-Y')."/". $jam ."'";?>,
            x: -20
        },
        xAxis: {
          title: {
                enabled: true,
                text: 'Tanggal'
            },
            categories: [<?php echo $xaxis;?>]
        },
        yAxis: {
            title: {
                text: 'Rerata Jumlah Pengungsi Wanita (orang)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 1
        },
        plotOptions: {
            series: {
                connectNulls: false
            }
        },
        series: [<?php echo $series2;?>],
        exporting: {
            buttons: {
                contextButton: {
                    text: 'Unduh'
                }
            }
        }
    });
});
    </script> 
    <script type="text/javascript">
$(function () {
    $('#c3').highcharts({
      <?php if(count($detail_bencana) > 0) {
            foreach($detail_bencana as $rows) {
              $nama_bencana=$rows['nama_bencana'];
              $date = new DateTime($rows['tanggal']);
              $jam=$rows['jam'];
              $lokasi=$rows['lokasi'];
            }
          }?>
        title: {
            text: <?php echo "'Grafik Perkembangan Pengungsi Balita Akibat Bencana ".$nama_bencana." di ". $lokasi ."'";?>,
            x: -20 //center
        },
        subtitle: {
            text: <?php echo "'Tanggal/Jam Bencana: ". $date->format('d-m-Y')."/". $jam ."'";?>,
            x: -20
        },
        xAxis: {
          title: {
                enabled: true,
                text: 'Tanggal'
            },
            categories: [<?php echo $xaxis;?>]
        },
        yAxis: {
            title: {
                text: 'Rerata Jumlah Pengungsi Balita (orang)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 1
        },
        plotOptions: {
            series: {
                connectNulls: false
            }
        },
        series: [<?php echo $series3;?>],
        exporting: {
            buttons: {
                contextButton: {
                    text: 'Unduh'
                }
            }
        }
    });
});
    </script> 
    <script type="text/javascript">
$(function () {
    $('#c4').highcharts({
      <?php if(count($detail_bencana) > 0) {
            foreach($detail_bencana as $rows) {
              $nama_bencana=$rows['nama_bencana'];
              $date = new DateTime($rows['tanggal']);
              $jam=$rows['jam'];
              $lokasi=$rows['lokasi'];
            }
          }?>
        title: {
            text: <?php echo "'Grafik Perkembangan Pengungsi Akibat Bencana ".$nama_bencana." di ". $lokasi ."'";?>,
            x: -20 //center
        },
        subtitle: {
            text: <?php echo "'Tanggal/Jam Bencana: ". $date->format('d-m-Y')."/". $jam ."'";?>,
            x: -20
        },
        xAxis: {
          title: {
                enabled: true,
                text: 'Tanggal'
            },
            categories: [<?php echo $xaxis;?>]
        },
        yAxis: {
            title: {
                text: 'Rerata Jumlah Pengungsi (kk)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 1
        },
        plotOptions: {
            series: {
                connectNulls: false
            }
        },
        series: [<?php echo $series4;?>],
        exporting: {
            buttons: {
                contextButton: {
                    text: 'Unduh'
                }
            }
        }
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
      <h2>Grafik Perkembangan Bencana</h2>
      
      <!--Grafik Korban Bencana-->

      <div class="col-sm-12">
        <div id="chart1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>

      <!--Grafik Kerusakan-->
      <div class="col-sm-12">
        <div id="chart2"  style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>
      <?php
      if($series1 && $series2 && $series3 && $series4)
      {
        echo 
      '<!--Grafik Pengungsi pria-->
      <div class="col-sm-12">
        <div id="c1"  style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>

      <!--Grafik Pengungsi wanita-->
      <div class="col-sm-12">
        <div id="c2"  style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>

      <!--Grafik Pengungsi balita-->
      <div class="col-sm-12">
        <div id="c3"  style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>

      <!--Grafik Pengungsi kk-->
      <div class="col-sm-12">
        <div id="c4"  style="min-width: 310px; height: 400px; margin: 0 auto"></div>
      </div>';}
      ?>
        <div class="alert alert-dismissible alert-info fade in" id="myAlert">
          <!--<button type="button" class="close" data-dismiss="alert">×-->
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h5>
          Anda dapat melakukan pemilihan yang lebih spesifik dengan memilih data pada legenda. Lewatkan kursor pada grafik untuk melihat data lebih lengkap.</h5>
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
