      <h2>Data Laporan Posko</h2>
      <div class="form-group">
        <?php
          $attributes = array('id' => 'clapposko', 'role'=>'form');
          echo form_open('dlp/searching/',$attributes);
        ?>
        <div class="row">
          <label class="control-label col-sm-2" for="keyword">Kata kunci:</label>
        <div class="col-sm-5">
          <?php
          if (!isset($id_posko)) $id_posko = "";
          $data = array(
              'name'    => 'id_posko',
              'id'    => 'id_posko',
              'class' => 'form-control',
              'value'   => set_value('id_posko',$id_posko),
              'type'    => 'hidden',
              'maxlength' => '50',
              'size'    => '35',
              );
            echo form_input($data); ?>
          <?php
            $data = array(
            'name'      => 'keyword3',
            'id'        => 'keyword3',
            'value'     => set_value('keyword3',$keyword3),
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
            'name'    => 'caridatalappos',
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
          echo anchor('dlp/add','Tambah Data',array('class' => 'btn btn-success btn-block'));
          ?>
        </div>
      </div>
        <?php
        echo form_error('keyword3');
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
        if($this->session->flashdata('messagehapuslapposko'))
        {
          //kalau flash data dengan key message ada isinya, baru ditampilkan di messagebox
          echo "<script>
            alert('". $this->session->flashdata('messagehapuslapposko') ."');
            </script>";
        }
        ?>
      </div>


      <div class="form-group">
      <div class="row">
        <label class="control-label col-sm-2" for="tgl">Tanggal:</label>
        <div class="col-sm-2">
          <?php
            $data = array(
            'name'      => 'tanggal12',
            'id'        => 'tanggal12',
            'value'     => set_value('tanggal12',$tanggal12),
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
            'name'      => 'tanggal22',
            'id'        => 'tanggal22',
            'value'     => set_value('tanggal22',$tanggal22),
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


      
      
        <?php
        $image_edit = array(
          'src' => 'images/editicon.png',
          'alt' => 'Ubah',
          'title' => 'Ubah laporan posko',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        $image_delete = array(
          'src' => 'images/deleteicon.png',
          'alt' => 'Hapus',
          'title' => 'Hapus laporan posko',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        ?>
        <?php if(count($detail) > 0) { ?>
          <?php
          echo '<table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Nama Petugas</th>
          <th scope="col">Tanggal/Jam Laporan</th>
          <th scope="col">Kapasitas</th>
          <th scope="col">Fasilitas</th>
          <th scope="col">Pengungsi</th>
          <th scope="col" style="width:70px"></th>
        </tr>';
          //$date = new DateTime('2000-01-01');
          //echo $date->format('Y-m-d H:i:s');
          foreach($detail as $rows) {
          echo "<tr>";
          $date1 = new DateTime($rows['tgl_lap_posko']);
          echo "
          <td>". $rows['nama_lengkap'] ."</td>
          <td>". $date1->format('d-m-Y') ."/ ". $rows['jam_lap_posko'] ."</td>
          <td>". $rows['kapasitas'] ."</td>
          <td>". $rows['fasilitas_dapur']. " fasilitas dapur, " .
              $rows['fasilitas_kesehatan']. " fasilitas kesehatan, " .
              $rows['fasilitas_mck']. " fasilitas mck." .
              "</td>
          <td>". $rows['jumlah_kk']. " kk, " .
              $rows['jumlah_pria']. " orang pria, " .
              $rows['jumlah_wanita']. " orang wanita, " .
              $rows['jumlah_balita']. " orang balita." .
              "</td>

          <td class='info'>"
            . anchor('dlp/modify/'. $rows['id_laporan'], img($image_edit)) ." | "
            . anchor('dlp/remove/'. $rows['id_laporan'], img($image_delete),
              array('onClick' => "return confirm('Apakah Anda yakin untuk menghapus data laporan posko?')")) ."</td>
          "; 
          echo "</tr>";
          } 
          ?>
        </table>
          <?php } else {
              echo '<h5>Tidak ada data</h5>';
          }?>
          
        
        <?php echo $this->pagination->create_links(); ?>