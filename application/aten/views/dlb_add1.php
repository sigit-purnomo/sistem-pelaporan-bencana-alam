<?php
          $attributes = array('id' => 'insertform','class'=>'form-horizontal', 'role'=>'form', 'name'=>'insertform');
          echo form_open('dlb/save/',$attributes);
        ?>
            <?php echo $this->session->flashdata('message');?>
            <h2>Data Laporan Bencana</h2>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tanggal_laporan">Tanggal laporan:</label>
              <div class="col-sm-6 <?php echo form_error('tanggal_laporan') == '' ? '' : 'has-error';?>">
              <?php
                $data = array(
                'name'    => 'tanggal_laporan',
                'id'    => 'tanggal_laporan',
                'value'   => set_value('tanggal_laporan'),
                'type'    => 'date',
                'max'   => date('Y-m-d'),
                'class' => 'form-control',
                'placeholder'=>'Masukkan tanggal bencana',
                'maxlength' => '50',
                'size'    => '35',
                'autofocus'   => 'autofocus',
                );
              echo form_input($data); ?>
              <?php echo form_error('tanggal_laporan'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jam_laporan">Jam laporan:</label>
              <div class="col-sm-6 <?php echo form_error('jam_laporan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jam_laporan',
              'id'    => 'jam_laporan',
              'value'   => set_value('jam_laporan'),
              'type'    => 'time',
              'class' => 'form-control',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jam_laporan'); ?>
            </div>
            </div>
            <div class="col-sm-offset-2">
              <h4>Tim Reaksi Cepat</h4>
            </div>
            
            <div class="form-group">
              <label class="control-label col-sm-2" for="tim_bpbd">Tim BPBD:</label>
              <div class="col-sm-6 <?php echo form_error('tim_bpbd') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'tim_bpbd',
              'id'    => 'tim_bpbd',
              'value'   => set_value('tim_bpbd'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah tim BPBD',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('tim_bpbd'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tim_dinsos">Tim Dinsos:</label>
              <div class="col-sm-6 <?php echo form_error('tim_dinsos') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'tim_dinsos',
              'id'    => 'tim_dinsos',
              'value'   => set_value('tim_dinsos'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah tim dinsos',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('tim_dinsos'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tim_dinkes">Tim Dinkes:</label>
              <div class="col-sm-6 <?php echo form_error('tim_dinkes') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'tim_dinkes',
              'id'    => 'tim_dinkes',
              'value'   => set_value('tim_dinkes'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah tim dinkes',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('tim_dinkes'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tim_pu">Tim PU:</label>
              <div class="col-sm-6 <?php echo form_error('tim_pu') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'tim_pu',
              'id'    => 'tim_pu',
              'value'   => set_value('tim_pu'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah korban tim PU',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('tim_pu'); ?>
            </div>
            </div>

            
            



            <div class="col-sm-offset-2">
              <h4>Kondisi Mutakhir</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="meninggal">Meninggal:</label>
              <div class="col-sm-6 <?php echo form_error('meninggal') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'meninggal',
              'id'    => 'meninggal',
              'value'   => set_value('meninggal'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah korban meninggal',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('meninggal'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="luka_berat">Luka berat:</label>
              <div class="col-sm-6 <?php echo form_error('luka_berat') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'luka_berat',
              'id'    => 'luka_berat',
              'value'   => set_value('luka_berat'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah korban luka berat',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('luka_berat'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="luka_ringan">Luka ringan:</label>
              <div class="col-sm-6 <?php echo form_error('luka_ringan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'luka_ringan',
              'id'    => 'luka_ringan',
              'value'   => set_value('luka_ringan'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah korban luka ringan',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('luka_ringan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="hilang">Hilang:</label>
              <div class="col-sm-6 <?php echo form_error('hilang') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'hilang',
              'id'    => 'hilang',
              'value'   => set_value('hilang'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah korban hilang',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('hilang'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="mengungsi_jiwa">Mengungsi (jiwa):</label>
              <div class="col-sm-6 <?php echo form_error('mengungsi_jiwa') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'mengungsi_jiwa',
              'id'    => 'mengungsi_jiwa',
              'value'   => set_value('mengungsi_jiwa'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan pengungsi (jiwa)',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('mengungsi_kk'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="mengungsi_kk">Mengungsi (kk):</label>
              <div class="col-sm-6 <?php echo form_error('mengungsi_kk') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'mengungsi_kk',
              'id'    => 'mengungsi_kk',
              'value'   => set_value('mengungsi_kk'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan pengungsi (keluarga)',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('mengungsi_kk'); ?>
            </div>
            </div>

            <div class="col-sm-offset-2">
              <h4>Kerusakan</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="rumah">Rumah:</label>
              <div class="col-sm-6 <?php echo form_error('rumah') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'rumah',
              'id'    => 'rumah',
              'value'   => set_value('rumah'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan rumah',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('rumah'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kantor">Kantor:</label>
              <div class="col-sm-6 <?php echo form_error('kantor') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'kantor',
              'id'    => 'kantor',
              'value'   => set_value('kantor'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan kantor',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('kantor'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fasilitas_kesehatan">Fasilitas kesehatan:</label>
              <div class="col-sm-6 <?php echo form_error('fasilitas_kesehatan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'fasilitas_kesehatan',
              'id'    => 'fasilitas_kesehatan',
              'value'   => set_value('fasilitas_kesehatan'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan fasilitas kesehatan',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('fasilitas_kesehatan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fasilitas_pendidikan">Fasilitas pendidikan:</label>
              <div class="col-sm-6 <?php echo form_error('fasilitas_pendidikan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'fasilitas_pendidikan',
              'id'    => 'fasilitas_pendidikan',
              'value'   => set_value('fasilitas_pendidikan'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan fasilitas pendidikan',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('fasilitas_pendidikan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="fasilitas_umum">Fasilitas umum:</label>
              <div class="col-sm-6 <?php echo form_error('fasilitas_umum') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'fasilitas_umum',
              'id'    => 'fasilitas_umum',
              'value'   => set_value('fasilitas_umum'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan fasilitas umum',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('fasilitas_umum'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sarana_ibadah">Sarana ibadah:</label>
              <div class="col-sm-6 <?php echo form_error('sarana_ibadah') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'sarana_ibadah',
              'id'    => 'sarana_ibadah',
              'value'   => set_value('sarana_ibadah'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan sarana ibadah',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('sarana_ibadah'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jembatan">Jembatan:</label>
              <div class="col-sm-6 <?php echo form_error('jembatan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jembatan',
              'id'    => 'jembatan',
              'value'   => set_value('jembatan'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan jembatan',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jembatan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="jalan">Jalan:</label>
              <div class="col-sm-6 <?php echo form_error('jalan') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'jalan',
              'id'    => 'jalan',
              'value'   => set_value('jalan'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan jalan',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('jalan'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="tanggul">Tanggul:</label>
              <div class="col-sm-6 <?php echo form_error('tanggul') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'tanggul',
              'id'    => 'tanggul',
              'value'   => set_value('tanggul'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan tanggul',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('tanggul'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sawah">Sawah:</label>
              <div class="col-sm-6 <?php echo form_error('sawah') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'sawah',
              'id'    => 'sawah',
              'value'   => set_value('sawah'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan sawah',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('sawah'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lahan_pertanian">Lahan pertanian:</label>
              <div class="col-sm-6 <?php echo form_error('lahan_pertanian') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lahan_pertanian',
              'id'    => 'lahan_pertanian',
              'value'   => set_value('lahan_pertanian'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan lahan pertanian',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lahan_pertanian'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="lain_lain">Lain-lain:</label>
              <div class="col-sm-6 <?php echo form_error('lain_lain') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'lain_lain',
              'id'    => 'lain_lain',
              'value'   => set_value('lain_lain'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan jumlah kerusakan lainnya',
              'maxlength' => '10',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('lain_lain'); ?>
            </div>
            </div>

            <div class="col-sm-offset-2">
              <h4>Kunjungan Bupati</h4>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="bupati_tgl">Tanggal:</label>
              <div class="col-sm-6 <?php echo form_error('bupati_tgl') == '' ? '' : 'has-error';?>">
              <?php
                $data = array(
                'name'    => 'bupati_tgl',
                'id'    => 'bupati_tgl',
                'value'   => set_value('bupati_tgl'),
                'type'    => 'date',
                'max'   => date('Y-m-d'),
                'class' => 'form-control',
                'placeholder'=>'Masukkan tanggal',
                'maxlength' => '50',
                'size'    => '35',
                );
              echo form_input($data); ?>
              <?php echo form_error('bupati_tgl'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="bupati_jam">Jam:</label>
              <div class="col-sm-6 <?php echo form_error('bupati_jam') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'bupati_jam',
              'id'    => 'bupati_jam',
              'value'   => set_value('bupati_jam'),
              'type'    => 'time',
              'class' => 'form-control',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('bupati_jam'); ?>
            </div>
            </div>
            <div class="col-sm-offset-2">
              <h4>Upaya Penanganan</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="posko">Posko:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('posko', '1', FALSE,set_radio('posko', '1'));?>Sudah</label>
                <label><?php echo form_radio('posko', '0', FALSE,set_radio('posko', '0'));?>Belum</label>
                <?php echo form_error('posko'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="koordinasi">Koordinasi:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('koordinasi', '1', FALSE,set_radio('koordinasi', '1'));?>Sudah</label>
                <label><?php echo form_radio('koordinasi', '0', FALSE,set_radio('koordinasi', '0'));?>Belum</label>
                <?php echo form_error('koordinasi'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="evakuasi">Evakuasi:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('evakuasi', '1', FALSE,set_radio('evakuasi', '1'));?>Sudah</label>
                <label><?php echo form_radio('evakuasi', '0', FALSE,set_radio('evakuasi', '0'));?>Belum</label>
                <?php echo form_error('evakuasi'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kesehatan">Kesehatan:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('kesehatan', '1', FALSE,set_radio('kesehatan', '1'));?>Sudah</label>
                <label><?php echo form_radio('kesehatan', '0', FALSE,set_radio('kesehatan', '0'));?>Belum</label>
                <?php echo form_error('kesehatan'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="dapur">Dapur:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('dapur', '1', FALSE,set_radio('dapur', '1'));?>Sudah</label>
                <label><?php echo form_radio('dapur', '0', FALSE,set_radio('dapur', '0'));?>Belum</label>
                <?php echo form_error('dapur'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="distribusi">Distribusi:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('distribusi', '1', FALSE,set_radio('distribusi', '1'));?>Sudah</label>
                <label><?php echo form_radio('distribusi', '0', FALSE,set_radio('distribusi', '0'));?>Belum</label>
                <?php echo form_error('distribusi'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pengerahan">Pengerahan:</label>
              <div class="radio col-sm-4">
                <label><?php echo form_radio('pengerahan', '1', FALSE,set_radio('pengerahan', '1'));?>Sudah</label>
                <label><?php echo form_radio('pengerahan', '0', FALSE,set_radio('pengerahan', '0'));?>Belum</label>
                <?php echo form_error('pengerahan'); ?>
              </div>
            </div>


            <div class="col-sm-offset-2">
              <h4>Kebutuhan</h4>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="sumber_daya">Sumber daya:</label>
              <div class="col-sm-6 <?php echo form_error('sumber_daya') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'sumber_daya',
              'id'    => 'sumber_daya',
              'value'   => set_value('sumber_daya'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan sumber daya yang dibutuhkan',
              'rows' => '5',
              'cols'    => '35',
              );
            echo form_textarea($data); ?>
            <?php echo form_error('sumber_daya'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kendala">Kendala:</label>
              <div class="col-sm-6 <?php echo form_error('kendala') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'kendala',
              'id'    => 'kendala',
              'value'   => set_value('kendala'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan kendala yang dihadapi',
              'rows' => '5',
              'cols'    => '35',
              );
            echo form_textarea($data); ?>
            <?php echo form_error('kendala'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="kebutuhan_mendesak">Kebutuhan mendesak:</label>
              <div class="col-sm-6 <?php echo form_error('kebutuhan_mendesak') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'kebutuhan_mendesak',
              'id'    => 'kebutuhan_mendesak',
              'value'   => set_value('kebutuhan_mendesak'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan kebutuhan mendesak yang dibutuhkan',
              'rows' => '5',
              'cols'    => '35',
              );
            echo form_textarea($data); ?>
            <?php echo form_error('kebutuhan_mendesak'); ?>
            </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="rencana_tindaklanjut">Rencana tindak lanjut:</label>
              <div class="col-sm-6 <?php echo form_error('rencana_tindaklanjut') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'rencana_tindaklanjut',
              'id'    => 'rencana_tindaklanjut',
              'value'   => set_value('rencana_tindaklanjut'),
              'class' => 'form-control',
              'placeholder'=>'Masukkan rencana tindak lanjut',
              'rows' => '5',
              'cols'    => '35',
              );
            echo form_textarea($data); ?>
            <?php echo form_error('rencana_tindaklanjut'); ?>
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
              'name'    => 'insert1',
              'class'   => 'button btn btn-success btn-block',
              'value'   => 'Simpan Data',
            );
            echo form_input($data); ?>
          </div>
