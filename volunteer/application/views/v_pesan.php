<link href="<?=$this->config->item('base_url');?>css/flexigrid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/jquery.pack.js"></script>
<script type="text/javascript" src="<?=$this->config->item('base_url');?>js/flexigrid.pack.js"></script>
<?php
echo $js_grid;
?>

<script type="text/javascript">
var _base_url = '<?= base_url() ?>';


function edit_petugas(id) {
  window.location = _base_url + 'admin/c_petugas/edit_petugas/' + id;
}
function reset_petugas(id) {
	 var r=confirm("Apakah Anda benar-benar akan mereset password petugas ini?"); 

    if (r==true)  {   $.post("<?php  echo base_url(); ?>admin/c_petugas/reset_petugas/"+id);
                   location.reload();
                  alert("Data berhasil terupdate ke server.");
              }
}
function btn(com,grid)
{
    if (com=='Tandai Semua')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }

    if (com=='Hapus Semua Tanda')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
	
	if (com=='Hapus Petugas')
        {
	          if($('.trSelected',grid).length==1){
	         if(confirm('Hapus ' + $('.trSelected',grid).length + ' item?')){
	                var items = $('.trSelected',grid);
	                var itemlist ='';
	              for(i=0;i<items.length;i++){
	            itemlist+= items[i].id.substr(3);
	          }
	          $.ajax({
	             type: "POST",
	             url: "<?=site_url("admin/c_petugas/delete/");?>",
	             data: "items="+itemlist,
	             success: function(data){
	              $('#flex1').flexReload();
	              alertify.success("Data berhasil dihapus !");
	             }
	             ,
	            error: function() {
	              alertify.error("Gagal menghapus!");
	            }
	          });
	        }
	      } else {
                 myObj=$('.trSelected',grid);
                var ids = $.map(myObj, function (item) { return item.id.substr(3)  });
                 //alertify.error(ids);
                if (ids=="") 
                    {alertify.error("Pilih data terlebih dahulu!");}
                else {
                         var r=confirm("Apakah Anda benar-benar akan menghapus data yang terpilih?");
                        if (r==true)  
                        { 
                            for (var i = ids.length - 1; i >= 0; i--) 
                            {                
                               $.ajax({
                               type: "POST",
                               url: "<?=site_url("admin/c_petugas/delete/");?>",
                               data: "items="+ids[i],
                               success: function(data){
                                $('#flex1').flexReload();
                                
                               }
                               ,
                              error: function() {
                                alertify.error("Gagal menghapus!");
                              }
                            });
                            };alertify.success("Data berhasil dihapus !");
                        }
                    }
       
              }
        }
}

</script>


<div class="row">
   <div class="col-lg-12">
      <h1 class="page-header">Kirim Pesan</h1>
   </div>
   <!-- /.col-lg-12 -->
</div>

<form action="" method="post">


<div class="form-group">
   <label for="kode">Pilih Relawan</label>
          <span class="colon">: </span>
   </div>

    <div>
	 <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  Pilih Kontak Petugas atau Relawan 
</a> 
<div class="collapse" id="collapseExample">
  <div class="well" id="wrap">
    <ul class="list-group" id="list" style=" max-height: 200px;
    overflow-y:scroll; " >
          <div class="panel-body">
            <div class="dataTable_wrapper">
              	
		<table id="flex1" style="display:none"></table>

            </div>
            <!-- /.table-responsive -->
         </div>

    </ul>

</div>
</div>
 </div>
<div class="form-group">
  <label for="kode">Isi Pesan</label><span class="colon">: </span>
  <div >
  <textarea id="pesan" maxlength="160"class="form-control" name="pesan" rows="4" cols="50" required></textarea>
    <span class="help-block"></span>
  <p class="counter" style="font-size:12px"><b></b> <b></b>Push Notification </p>
    
  </div>
  <div class="clr"></div>
</div>
<div class="form-group">
  <label for="kode"></label><span class="colon"></span>
  <div id="nomor">
    <input type="submit" class="btn btn-success" name="action" value="Kirim Pesan"  >
     <input type="submit" class="btn btn-success" name="action" value="Kirim ke Semua Relawan"  >
  </div>
  <div class="clr"></div>
</div>
</form>


<script>
function nav_active(){
	document.getElementById("pesan").className = "collapsed active";
	}
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>