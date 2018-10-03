      <?php
          $attributes = array('id' => 'chooseform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('report/search/',$attributes);
        ?>
      <h2>Grafik Bencana</h2>
      <div class="form-group">
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
              'name'    => 'caridatar5',
              'class'   => 'button btn btn-info btn-block',
              'value'   => 'Cari Data',
            );
            echo form_input($data); ?>
        </div>
      </div>
      

      <div class="form-group">
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



<?php if(count($detail) > 0) { ?>
      <table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Tanggal/Jam Bencana</th>
          <th scope="col">Nama Bencana</th>
          <th scope="col">Jenis Bencana</th>
          <th scope="col">Lokasi</th>
          <th scope="col">Latitude</th>
          <th scope="col">Logitude</th>
          <th scope="col">Jumlah Laporan</th>
          <th scope="col" style="width:70px">Aksi</th>
        </tr>
        <?php
        $image_chart = array(
          'src' => 'images/charticon.png',
          'alt' => 'Report',
          'title' => 'Laporan lengkap',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        ?>
        
          <?php
          //$date = new DateTime('2000-01-01');
          //echo $date->format('Y-m-d H:i:s');
          foreach($detail as $rows) {
          echo "<tr>";
          $date = new DateTime($rows['tanggal']);
          echo "
          <td>". $date->format('d-m-Y') ."/ ". $rows['jam'] ."</td>
          <td>". $rows['nama_bencana'] ."</td>
          <td>". $rows['jenis_bencana'] ."</td>
          <td>". $rows['lokasi'] ."</td>
          <td>". $rows['latitude'] ."</td>
          <td>". $rows['longitude'] ."</td>
          <td>". $rows['jumlah_laporan'] ."</td>
          <td class='info'>"
            . anchor('report/form5/'. $rows['id_bencana'], img($image_chart)) ."</td>
          "; 
          echo "</tr>";
          } 
          ?>
          <?php } 
          else
            {
              echo '<h5>Tidak ada data</h5>';
            } 
            ?>
          
        </table>
        <?php echo $this->pagination->create_links(); ?>