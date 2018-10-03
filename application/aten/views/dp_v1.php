      <h2>Data Bencana</h2>
      <p>Pilih data bencana untuk melakukan pengelolaan data posko</p>
      <div class="form-group">
        <?php
          $attributes = array('id' => 'cbencana', 'role'=>'form');
          echo form_open('dp/searching/',$attributes);
        ?>
        <div class="row">
          <label class="control-label col-sm-2" for="keyword">Kata kunci:</label>
        <div class="col-sm-5">
          <?php
            $data = array(
            'name'      => 'keyword',
            'id'        => 'keyword',
            'value'     => set_value('keyword',$keyword),
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
            'name'    => 'caridata',
            'class'   => 'button btn btn-info btn-block',
            'value'   => 'Cari Data',
          );
          echo form_input($data); ?>
        </div>
      </div>
        
      </div>

      <div class="form-group">
      <div class="row">
        <label class="control-label col-sm-2" for="tgl">Tanggal:</label>
        <div class="col-sm-2">
          <?php
            $data = array(
            'name'      => 'tanggal1',
            'id'        => 'tanggal1',
            'value'     => set_value('tanggal1',$tanggal1),
            'type'      => 'date',
            'max'       => date('Y-m-d'),
            'class'     => "form-control",
            'maxlength' => '50',
            'size'      => '50',
            );
          echo form_input($data); ?>
        </div>
        <h4 class="col-sm-1">s/d</h4>
        <div class="col-sm-2">
          <?php
            $data = array(
            'name'      => 'tanggal2',
            'id'        => 'tanggal2',
            'value'     => set_value('tanggal2',$tanggal2),
            'type'      => 'date',
            'max'       => date('Y-m-d'),
            'class'     => "form-control",
            'maxlength' => '50',
            'size'      => '50',
            );
          echo form_input($data); ?>
        </div>
      </div>
      </div>


      
        <?php
        $image_report = array(
          'src' => 'images/reporticon.png',
          'alt' => 'Report',
          'title' => 'Data Posko',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        ?>
        <?php if(count($detail) > 0) { ?>
          <?php
          echo '<table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Nama Bencana</th>
          <th scope="col">Jenis Bencana</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Penyebab</th>
          <th scope="col">Tanggal/Jam</th>
          <th scope="col">Latitude</th>
          <th scope="col">Longitude</th>
          <th scope="col" style="width:70px">Aksi</th>
        </tr>';
          //$date = new DateTime('2000-01-01');
          //echo $date->format('Y-m-d H:i:s');
          foreach($detail as $rows) {
          echo "<tr>";
          $date = new DateTime($rows['tanggal']);
          
          echo "
          <td>". $rows['nama_bencana'] ."</td>
          <td>". $rows['jenis_bencana'] ."</td>
          <td>". $rows['lokasi'] ."</td>
          <td>". $rows['penyebab'] ."</td>
          <td>". $date->format('d-m-Y') ."/ ". $rows['jam'] ."</td>
          <td>". $rows['latitude'] ."</td>
          <td>". $rows['longitude'] ."</td>
          <td class='info'>"
            . anchor('dp/shelter/'. $rows['id_bencana'], img($image_report)) ."</td>
          "; 
          echo "</tr>";
          } 
          ?></table>
          <?php } else {
              echo '<h5>Tidak ada data</h5>';
          }?>
          
        
        <?php echo $this->pagination->create_links(); ?>