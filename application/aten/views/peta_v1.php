<div class="col-sm-12 text-left">
          <!-- hasil pencarian -->
            <?php if(count($detail) > 0) { ?>
              <?php
              $hal2=$this->uri->segment(4);//null,hal
              $hal1=$this->uri->segment(3);//null,hal,id
              $hal0=$this->uri->segment(2);//null,index,show,searching,find
              if (is_numeric($hal2)) //map/show/id/2
              {
                $hal=$hal2;
              }
              else if($hal2==null && is_numeric($hal1) && ($hal0=='index' || $hal0=='find')) //map/index/2  ||  map/find/2
              {
                $hal=$hal1;
              }
              else
              {
                $hal=null;
              }
               echo "<table class='table table-bordered table-striped table-hover'>
              <tr>
                <th scope='col'>Nama Bencana</th>
                <th scope='col'>Jenis Bencana</th>
                <th scope='col'>Lokasi</th>
                <th scope='col'>Penyebab</th>
                <th scope='col'>Tanggal/Jam</th>
                <th scope='col'>Latitude</th>
                <th scope='col'>Longitude</th>
                <th scope='col' style='width:70px'>Aksi</th>
              </tr>";
              
              $image_map = array(
                'src' => 'images/mapicon.png',
                'alt' => 'Tampil',
                'title' => 'Tampilkan pada Peta',
                'border'=>'0',
                'rel' => 'lightbox',
              );
              foreach($detail as $rows) {
              echo "<tr>";
              $date = new DateTime($rows['tanggal']);

              //echo "<td>". anchor('map/show/'. $rows['id_bencana'].'/'.$hal, $rows['nama_bencana'].' ('.$date->format('d-m-Y') ."/ ". $rows['jam'].')','class="showmap"') ."</td>"; 
              echo "
                <td>". $rows['nama_bencana'] ."</td>
                <td>". $rows['jenis_bencana'] ."</td>
                <td>". $rows['lokasi'] ."</td>
                <td>". $rows['penyebab'] ."</td>
                <td>". $date->format('d-m-Y') ."/ ". $rows['jam'] ."</td>
                <td>". $rows['latitude'] ."</td>
                <td>". $rows['longitude'] ."</td>
                <td class='info'>"
                  . anchor('map/show/'. $rows['id_bencana'].'/'.$hal, img($image_map)) ."</td>
                "; 
              echo "</tr>";
              } 
              echo "</table>";
              echo $this->pagination->create_links();?>
              <?php }
              else
              echo "<p>Data bencana tidak ditemukan</p>"; 
            
        ?>
           
        </div>