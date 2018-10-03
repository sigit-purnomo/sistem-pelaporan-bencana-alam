      <h2>Data Posko</h2>
      <div class="form-group">
        <?php
          $attributes = array('id' => 'cposko', 'role'=>'form');
          echo form_open('dp/searching/',$attributes);
        ?>
        <div class="row">
          <label class="control-label col-sm-2" for="keyword">Kata kunci:</label>
        <div class="col-sm-5">
          <?php
          if (!isset($id_bencana)) $id_bencana = "";
          $data = array(
              'name'    => 'idbencana',
              'id'    => 'idbencana',
              'class' => 'form-control',
              'value'   => set_value('idbencana',$id_bencana),
              'type'    => 'hidden',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
          <?php
            $data = array(
            'name'      => 'keyword2',
            'id'        => 'keyword2',
            'value'     => set_value('keyword2',$keyword2),
            'class'     => "form-control",
            'placeholder'=>'Masukkan kata kunci',
            'maxlength' => '50',
            'size'      => '50',
            'autofocus'   => 'autofocus',
            );
          echo form_input($data); ?>
        </div>
        <div class="col-sm-2">
          <?php
          $data = array(
            'type'    => 'submit',
            'name'    => 'caridatapos',
            'class'   => 'button btn btn-info btn-block',
            'value'   => 'Cari Data',
          );
          echo form_input($data); ?>
        </div>
        <div class="col-sm-2">
          <?php
          /*
          $data = array(
            'type'    => 'submit',
            'name'    => 'tambahdata',
            'class'   => 'button btn btn-success btn-block',
            'value'   => 'Tambah Data',
          );
          echo form_input($data); */
          echo anchor('dp/add','Tambah Data',array('class' => 'btn btn-success btn-block'));
          ?>
        </div>
      </div>
        <?php
        echo form_error('keyword2');
        if($this->session->flashdata('message'))
        {
          //kalau flash data dengan key message ada isinya, baru ditampilkan di messagebox
          /*echo "<script>
            alert('". $this->session->flashdata('message') ."');
            </script>";
            */
            ?>
            <div class="alert alert-dismissible alert-info fade in" id="myAlert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button>
          <h5>
          <?php echo $this->session->flashdata('message');?></h5>
        </div>
        <script>
            function showAlert() {
                $("#myAlert").addClass("hideme");
            }

            window.setTimeout(function () {
                showAlert();
            }, 3000);
        </script>
    </div>
            <?php
        }
        if($this->session->flashdata('messagehapusposko'))
        {
          //kalau flash data dengan key message ada isinya, baru ditampilkan di messagebox
          echo "<script>
            alert('". $this->session->flashdata('messagehapusposko') ."');
            </script>";
        }
        ?>
      </div>

      
        <?php
        $image_edit = array(
          'src' => 'images/editicon.png',
          'alt' => 'Ubah',
          'title' => 'Ubah data posko',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        $image_delete = array(
          'src' => 'images/deleteicon.png',
          'alt' => 'Hapus',
          'title' => 'Hapus data posko',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        ?>
        <?php if(count($detail) > 0) { ?>
          <?php
          echo '<table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Nama Posko</th>
          <th scope="col">Latitude</th>
          <th scope="col">Longitude</th>
          <th scope="col">Lokasi</th>
          <th scope="col" style="width:70px">Aksi</th>
        </tr>';
          //$date = new DateTime('2000-01-01');
          //echo $date->format('Y-m-d H:i:s');
          foreach($detail as $rows) {
          echo "<tr>";
          echo "
          <td>". $rows['nama_posko'] ."</td>
          <td>". $rows['latitude'] ."</td>
          <td>". $rows['longitude'] ."</td>
          <td>". $rows['lokasi_posko_dusun']. ", " .
              $rows['lokasi_posko_kecamatan']. ", " .
              $rows['lokasi_posko_kota']. ", " .
              $rows['lokasi_posko_provinsi']. "." .
              "</td>
          <td class='info'>"
            . anchor('dp/modify/'. $rows['id_posko'], img($image_edit)) ." | "
            . anchor('dp/remove/'. $rows['id_posko'], img($image_delete),
              array('onClick' => "return confirm('Apakah Anda yakin untuk menghapus data posko ". $rows['nama_posko'] ."?')")) ."</td>
          "; 
          echo "</tr>";
          } 
          ?> </table>
          <?php } else {
              echo '<h5>Tidak ada data</h5>';
          }?>
          
       
        <?php echo $this->pagination->create_links(); ?>