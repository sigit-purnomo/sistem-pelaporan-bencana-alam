<p>Pilih data bencana untuk menampilkan pemetaan yang lebih spesifik</p>
      <div class="form-group">
        <?php
          $attributes = array('id' => 'cbencana', 'role'=>'form');
          echo form_open('map/searching/',$attributes);
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
        <?php
        echo form_error('keyword');
        ?>
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