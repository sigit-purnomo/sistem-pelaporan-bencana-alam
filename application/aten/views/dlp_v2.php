      <h2>Data Posko</h2>
      <p>Pilih data posko untuk melakukan pengelolaan data laporan posko</p>
      <div class="form-group">
        <?php
          $attributes = array('id' => 'clapposko', 'role'=>'form');
          echo form_open('dlp/searching/',$attributes);
        ?>
        <div class="row">
          <label class="control-label col-sm-2" for="keyword2">Kata kunci:</label>
        <div class="col-sm-5">
          <?php
          if (!isset($id_bencana)) $id_bencana = "";
          $data = array(
              'name'    => 'idbencana',
              'id'    => 'idbencana',
              'class' => 'form-control',
              'value'   => set_value('idbencana',$id_bencana),
              'type'    => 'hidden',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
          <?php
            $data = array(
            'name'      => 'keyword2',
            'id'        => 'keyword2',
            'value'     => set_value('keyword2',$keyword2),
            'class'     => "form-control",
            'placeholder'=>'Masukkan kata kunci',
            'maxlength' => '50',
            'size'      => '50',
            'autofocus'   => 'autofocus',
            );
          echo form_input($data); ?>
        </div>
        <div class="col-sm-2">
          <?php
          $data = array(
            'type'    => 'submit',
            'name'    => 'caridatapos',
            'class'   => 'button btn btn-info btn-block',
            'value'   => 'Cari Data',
          );
          echo form_input($data); ?>
        </div>
      </div>
        <?php
        echo form_error('keyword2');
        
        ?>
      </div>
      
        <?php
        $image_report = array(
          'src' => 'images/reporticon.png',
          'alt' => 'Report',
          'title' => 'Laporan posko',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        ?>
        <?php if(count($detail) > 0) { ?>
          <?php
          echo '<table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Nama Posko</th>
          <th scope="col">Latitude</th>
          <th scope="col">Longitude</th>
          <th scope="col">Lokasi</th>
          <th scope="col" style="width:70px">Aksi</th>
        </tr>';

          //$date = new DateTime('2000-01-01');
          //echo $date->format('Y-m-d H:i:s');
          foreach($detail as $rows) {
          echo "<tr>";
          echo "
          <td>". $rows['nama_posko'] ."</td>
          <td>". $rows['latitude'] ."</td>
          <td>". $rows['longitude'] ."</td>
          <td>". $rows['lokasi_posko_dusun']. ", " .
              $rows['lokasi_posko_kecamatan']. ", " .
              $rows['lokasi_posko_kota']. ", " .
              $rows['lokasi_posko_provinsi']. "." .
              "</td>
          
          <td class='info'>"
            . anchor('dlp/report/'. $rows['id_posko'], img($image_report)) ."</td>
          "; 
          echo "</tr>";
          } 
          ?>
        </table>
          <?php } else {
              echo '<h5>Tidak ada data</h5>';
          }?>
          
        
        <?php echo $this->pagination->create_links(); ?>