      <h2>Data Laporan Bencana</h2>
      <div class="form-group">
        <?php
          $attributes = array('id' => 'cbencana', 'role'=>'form');
          echo form_open('dlb/searching/',$attributes);
        ?>
        <div class="row">
          <label class="control-label col-sm-2" for="keyword2">Kata kunci:</label>
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
            'placeholder'=>'Masukkan user atau tanggal laporan (dd-MM-yyyy)',
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
            'name'    => 'caridatalap',
            'class'   => 'button btn btn-info btn-block',
            'value'   => 'Cari Data',
          );
          echo form_input($data); ?>
        </div>
        <div class="btn-group col-sm-2">
      <a href="#" class="btn btn-success dropdown-toggle btn-block" data-toggle="dropdown" aria-expanded="true">
        Tambah Laporan
        <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" style="margin-left:16px;">
        <li><?php
        /*
          $data = array(
            'type'    => 'submit',
            'name'    => 'tambahdata1',
            'class'   => 'button btn btn-default btn-block',
            'value'   => 'Tambah Laporan Awal',
          );
          echo form_input($data); 
          */
          echo anchor('dlb/add1','Tambah Laporan Awal',array('class' => 'btn btn-success btn-block'));
          ?></li>
        <li><?php
        /*
          $data = array(
            'type'    => 'submit',
            'name'    => 'tambahdata2',
            'class'   => 'button btn btn-default btn-block',
            'value'   => 'Tambah Laporan Perkembangan',
          );
          echo form_input($data);
          */
          echo anchor('dlb/add2','Tambah Laporan Perkembangan',array('class' => 'btn btn-success btn-block')); 
          ?></li>
       </ul>
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
        if($this->session->flashdata('messagehapusbencana'))
        {
          //kalau flash data dengan key message ada isinya, baru ditampilkan di messagebox
          echo "<script>
            alert('". $this->session->flashdata('messagehapusbencana') ."');
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
          'title' => 'Ubah laporan bencana',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        $image_delete = array(
          'src' => 'images/deleteicon.png',
          'alt' => 'Hapus',
          'title' => 'Hapus laporan bencana',
          'border'=>'0',
          'rel' => 'lightbox',
        );
        ?>
        <?php if(count($detail) > 0) { ?>
          <?php
          echo '<table class="table table-bordered table-striped table-hover">
        <tr>
          <th scope="col">Nama Petugas</th>
          <th scope="col">Tanggal/Jam</th>
          <th scope="col">Tim Reaksi Cepat</th>
          <th scope="col">Korban</th>
          <th scope="col">Kerusakan</th>
          <th scope="col">Kunjungan Bupati</th>
          <th scope="col">Upaya Penanganan</th>
          <th scope="col">Kebutuhan</th>
          <th scope="col" style="width:70px">Aksi</th>
        </tr>';
          //$date = new DateTime('2000-01-01');
          //echo $date->format('Y-m-d H:i:s');
          foreach($detail as $rows) {
          echo "<tr>";
          $date1 = new DateTime($rows['tanggal_laporan']);
          $date2 = new DateTime($rows['bupati_tgl']);
          $penanganan='';
          if($rows['posko']!=0) $penanganan.='posko, ';
          if($rows['koordinasi']!=0) $penanganan.='koordinasi, ';
          if($rows['evakuasi']!=0) $penanganan.='evakuasi, ';
          if($rows['kesehatan']!=0) $penanganan.='kesehatan, ';
          if($rows['dapur']!=0) $penanganan.='dapur, ';
          if($rows['distribusi']!=0) $penanganan.='distribusi, ';
          if($rows['pengerahan']!=0) $penanganan.='pengerahan, ';
          if($penanganan=='')$penanganan='-';
          echo "
          <td>". $rows['nama_lengkap'] ."</td>
          <td>". $date1->format('d-m-Y') ."/ ". $rows['jam_laporan'] ."</td>
          <td>". $rows['tim_bpbd'] ." tim bpbd, ".
            $rows['tim_dinsos'] ." tim dinsos, ".
            $rows['tim_dinkes'] ." tim dinkes, ".
            $rows['tim_pu'] ." tim pu, ".
            $rows['sub_tim'] ." sub tim. ".
            "</td>
          <td>". $rows['meninggal'] ." orang meninggal, ".
            $rows['luka_berat'] ." orang luka berat, ".
            $rows['luka_ringan'] ." orang luka ringan, ".
            $rows['hilang'] ." orang hilang, ".
            $rows['mengungsi_jiwa'] ." orang mengungsi, ".
            $rows['mengungsi_kk'] ." keluarga mengungsi.".
            "</td>
          <td>". $rows['rumah'] ." rumah, ".
            $rows['kantor'] ." kantor, ".
            $rows['fasilitas_kesehatan'] ." fasilitas kesehatan, ".
            $rows['fasilitas_pendidikan'] ." fasilitas pendidikan, ".
            $rows['fasilitas_umum'] ." fasilitas umum, ".
            $rows['sarana_ibadah'] ." sarana ibadah, ".
            $rows['jembatan'] ." jembatan, ".
            $rows['jalan'] ." jalan, ".
            $rows['tanggul'] ." tanggul, ".
            $rows['sawah'] ." sawah, ".
            $rows['lahan_pertanian'] ." lahan pertanian, ".
            $rows['lain_lain'] ." lain-lain.".
            "</td>
          <td>". $date2->format('d-m-Y') ."/ ". $rows['bupati_jam'] ."</td>
          <td>". $penanganan ."</td>
          <td>"."Sumber daya: ". $rows['sumber_daya'] .
            ". Kendala: ". $rows['kendala'] .
            ". Kebutuhan mendesak: ". $rows['kebutuhan_mendesak'] .
            ". Rencana tindak lanjut: ". $rows['rencana_tindaklanjut'] .".".
            "</td>
          <td class='info'>"
            . anchor('dlb/modify/'. $rows['id_laporan'], img($image_edit)) ." | "
            . anchor('dlb/remove/'. $rows['id_laporan'], img($image_delete),
              array('onClick' => "return confirm('Apakah Anda yakin untuk menghapus data laporan bencana ". $rows['id_laporan'] ."?')")) ."</td>
          "; 
          echo "</tr>";
          } 
          ?></table>
          <?php } 
          else {
              echo '<h5>Tidak ada data</h5>';
          }?>
          
        
        <?php echo $this->pagination->create_links(); ?>