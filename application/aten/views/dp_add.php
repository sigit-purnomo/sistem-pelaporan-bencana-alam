        <?php
          $attributes = array('id' => 'insertform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('dp/save/',$attributes);
        ?>
            <?php echo $this->session->flashdata('message');?>
            <h2>Data Posko</h2>
            <div class="form-group">
              <label class="control-label col-sm-2" for="nama_posko">Nama posko:</label>
              <div class="col-sm-6 <?php echo form_error('nama_posko') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'nama_posko',
              'id'    => 'nama_posko',
              'value'   => set_value('nama_posko'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan nama posko',
              'maxlength' => '50',
              'size'    => '35',
              'autofocus'   => 'autofocus',
              );
            echo form_input($data); ?>
            <?php echo form_error('nama_posko'); ?>
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
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('longitude'); ?>
            </div>
            </div>
            <div class="col-sm-offset-2">
              <h4>Lokasi Posko</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lokasi_posko_dusun">Dusun:</label>
              <div class="col-sm-6 <?php echo form_error('lokasi_posko_dusun') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lokasi_posko_dusun',
              'id'    => 'lokasi_posko_dusun',
              'value'   => set_value('lokasi_posko_dusun'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan nama dusun',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lokasi_posko_dusun'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lokasi_posko_kecamatan">Kecamatan:</label>
              <div class="col-sm-6 <?php echo form_error('lokasi_posko_kecamatan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lokasi_posko_kecamatan',
              'id'    => 'lokasi_posko_kecamatan',
              'value'   => set_value('lokasi_posko_kecamatan'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan nama kecamatan',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lokasi_posko_kecamatan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lokasi_posko_kota">Kota:</label>
              <div class="col-sm-6 <?php echo form_error('lokasi_posko_kota') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lokasi_posko_kota',
              'id'    => 'lokasi_posko_kota',
              'value'   => set_value('lokasi_posko_kota'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan nama kota',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lokasi_posko_kota'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lokasi_posko_provinsi">Provinsi:</label>
              <div class="col-sm-6 <?php echo form_error('lokasi_posko_provinsi') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lokasi_posko_provinsi',
              'id'    => 'lokasi_posko_provinsi',
              'value'   => set_value('lokasi_posko_provinsi'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan nama provinsi',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lokasi_posko_provinsi'); ?>
            </div>
            </div>



            <div class="col-sm-offset-2 col-sm-2">
               <?php
            $data = array(
              'type'    => 'reset',
              'name'    => 'reset',
              'class'   => 'button btn btn-default btn-block',
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
