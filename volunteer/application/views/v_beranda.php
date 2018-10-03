<script>
var map;
var i = 0;
var gaw = 0;
var poly = {};
var markers = {};
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -6.982842, lng: 110.435838},
    zoom: 7,
    streetViewControl: false,
    zoomControl: false
  });

   var jsonKab = <?=$pet?>;
      var jsonGawat = <?=$gawat?>;
  var coordArray = [];
  var namaArray = [];
  var latlng = [];
  var nama = [];
  var path = [];
  
   var btn = document.getElementById('center');

  map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(btn);

  //Marker
  var markerImage = '<?= base_url() ?>images/marker.png';
  var markerImage2 = '<?= base_url() ?>images/marker_red.png';



  for(j=0;j<jsonKab.length;j++){
    var d = new Date(jsonKab[j].waktu);
    var date=formatDate(d);

    if(jsonKab[j].sta==1 && jsonKab[j].jam<=24)
    {  
        console.log(jsonKab[j].lat);
        console.log(jsonKab[j].lon);

      markers = new google.maps.Marker({
        position: new google.maps.LatLng(parseFloat(jsonKab[j].lat), parseFloat(jsonKab[j].lon)),
        map: map,
        icon: markerImage2,
        title: jsonKab[j].nama
      });
      attachMarkerInfoWindow(markers, 'Nama : <b>'+jsonKab[j].nama+'</b><br>No HP : <b>'+jsonKab[j].nohp+'</b><br>Tanggal : <b>'+date+'</b><br>(lat,long) : <b>('+jsonKab[j].lat+','+jsonKab[j].lon+')</b><br>');
      google.maps.event.addListener(markers, 'click', function() {
        smoothZoom(map, 12, map.getZoom());
        map.panTo(this.getPosition());
      });  
      latlng = [];
    }
    else{ 
      for(gaw=0;gaw<jsonGawat.length;gaw++){
            if(jsonKab[j].id_user==jsonGawat[gaw].id_user)
                { 

                    if(jsonGawat[gaw].jam<=24) 
                    {
                      console.log(jsonKab[j].lat);
                        console.log(jsonKab[j].lon);

                      markers = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(jsonKab[j].lat), parseFloat(jsonKab[j].lon)),
                        map: map,
                        icon: markerImage2,
                        title: jsonKab[j].nama
                      });
                      attachMarkerInfoWindow(markers, 'Nama : <b>'+jsonKab[j].nama+'</b><br>No HP : <b>'+jsonKab[j].nohp+'</b><br>Tanggal : <b>'+date+'</b><br>(lat,long) : <b>('+jsonKab[j].lat+','+jsonKab[j].lon+')</b><br>');
                      google.maps.event.addListener(markers, 'click', function() {
                        smoothZoom(map, 12, map.getZoom());
                        map.panTo(this.getPosition());
                      });  
                      latlng = [];
                    }
                     if(jsonGawat[gaw].jam>24) 
                    {
                      console.log(jsonKab[j].lat);
                        console.log(jsonKab[j].lon);

                      markers = new google.maps.Marker({
                        position: new google.maps.LatLng(parseFloat(jsonKab[j].lat), parseFloat(jsonKab[j].lon)),
                        map: map,
                        icon: markerImage,
                        title: jsonKab[j].nama
                      });
                      attachMarkerInfoWindow(markers, 'Nama : <b>'+jsonKab[j].nama+'</b><br>No HP : <b>'+jsonKab[j].nohp+'</b><br>Tanggal : <b>'+date+'</b><br>(lat,long) : <b>('+jsonKab[j].lat+','+jsonKab[j].lon+')</b><br>');
                      google.maps.event.addListener(markers, 'click', function() {
                        smoothZoom(map, 12, map.getZoom());
                        map.panTo(this.getPosition());
                      });  
                      latlng = [];
                    }
                }

            else
                  {
                  console.log(jsonKab[j].lat);
                console.log(jsonKab[j].lon);
                markers = new google.maps.Marker({
                  position: new google.maps.LatLng(parseFloat(jsonKab[j].lat), parseFloat(jsonKab[j].lon)),
                  map: map,
                  icon: markerImage,
                  title: jsonKab[j].nama
                });
                 attachMarkerInfoWindow(markers, 'Nama : <b>'+jsonKab[j].nama+'</b><br>No HP : <b>'+jsonKab[j].nohp+'</b><br>Tanggal : <b>'+date+'</b><br>(lat,long) :<b>('+jsonKab[j].lat+','+jsonKab[j].lon+')</b><br>');
                google.maps.event.addListener(markers, 'click', function() {
                  smoothZoom(map, 12, map.getZoom());
                  map.panTo(this.getPosition());
                });  
                latlng = [];
                }
      }
      
    } 
  }

  //PETA POLYGON DAN MARKER////

  $('#center').click(function(e) {
        map.setZoom(7);
        // map.setCenter(new google.maps.LatLng(-1.55038056899795, 118.6962890625));
        map.setCenter(new google.maps.LatLng(-6.982842, 110.435838));
    });

    var input = document.getElementById('pac-input');

    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

    map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
   });

   var markers = [];

  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      // Create a marker for each place.
      markers.push(new google.maps.Marker({
        map: map,
        title: place.name,
        position: place.geometry.location
        //document.getElementById("lat").value = place.geometry.Latitude
      }));
      
      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}
function smoothZoom (map, max, cnt) {
    if (cnt >= max) {
            return;
        }
    else {
        z = google.maps.event.addListener(map, 'zoom_changed', function(event){
            google.maps.event.removeListener(z);
            smoothZoom(map, max, cnt + 1);
        });
        setTimeout(function(){map.setZoom(cnt)}, 30); // 80ms is what I found to work well on my system -- it might not work well on all systems
    }
}  
function CenterControl(controlDiv, map) {

  // Set CSS for the control border.
  var controlUI = document.createElement('div');
  controlUI.style.backgroundColor = '#d9534f';
  controlUI.style.border = '2px solid #d9534f';
  controlUI.style.borderRadius = '3px';
  controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
  controlUI.style.cursor = 'pointer';
  controlUI.style.marginBottom = '15px';
  controlUI.style.textAlign = 'center';
  controlUI.title = 'Klik untuk membersihkan peta!';
  controlDiv.appendChild(controlUI);

  // Set CSS for the control interior.
  var controlText = document.createElement('div');
  controlText.style.color = 'rgb(255,255,255)';
  controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
  controlText.style.fontSize = '12px';
  controlText.style.lineHeight = '20px';
  controlText.style.paddingLeft = '5px';
  controlText.style.paddingRight = '5px';
  controlText.innerHTML = 'Center';
  controlUI.appendChild(controlText);

  // Setup the click event listeners: simply set the map to Chicago.
  controlUI.addEventListener('click', function() {
    
  });
}
function formatDate(date) {
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';

  minutes = minutes < 10 ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes ;
  return  date.getDate()+ "/" + (date.getMonth()+1) + "/" + date.getFullYear() + " | Jam : " + strTime;
}
function attachMarkerInfoWindow(marker, html)
{
  marker.infoWindow = new google.maps.InfoWindow({
    content: html,
  });
  google.maps.event.addListener(marker, 'mouseover', function() {
    marker.infoWindow.open(map,marker);
  });
  google.maps.event.addListener(marker, 'mouseout', function() {
    marker.infoWindow.close();
  });
}
  </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1VnKuIY4a5-rTBayKm_BqjcZ0wpMHhM0&callback=initMap&libraries=places&sensor=false"
        async defer></script>
<div class="col-lg-12">
 <h3 class="page-header">Peta Lokasi Relawan</h3>
  <div class="panel panel-info">
    <div class="panel-heading">
    <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Pencarian Relawan
    </a>
     <a class="btn btn-info" role="button" href="<?php echo site_url('admin/c_admin');?>" id="beranda" > Tampilkan Semua Relawan</a>
<div class="collapse" id="collapseExample" >
  <div class="well" id="wrap">
  <form action="<?php  echo site_url("admin/c_admin/");?>" method="post"> 
    <div class="form-group">
    <div class="col-sm-3 col-md-5">
      <p id="header" >Cari Relawan</p> 
    <ul class="list-group" id="list" style=" max-height: 150px; width:300px;
    overflow-y:scroll; " >
      <?php
             foreach($Hasil as $things=> $value)
             {
             ?>
              <li class="list-group-item" ><a href="javascript:KlikNomer('<?php echo $value['nama_lengkap']?>',<?php echo $value['id_user']?>);"><?php echo $value['nama_lengkap']?> >  <td><?php echo $value['no_hp']?></a></li>
          
          <?php 
             }
             ?>

</ul>
<p>*Nama relawan tidak ada jika belum memiliki lokasi </p>

</div>

<label for="kode">Nama Relawan</label><span class="colon">: </span>
        <div class="input-group">
          <input id="penerima" readonly="readonly" name="penerima" type="text" placeholder="Nama Relawan" value="<?php if($nama!=null)echo $nama; ?>" class="form-control input-md" size="100%">
          <input id="idnya" name="idnya" type="hidden" placeholder="ID Relawan" class="form-control input-md" value="<?php if($id_user!=null)echo $id_user; ?>" size="100%" >

          <span class="help-block"></span>
        </div>

   </div>
   <div class="form-group">           
    <div>   
     <label for="kode">Mulai Tanggal :</label>
     <input type="Text" id="tgl" name="tgl" maxlength="25" readonly="readonly" value="<?php if($tgl!=null)echo $tgl; ?>" size="25"/>
     <img src="<?= base_url() ?>datepicker/images2/cal.gif"onclick="javascript:NewCssCal ('tgl','ddMMyyyy','dropdown',true,'24')" style="cursor:pointer"/>
    <span class="help-block"><?php echo form_error('tgl_hpl', '<p class="field_error">','</p>')?></span>  
    </div>
  </div>
 <div class="form-group">
  <label for="kode"></label><span class="colon"></span>
  <div id="cari">
    <input type="submit" class="btn btn-primary pull-right" name="action" value="Cari"  >
    </br>
  </div>
  <div class="clr"></br></br></br></div>
</div>
</form>
  </div>
  </div>
  </div><!-- /.panel-heading -->
    <div class="panel-body">
      <input style="height:30px; width:500px; margin-top:10px;" id="pac-input" placeholder="Cari Lokasi" class="form-control input-md"></input>
      <div id="map" style="height:440px; margin-top:10px;" class="col-lg-12"></div>
      
        <center><button id="center" type="button" class="btn btn-danger btn-circle btn-lg" style="margin:10px;"><i class="fa fa-crosshairs"></i></button></center>
        <p><br/>Keterangan : </p> 
        <img src="<?= base_url() ?>images/ket.png" width=160>
    </div>           
  </div> 

</div>

<script>
function nav_active(){
  document.getElementById("beranda").className = "collapsed active";
  }
 
// very simple to use!
$(document).ready(function() {
  nav_active();
});
</script>

    <script> 
   (function ($) {
      jQuery.expr[':'].Contains = function(a,i,m){
          return (a.textContent || a.innerText || "").toUpperCase().indexOf(m[3].toUpperCase())>=0;
      };
      function listFilter(header, list) {
        var form = $("<form>").attr({"class":"filterform","action":"#"}),
            input = $("<input>").attr({"class":"filterinput","type":"text"});
        $(form).append(input).appendTo(header);
        $(input)
          .change( function () {
            var filter = $(this).val();
            if(filter) {
              $(list).find("a:not(:Contains(" + filter + "))").parent().slideUp();
              $(list).find("a:Contains(" + filter + ")").parent().slideDown();
            } else {
              $(list).find("li").slideDown();
            }
            return false;
          })
        .keyup( function () {
            $(this).change();
        });
      }
      $(function () {
        listFilter($("#header"), $("#list"));
      });
    }(jQuery));
   

 function KlikNomer(nama,id){
    
 
    document.getElementById("penerima").value=nama;
    document.getElementById("idnya").value=id;

}

</script>