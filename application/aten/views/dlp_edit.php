      <?php 
        if($detail!=NULL)
        {
          if(count($detail) > 0) { 
            foreach($detail as $rows) {

              $id_laporan = $rows['id_laporan'];
              $tgl_lap_posko = $rows['tgl_lap_posko'];
              $jam_lap_posko = $rows['jam_lap_posko'];
              $kapasitas = $rows['kapasitas'];

              $fasilitas_dapur = $rows['fasilitas_dapur'];
              $fasilitas_kesehatan = $rows['fasilitas_kesehatan'];
              $fasilitas_mck = $rows['fasilitas_mck'];

              $jumlah_kk = $rows['jumlah_kk'];
              $jumlah_pria = $rows['jumlah_pria'];
              $jumlah_wanita = $rows['jumlah_wanita'];
              $jumlah_balita = $rows['jumlah_balita'];            
            }
          }
        }
        //setelah repopulating data dari database, kemudian supaya di form_validation tidak error
        if (!isset($id_laporan)) $id_laporan = "";
        if (!isset($tgl_lap_posko)) $tgl_lap_posko = "";
        if (!isset($jam_lap_posko)) $jam_lap_posko = "";
        if (!isset($kapasitas)) $kapasitas = "";

        if (!isset($fasilitas_dapur)) $fasilitas_dapur = "";
        if (!isset($fasilitas_kesehatan)) $fasilitas_kesehatan = "";
        if (!isset($fasilitas_mck)) $fasilitas_mck = "";
        
        if (!isset($jumlah_kk)) $jumlah_kk = "";
        if (!isset($jumlah_pria)) $jumlah_pria = "";
        if (!isset($jumlah_wanita)) $jumlah_wanita = "";
        if (!isset($jumlah_balita)) $jumlah_balita = "";
      
      ?>
        <?php
          $attributes = array('id' => 'editform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('dlp/update/',$attributes);
        ?>
            <?php echo $this->session->flashdata('message');?>
            
            <h2>Data Laporan Posko</h2>
            <?php
            //if (!isset($idbencana)) $idbencana = "";
              $data = array(
              'name'    => 'id_laporan',
              'id'    => 'id_laporan',
              'class' => 'form-control',
              'value'   => set_value('id_laporan',$id_laporan),
              'type'    => 'hidden',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tgl_lap_posko">Tanggal laporan:</label>
              <div class="col-sm-6 <?php echo form_error('tgl_lap_posko') == '' ? '' : 'has-error';?>">
              <?php
                $data = array(
                'name'    => 'tgl_lap_posko',
                'id'    => 'tgl_lap_posko',
                'value'   => set_value('tgl_lap_posko',$tgl_lap_posko),
                'type'    => 'date',
                'max'   => date('Y-m-d'),
                'class' => 'form-control',
                'placeholder'=>'Masukkan tanggal',
                'maxlength' => '50',
                'size'    => '35',
                );
              echo form_input($data); ?>
              <?php echo form_error('tgl_lap_posko'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jam_lap_posko">Jam laporan:</label>
              <div class="col-sm-6 <?php echo form_error('jam_lap_posko') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jam_lap_posko',
              'id'    => 'jam_lap_posko',
              'value'   => set_value('jam_lap_posko',$jam_lap_posko),
              'type'    => 'time',
              'class' => 'form-control',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jam_lap_posko'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kapasitas">Kapasitas:</label>
              <div class="col-sm-6 <?php echo form_error('kapasitas') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'kapasitas',
              'id'    => 'kapasitas',
              'value'   => set_value('kapasitas',$kapasitas),
              'class' => 'form-control',
              'placeholder'=>'Masukkan kapasitas posko',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('kapasitas'); ?>
            </div>
            </div>

            <div class="col-sm-offset-2">
              <h4>Jumlah Fasilitas</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fasilitas_dapur">Fasilitas dapur:</label>
              <div class="col-sm-6 <?php echo form_error('fasilitas_dapur') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'fasilitas_dapur',
              'id'    => 'fasilitas_dapur',
              'value'   => set_value('fasilitas_dapur',$fasilitas_dapur),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah fasilitas dapur',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('fasilitas_dapur'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fasilitas_kesehatan">Fasilitas kesehatan:</label>
              <div class="col-sm-6 <?php echo form_error('fasilitas_kesehatan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'fasilitas_kesehatan',
              'id'    => 'fasilitas_kesehatan',
              'value'   => set_value('fasilitas_kesehatan',$fasilitas_kesehatan),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah fasilitas kesehatan',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('fasilitas_kesehatan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fasilitas_mck">Fasilitas mck:</label>
              <div class="col-sm-6 <?php echo form_error('fasilitas_mck') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'fasilitas_mck',
              'id'    => 'fasilitas_mck',
              'value'   => set_value('fasilitas_mck',$fasilitas_mck),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah fasilitas mck',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('fasilitas_mck'); ?>
            </div>
            </div>


            <div class="col-sm-offset-2">
              <h4>Jumlah Pengungsi</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jumlah_kk">KK:</label>
              <div class="col-sm-6 <?php echo form_error('jumlah_kk') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jumlah_kk',
              'id'    => 'jumlah_kk',
              'value'   => set_value('jumlah_kk',$jumlah_kk),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kk',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jumlah_kk'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jumlah_pria">Pria:</label>
              <div class="col-sm-6 <?php echo form_error('jumlah_pria') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jumlah_pria',
              'id'    => 'jumlah_pria',
              'value'   => set_value('jumlah_pria',$jumlah_pria),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah pengungsi pria',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jumlah_pria'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jumlah_wanita">Wanita:</label>
              <div class="col-sm-6 <?php echo form_error('jumlah_wanita') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jumlah_wanita',
              'id'    => 'jumlah_wanita',
              'value'   => set_value('jumlah_wanita',$jumlah_wanita),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah pengungsi wanita',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jumlah_wanita'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jumlah_balita">Balita:</label>
              <div class="col-sm-6 <?php echo form_error('jumlah_balita') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jumlah_balita',
              'id'    => 'jumlah_balita',
              'value'   => set_value('jumlah_balita',$jumlah_balita),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah pengungsi balita',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jumlah_balita'); ?>
            </div>
            </div>

            <div class="col-sm-offset-2 col-sm-2">
            <?php
            $data = array(
              'type'    => 'submit',
              'name'    => 'insert',
              'class'   => 'button btn btn-success btn-block',
              'value'   => 'Simpan Data',
            );
            echo form_input($data); ?>
          </div>