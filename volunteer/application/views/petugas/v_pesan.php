<script src="http://code.jquery.com/qunit/qunit-1.14.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://raw.githubusercontent.com/alex-seville/blanket/master/dist/qunit/blanket.min.js"></script>
    <script type="text/javascript" src="<?=$this->config->item('base_url');?>js/listgroup.js"</script>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';

var ids = [];
var checked = [];

function markID(id_user, reg_id){
	if(!checked[id_user]){
		checked[id_user] = true;
		ids[id_user] = reg_id;
	}
	else{
		checked[id_user] = false;
		ids[id_user] = '';
	}
	document.form_pesan.data_reg.value = ids;
}


</script>



<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">Kirim Pemberitahuan</h1>
   </div>
   <!-- /.col-lg-12 -->
</div>
<div class="notice<?php echo $notice_class; ?>">
	<?php  echo $notice ?> <!-- variabel ini yang aku mau echo mas pake variabel notice -->
</div>


<form action="<?php  echo site_url("admin/c_pesan/form");?>" method="post" name="form_pesan">
         
 <div class="form-group">
	
		<input id="data_reg" name="data_reg" type="hidden" />
	 <div>
	   <label for="kode">Pilih Relawan</label>
	          <span class="colon">: </span>
	   </div>
	
    <div>
	  
	  <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		  Pilih Kontak Relawan 
		</a> 
    <div class="collapse" id="collapseExample">
	  <div class="well" id="wrap" name="wrap">
		<input id="btn1" name="btn1" class="btn btn-primary" value="Pilih Semua Relawan" role="button" onclick="change()"></input> 
				
		<br>
		   </br>
		    <ul style="max-height: 200px;	overflow-y:scroll;">         	
		              <?php
					   foreach($Hasil as $things=> $value)
					   {
					   ?>
					   <div id="penerima" class="list-group" data-toggle="items" >
					   <!-- Modified by Vincent, add reg_id parameter -->
				<a class="list-group-item" onclick="markID(<?php echo $value['id_user']; ?>, '<?php echo $value['reg_id']; ?>')">

					    <?php echo $value['username']?> > <?php echo $value['id_user']?> </a></div>
						
					<?php	
					   }
					   ?>
		    </ul>
		</div>
    </div>
 </div>
<div class="form-group">
   
  <label for="kode">Isi Pesan</label><span class="colon">: </span>
  <div >
  <textarea id="pesan" name="pesan" maxlength="160"class="form-control" name="pesan" rows="4" cols="50" required></textarea>
    <span class="help-block"></span>
  <p class="counter" style="font-size:12px"><b></b> <b></b>Push Notification </p>
    
  </div>
  <div class="clr"></div>
</div>
<div class="form-group">
  <label for="kode"></label><span class="colon"></span>
  <div id="nomor">
    <input type="submit" class="btn btn-success" name="action" value="Kirim Pesan"  >
  </div>
  <div class="clr"></div>
</div>
</form>


<script>
function nav_active(){

	document.getElementById("pesan").className = "collapsed active";
	}
 
</script>

<script>
 
// very simple to use!
$(document).ready(function() {

// jQuery event

	$('#btn1').click(function() {
		$('.list-group-item').each(function(i){
			$(this).trigger('click');
		});
	});
	
	$('#btn2').click(function() {
		ids = [];
		document.form_pesan.data_reg.value = ids;
	
	});

	

});
 

</script>