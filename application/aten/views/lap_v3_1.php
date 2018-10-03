      <?php
          $attributes = array('id' => 'editform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('report/pdf3/'.$id_laporan,$attributes);
        ?> <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
           <h4>LAPORAN AWAL POSKO</h4>
      <?php
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
              ?>
             
           <h5>Bencana: <?php echo $nama_bencana;?></h5>
           <h5>Tanggal Bencana: <?php echo $hari[(int)$tanggal->format('w')] .", ". $tanggal->format('j ') . $bulan[(int)$tanggal->format('m')] .$tanggal->format(' Y') ." Jam ". $jam; ?></h5>
        
              <?php
            }
      ?>
     </div>
      </div>

      
<?php
        echo 
          "<div class='row'><div class='col-sm-offset-2 col-sm-3'>";
          
          $data = array(
            'type'    => 'submit',
            'name'    => 'pdf1',
            'class'   => 'button btn btn-primary btn-block',
            'value'   => 'Tampil dalam PDF',
          );
          if($this->session->userdata('logged_in') && count($detail) > 0)
          {
            echo form_input($data);
          }
          
          echo "</div></div>".br(2);
      ?>
      <div class="row">
        <div class="col-sm-offset-2 col-sm-8">
          <?php
            if(count($detail) > 0) 
            {
              ?>
              
        <table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Nama Posko</th>
          <th scope="col">Lokasi Posko</th>
          <th scope="col">Aksi</th>
        </tr>
              <?php
              foreach($detail as $rows) 
              {
                $date = new DateTime($rows['tgl_lap_posko']);
                $tgl_lap_posko=new DateTime($rows['tgl_lap_posko']);
                echo "
                  <tr><td>". $rows['nama_posko'] ."</td>
                  <td>". $rows['lokasi_posko_dusun'] .
                      ", ". $rows['lokasi_posko_kecamatan'] .
                      ", ". $rows['lokasi_posko_kota'] .
                      ", ". $rows['lokasi_posko_provinsi'] .
                      ".</td>
                  <td class='info'>".anchor('report/detail/'. $rows['id_laporan'], 'Lihat Detail').
                  "</td>
                  "; 
                  echo "</tr>";
              }
              echo '</table>
        ';
            }
            else
            {
              echo '<h5>Tidak ada data</h5>';
            } 
          ?>
          </div>
      </div>

      <br /><br /><br />
       
      

