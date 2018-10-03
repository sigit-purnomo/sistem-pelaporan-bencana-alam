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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

    <div class="container">
      <?php
        $image_kop = array(
          'src' => 'images/kop.png',
          //'src' => 'images/editicon.png',
          'alt' => 'kop',
          'title' => '',
          'border'=>'0',
          'class' => 'img-responsive',
          'rel' => 'lightbox',
        );
        
      ?>
      
      <div class="row">
          
        <div class="col-sm-6 text-center"><?php
          echo img($image_kop);
          ?>
      </div><!-- /kop -->

      <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-center">
           <h4>LAPORAN TRC BPBD</h4>
           <?php 
            $hari = array("MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU");
            $bulan = array(1 => "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
            if(count($detail) > 0) 
            {
              foreach($detail as $rows) {
                $tanggal_laporan=new DateTime($rows['tanggal_laporan']);
                $jam_laporan=$rows['jam_laporan'];
                echo "<h4>HARI ". $hari[(int)$tanggal_laporan->format("w")] ." TANGGAL ". 
                  $tanggal_laporan->format('j ') . $bulan[(int)$tanggal_laporan->format('m')] . 
                  $tanggal_laporan->format(' Y') ." JAM ". $jam_laporan."</h4>";
                //echo $cetak_date;
              }
            }
            echo "<h5>(SORE HARI PERTAMA DAN HARI BERIKUTNYA)</h5>";
            ?>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-justify">
          <?php
            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
            $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            
            if(count($detail) > 0) 
            {
              foreach($detail as $rows) 
              {
                 $nama= $rows['nama_bencana'];
                $jenis = $rows['jenis_bencana'];
                $lokasi = $rows['lokasi'];
                $penyebab = $rows['penyebab'];
                $jam=$rows['jam'];

                $tanggal=new DateTime($rows['tanggal']);
                $bupati_tgl=new DateTime($rows['bupati_tgl']);

                
                $meninggal = $rows['meninggal'];
            
                $luka_berat = $rows['luka_berat'];
                $luka_ringan = $rows['luka_ringan'];
                $hilang = $rows['hilang'];
                $mengungsi_jiwa = $rows['mengungsi_jiwa'];
                $mengungsi_kk = $rows['mengungsi_kk'];
                
                $rumah = $rows['rumah'];
                $kantor = $rows['kantor'];
                $fasilitas_kesehatan = $rows['fasilitas_kesehatan'];
                $fasilitas_pendidikan = $rows['fasilitas_pendidikan'];
                $fasilitas_umum = $rows['fasilitas_umum'];
                
                $sarana_ibadah = $rows['sarana_ibadah'];
                $jembatan = $rows['jembatan'];
                $jalan = $rows['jalan'];
                $tanggul = $rows['tanggul'];
                $sawah = $rows['sawah'];
                
                $lahan_pertanian = $rows['lahan_pertanian'];
                $lain_lain = $rows['lain_lain'];
                $bupati_jam = $rows['bupati_jam'];
                $posko = $rows['posko'];
                
                $koordinasi = $rows['koordinasi'];
                $evakuasi = $rows['evakuasi'];
                $kesehatan = $rows['kesehatan'];
                $dapur = $rows['dapur'];
                $distribusi = $rows['distribusi'];
                
                $pengerahan = $rows['pengerahan'];
                $sumber_daya = $rows['sumber_daya'];
                $kendala = $rows['kendala'];
                $kebutuhan_mendesak = $rows['kebutuhan_mendesak'];
                $rencana_tindaklanjut = $rows['rencana_tindaklanjut'];

                $korban=(int)$meninggal+(int)$luka_berat+(int)$luka_ringan+(int)$hilang;
                if($posko==1)
                  $posko='Telah mendirikan POSKO SATLAK PB/BPBD';
                else 
                  $posko='Belum mendirikan POSKO SATLAK PB/BPBD';
                if($koordinasi==1)
                  $koordinasi='Telah melakukan rapat koordinasi dengan dinas/instansi/lembaga terkait';
                else 
                  $koordinasi='Belum melakukan rapat koordinasi dengan dinas/instansi/lembaga terkait';
                if($evakuasi==1)
                  $evakuasi='Telah melaksanakan penyelamatan/evakuasi bencana';
                else 
                  $evakuasi='Belum melaksanakan penyelamatan/evakuasi bencana';
                if($kesehatan==1)
                  $kesehatan='Telah melaksanakan pelayanan kesehatan';
                else 
                  $kesehatan='Belum melaksanakan pelayanan kesehatan';
                if($dapur==1)
                  $dapur='Telah melaksanakan pendirian dapur umum';
                else 
                  $dapur='Belum melaksanakan pendirian dapur umum';
                if($distribusi==1)
                  $distribusi='Telah melaksanakan pendistribusian bantuan makanan';
                else 
                  $distribusi='Belum melaksanakan pendistribusian bantuan makanan';
                if($pengerahan==1)
                  $pengerahan='Pengerahan tenaga aparat Pemda, TNI, Polri, SAR, Tagana, PMI, Relwan Masyarakat, dll';
                else 
                  $pengerahan='Belum ada pengerahan tenaga aparat Pemda, TNI, Polri, SAR, Tagana, PMI, Relwan Masyarakat, dll';
                $sub_tim=$rows['sub_tim'];

                $rencana_aksi = $rows['rencana_aksi'];
                $kesimpulan = $rows['kesimpulan'];
                $penutup = $rows['penutup'];

                $kerusakan1=(int)$fasilitas_kesehatan+(int)$fasilitas_pendidikan+(int)$fasilitas_umum+(int)$sarana_ibadah+(int)$jembatan+(int)$jalan+(int)$tanggul;
                $kerusakan2=(int)$sawah+(int)$lahan_pertanian;
                $id_laporan=$rows['id_laporan'];

                echo "
                  <h4>1. Tim Reaksi Cepat BPBD</h4>
                  <div class='indent2'>
                  <p>a. Tim reaksi cepat BPBD terdiri dari ". $sub_tim ." sub Tim melaksanakan peninjauan lapangan terhadap lokasi 
                    peninjauan di ". $lokasi .".</p>
                  <p>b. Membantu SATLAK PB/BPBD untuk:</p>
                    <div class='indent2'>
                      <p>1. Mengaktifkan Posko SATLAK PB/BPBD</p>
                      <p>2. Memperlancar koordinasi dengan sektor terkait melalui rapat koordinasi dalam mendukung penanganan tanggap darurat</p>
                      <p>3. Kegiatan press release kepada mass media cetak/elektronik</p>
                    </div>
                  </div>

                  <h4>2. Bencana</h4>
                  <div class='indent2'>
                  <p>a. Kejadian</p>
                    <div class='indent2'>
                    <p>1. Jenis kejadian: ". $jenis .".</p>
                    <p>2. Waktu kejadian: hari ". $hari[(int)$tanggal->format('w')] .", tanggal ". $tanggal->format('j ') . $bulan[(int)$tanggal->format('m')] .$tanggal->format(' Y') ." Jam ". $jam .".</p>
                    <p>3. Lokasi kejadian: ". $lokasi .".</p>
                    <p>4. Penyebab kejadian: ". $penyebab .".</p>
                    </div>
                  <p>b. Kondisi Mutakhir</p>
                    <div class='indent2'>
                    <p>1. Korban: ". $korban ." orang (".
                        $meninggal." orang meninggal, ".
                        $luka_berat." orang luka berat, ".
                        $luka_ringan." orang luka ringan, ".
                        $hilang." orang hilang/hanyut).</p>
                    <p>2. Mengungsi: ". $mengungsi_jiwa ." jiwa/ ". $mengungsi_kk ." KK</p>
                    <p>3. Kerusakan: ". $rumah ." rumah, ".
                        $kantor ." kantor, ".
                        $fasilitas_kesehatan ." fasilitas kesehatan, ".
                        $fasilitas_pendidikan ." fasilitas pendidikan, ".
                        $fasilitas_umum ." fasilitas umum, ".
                        $sarana_ibadah ." sarana ibadah, ".
                        $jembatan ." jembatan, ".
                        $jalan ." jalan, ".
                        $tanggul ." tanggul, ".
                        $sawah ." sawah, ".
                        $lahan_pertanian ." lahan pertanian, ".
                        $lain_lain ." lain-lain.</p>
                    <p>4. Dampak bencana:</p>
                    </div>
                  <p>c. Upaya penanganan yang telah dilakukan oleh SATLAK PB/BPBD Kabupaten Kota</p>
                    <div class='indent2'>
                    <p>1. Bupati/Walikota pada tanggal ". $bupati_tgl->format('j ') . $bulan[(int)$bupati_tgl->format('m')] .$bupati_tgl->format(' Y') ." jam ". $bupati_jam ." telah meninjau lokasi bencana.</p>
                    <p>2. ". $posko ."</p>
                    <p>3. ". $koordinasi ."</p>
                    <p>4. ". $evakuasi ."</p>
                    <p>5. ". $kesehatan ."</p>
                    <p>6. ". $dapur ."</p>
                    <p>7. ". $distribusi ."</p>
                    <p>8. ". $pengerahan ."</p>
                    <p>9. Dan lain-lain</p>
                    </div>
                  <p>d. Sumber daya yang tersedia di lokasi bencana:</p><p class = 'indent2'>". $sumber_daya ."</p>
                  <p>e. Tabel rincian bantuan (dibutuhkan, diterima, disalurkan, persediaan, kekurangan)</p>
                  <p>f. Kendala/hambatan: </p><p class = 'indent2'>". $kendala ."</p>
                  <p>g. Kebutuhan mendesak sesuai urutan prioritas: </p><p class = 'indent2'>". $kebutuhan_mendesak ."</p>
                  <p>h. Rencana tindak lanjut SATLAK PB/BPBD Kabupaten Kota: </p><p class = 'indent2'>". $rencana_tindaklanjut. "</p>
                  </div>

                <h4>3. Analisa singkat sementara</h4>
                <div class='indent2'>
                  <p>a. Korban: ". $korban ." orang</p>";
                  if ($pengungsi==NULL)
                    $pengungsi=0;
                echo "
                  <p>b. Pengungsi: ". $pengungsi ." orang</p>
                  <p>c. Pemenuhan kebutuhan minimun: ". $kebutuhan_mendesak ."</p>
                  <p>d. Kerusakan</p>
                    <div class='indent2'>
                    <p>Rumah: ". $rumah ." buah</p>
                    <p>Sarana dan prasarana umum: ". $kerusakan1 ." buah </p>
                    <p>Lahan/sawah/kebun/tanaman/ternak: ". $kerusakan2 ." buah</p>
                    </div>
                </div>";

                echo "<h4>4. Rencana Aksi TIM</h4>";
                echo "<div class='indent2'>
                  <p>". $rencana_aksi ."</p>
                  </div>";
                echo "<h4>5. Kesimpulan dan Rekomendasi</h4>";
                echo "<div class='indent2'>
                  <p>". $kesimpulan ."</p>
                  </div>";
                echo "<h4>6. Penutup</h4>";
                echo "<div class='indent2'>
                  <p>". $penutup ."</p>
                  </div>";
              }
            } 
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-right">
          <br /><br /><br /><br /><br /><br />
          <p>Ketua TRC BPBD</p>
          <br /><br /><br />
          <p>(........................)</p>
        </div>
      </div>
    </div> <!-- /container -->

    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo base_url();?>js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
