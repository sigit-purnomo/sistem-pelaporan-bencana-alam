<h3><?= $page_title ?></h3>

<?php $flashmessage = $this->session->flashdata('exist');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': ''; ?>

<?php echo form_open('admin/c_relawan/update_relawan'); ?>
<script type="text/javascript">
  
     $(function() {
    $('#username').on('keypress', function(e) {
        if (e.which == 32)
            return false;
    });
});
</script>
	<legend></legend>
	<input   id="id_user" name="id_user" type="hidden" 
      placeholder="" class="form-control input-md" value="<?=$id_user?>">
  <!-- Text input-->
  <div class="form-group">
    <label  class="col-md-2 control-label" for="nama">Nama Lengkap</label>
    <div class="col-md-10">
      <input   id="nama_lengkap" name="nama_lengkap" type="text" 
      placeholder="Nama Lengkap" class="form-control input-md" value="<?=$data_petugas->nama_lengkap?>">
      <span class="help-block"><?php echo form_error('nama_lengkap', '<p class="field_error">','</p>')?></span>  
    </div>
  </div>
  <div class="form-group">
    <label  class="col-md-2 control-label" for="nama">Username</label>
    <div class="col-md-10">
      <input   id="username" name="username" type="text" 
      placeholder="Username" class="form-control input-md" value="<?=$data_petugas->username?>">
      <span class="help-block"><?php echo form_error('username', '<p class="field_error">','</p>')?></span>  
    </div>
  </div>
  <div class="form-group">
    <label  class="col-md-2 control-label" for="nama">Nomor Handphone</label>
    <div class="col-md-10">
    <div class="input-group">
     <span class="input-group-addon" id="basic-addon1">+62</span>
       <input id="no_hp" name="no_hp" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
      placeholder="Nomor Handphone (cth : 81012345678)" class="form-control" value="<?= str_replace('+62', '', $data_petugas->no_hp);?>">
      
    </div>
    <span class="help-block"><?php echo form_error('no_hp', '<p class="field_error">','</p>')?></span> 
    </div>
  </div>
    <!-- <div class="form-group">
    <label  class="col-md-2 control-label" for="nama">Nomor Handphone</label>
    <div class="col-md-10">
    <span class="input-group-addon" id="basic-addon1">+62</span>
      <input   id="no_hp" name="no_hp" type="text" 
      placeholder="No HP" class="form-control" value="<?=$data_petugas->no_hp?>">
      <span class="help-block"><?php echo form_error('no_hp', '<p class="field_error">','</p>')?></span>  
    </div>
  </div> -->
  <div class="form-group">
    <div class="col-md-12">
    <p>
      <input  type="submit" value="Simpan" id="simpan" class="btn btn-success"/>
      <input  type="button" value="Batal" id="batal" class="btn btn-danger" onclick="location.href='<?= base_url() ?>admin/c_relawan'"/>
      </p>
      </div>

    </div>
  </div>
  
<legend></legend>


<?php echo form_close(); ?>

<script>
function nav_active(){
  document.getElementById("relawan").className = "collapsed active";
  }
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>