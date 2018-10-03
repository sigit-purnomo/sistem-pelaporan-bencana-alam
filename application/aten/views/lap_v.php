    	<?php
          $attributes = array('id' => 'chooseform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('report/form/',$attributes);
        ?>
      <h2>Laporan</h2>
      <div class="form-group">
        <label class="control-label col-sm-2" for="lat">Jenis:</label>
        <div class="radio col-sm-offset-2">
          <label><?php echo form_radio('jenislap', 'r1', TRUE);?><p class="s16">Laporan Awal TRC BPBD</p></label>
        </div>
        <div class="radio col-sm-offset-2">
          <label><?php echo form_radio('jenislap', 'r2', FALSE);?><p class="s16">Laporan Perkembangan TRC BPBD</p></label>
          </div>
        <div class="radio col-sm-offset-2">
          <label><?php echo form_radio('jenislap', 'r3', FALSE);?><p class="s16">Laporan Awal Posko</p></label>
          </div>
        <div class="radio col-sm-offset-2">
          <label><?php echo form_radio('jenislap', 'r4', FALSE);?><p class="s16">Laporan Perkembangan Posko</p></label>
          </div>
        <div class="radio col-sm-offset-2">
          <label><?php echo form_radio('jenislap', 'r5', FALSE);?><p class="s16">Grafik Perkembangan Bencana</p></label>
          </div>
        <div class="radio col-sm-offset-2">
          <label><?php echo form_radio('jenislap', 'r6', FALSE);?><p class="s16">Grafik Ringkasan Bencana</p></label>
         </div> 
         <?php echo form_error('jenislap'); ?>
        
      </div>
      <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-2">
	    <?php
            $data = array(
              'type'    => 'submit',
              'name'    => 'insert',
              'class'   => 'button btn btn-primary btn-block',
              'value'   => 'Pilih',
            );
            echo form_input($data); ?>
        </div>
    	</div>
