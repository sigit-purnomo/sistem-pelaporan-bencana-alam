
                <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="<?php echo base_url();?>images/1.jpg" alt="">
          <div class="container">
            <div class="carousel-caption shadow">
              <h1>Aplikasi Web untuk Pemetaan Pengungsi Bencana Alam</h1>
              <p>Aplikasi untuk menyimpan serta mengelola data-data pengungsi bencana alam secara terpusat.</p>
              
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo base_url();?>images/2.jpg" alt="">
          <div class="container">
            <div class="carousel-caption shadow">
              <h1>Peta Sebaran Pengungsi Bencana Alam</h1>
              <p>Data-data pengungsi bencana alam pada peta interaktif.</p>
              <p><a class="btn btn-lg btn-info" href="<?php echo base_url();?>index.php/map" role="button">Tampilkan</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="<?php echo base_url();?>images/3.jpg" alt="">
          <div class="container">
            <div class="carousel-caption shadow">
              <h1>Laporan Awal dan Laporan Perkembangan</h1>
              <p>Laporan mengenai data pengungsi bencana alam dalam bentuk PDF dan grafik interaktif.</p>
              <p><a class="btn btn-lg btn-info" href="<?php echo base_url();?>index.php/report" role="button">Tampilkan</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->

                    
