<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>


 <style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid grey;
}
td {
    vertical-align: top;
    padding: 5px;
}
</style>
  </head>

  <body>

   
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
        
      
      $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
        $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            
        if(count($detail) > 0) 
            {
              foreach($detail as $rows) 
              {
                $nama_bencana=$rows['nama_bencana'];
                $tanggal=new DateTime($rows['tanggal']);
                $jam=$rows['jam'];
              }
            }
      ?>
      <div align="center">
          <?php
          echo img($image_kop);
          ?>


      <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-center" align="center">
           <h4>LAPORAN POSKO TRC BPBD</h4>
           <h5>Bencana: <?php echo $nama_bencana;?></h5>
           <h5>Tanggal Bencana: <?php echo $hari[(int)$tanggal->format('w')] .", ". $tanggal->format('j ') . $bulan[(int)$tanggal->format('m')] .$tanggal->format(' Y') ." Jam: ". $jam; ?></h5>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
        <table class="table" >
          <thead>
        <tr class="tr">
          <th>Nama Posko</th>
          <th>Lokasi Posko</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Tanggal/ Jam Laporan</th>
          <th>Relawan</th>
          <th>Kapasitas</th>
          <th>Fasilitas</th>
          <th>Pengungsi</th>
        </tr>
      </thead>
      <tbody>
          <?php
            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
            $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            
            if(count($detail) > 0) 
            {
              foreach($detail as $rows) 
              {
                $date = new DateTime($rows['tgl_lap_posko']);
                $tgl_lap_posko=new DateTime($rows['tgl_lap_posko']);
                echo "
                  <tr class='tr'><td>". $rows['nama_posko'] ."</td>
                  <td>". $rows['lokasi_posko_dusun'] .
                      ", ". $rows['lokasi_posko_kecamatan'] .
                      ", ". $rows['lokasi_posko_kota'] .
                      ", ". $rows['lokasi_posko_provinsi'] .
                      ".</td>
                  <td>". $rows['plat'] ."</td>
                  <td>". $rows['plon'] ."</td>
                  <td>". $date->format('d-m-Y') ."/ ". $rows['jam_lap_posko'] ."</td>
                  <td>". $rows['nama_lengkap'] ."</td>
                  <td>". $rows['kapasitas'] ."</td>
                  <td>". $rows['fasilitas_dapur'] ." fasilitas dapur, ". 
                      $rows['fasilitas_kesehatan'] ." fasilitas kesehatan, ". 
                      $rows['fasilitas_mck'] ." fasilitas mck.</td>
                  <td>". $rows['jumlah_kk'] . " kk, ".
                      $rows['jumlah_pria'] . " orang pria, ".
                      $rows['jumlah_wanita'] . " orang wanita, ".
                      $rows['jumlah_balita'] . " orang balita. ".
                  "</td>
                  "; 
                  echo "</tr>";
              }
            } 
          ?>
          <tbody>
          </table>
        </div>
      </div>


        <div align="right">
          <br /><br /><br /><br /><br /><br />
          <p>Ketua TRC BPBD</p>
          <br /><br /><br />
          <p>(........................)</p>
        </div>

    
    
  </body>
</html>
