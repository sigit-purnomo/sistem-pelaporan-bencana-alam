
        <?php
          $attributes = array('id' => 'insertform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('db/save/',$attributes);
        ?>
            <?php echo $this->session->flashdata('message');?>
            <h2>Data Bencana</h2>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama">Nama Bencana:</label>
              <div class="col-sm-6 <?php echo form_error('nama') == '' ? '' : 'has-error';?>">
              <?php
                $data = array(
                'name'    => 'nama',
                'id'    => 'nama',
                'value'   => set_value('nama'),
                'class' => 'form-control',
                'placeholder'=>'Masukkan nama bencana',
                'maxlength' => '50',
                'size'    => '35',
                'autofocus'   => 'autofocus',
                );
              echo form_input($data); ?>
              <?php echo form_error('nama'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jenis">Jenis Bencana:</label>
              <div class="col-sm-6 <?php echo form_error('jenis') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'Gempa Bumi'    => 'Gempa Bumi',
              'Gunung Berapi'   => 'Gunung Berapi',
              'Tsunami'   => 'Tsunami',
              'Tanah Longsor'   => 'Tanah Longsor',
              'Banjir'    => 'Banjir',
              'Kekeringan'    => 'Kekeringan',
              'Kebakaran'   => 'Kebakaran',
              'Kebakaran Hutan'   => 'Kebakaran Hutan',
              'Angin Puting Beliung'    => 'Angin Puting Beliung',
              'Gelombang Laut Pasang'   => 'Gelombang Laut Pasang',
              'Abrasi'    => 'Abrasi'
              );
              $attribute ='class="selectpicker form-control"';
            echo form_dropdown('jenis',$data,set_value('jenis'),$attribute); ?>
            <?php echo form_error('jenis'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lokasi">Lokasi:</label>
              <div class="col-sm-6 <?php echo form_error('lokasi') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lokasi',
              'id'    => 'lokasi',
              'value'   => set_value('lokasi'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan lokasi (dusun,kecamatan,kota,provinsi)',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lokasi'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="penyebab">Penyebab:</label>
              <div class="col-sm-6 <?php echo form_error('penyebab') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'penyebab',
              'id'    => 'penyebab',
              'value'   => set_value('penyebab'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan penyebab bencana',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('penyebab'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tanggal">Tanggal:</label>
              <div class="col-sm-6 <?php echo form_error('tanggal') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'tanggal',
              'id'    => 'tanggal',
              'value'   => set_value('tanggal'),
              'type'    => 'date',
              'max'   => date('Y-m-d'),
              'class' => 'form-control',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('tanggal'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jam">Jam:</label>
              <div class="col-sm-6 <?php echo form_error('jam') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jam',
              'id'    => 'jam',
              'value'   => set_value('jam'),
              'type'    => 'time',
              'class' => 'form-control',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jam'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="latitude">Latitude:</label>
              <div class="col-sm-6 <?php echo form_error('latitude') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'latitude',
              'id'    => 'latitude',
              'value'   => set_value('latitude'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan latitude',
              'maxlength' => '50',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('latitude'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="longitude">Longitude:</label>
              <div class="col-sm-6 <?php echo form_error('longitude') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'longitude',
              'id'    => 'longitude',
              'value'   => set_value('longitude'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan longitude',
              'maxlength' => '50',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('longitude'); ?>
            </div>
            </div>




            <div class="col-sm-offset-2 col-sm-2">
            <?php
            $data = array(
              'type'    => 'reset',
              'name'    => 'reset',
              'class'   => 'btn btn-default btn-block',
              'value'   => 'Reset',
            );
            if (!validation_errors())
              echo form_reset($data); ?>
          </div>
            
          <div class="col-sm-2">
            <?php
            $data = array(
              'type'    => 'submit',
              'name'    => 'insert',
              'class'   => 'button btn btn-success btn-block',
              'value'   => 'Simpan Data',
            );
            echo form_input($data); ?>
          </div>
   