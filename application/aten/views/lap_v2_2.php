       <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-center">
           <h4>LAPORAN TRC BPBD</h4>
           <?php 
            $hari = array("MINGGU", "SENIN", "SELASA", "RABU", "KAMIS", "JUMAT", "SABTU");
            $bulan = array(1 => "JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER");
            if(count($detail) > 0) 
            {
              foreach($detail as $rows) {
                $tanggal_laporan=new DateTime($rows['tanggal_laporan']);
                $jam_laporan=$rows['jam_laporan'];
                echo "<h4>HARI ". $hari[(int)$tanggal_laporan->format("w")] ." TANGGAL ". 
                  $tanggal_laporan->format('j ') . $bulan[(int)$tanggal_laporan->format('m')] . 
                  $tanggal_laporan->format(' Y') ." JAM ". $jam_laporan."</h4>";
                //echo $cetak_date;
              }
            }
            echo "<h5>(SORE HARI PERTAMA DAN HARI BERIKUTNYA)</h5>";
            ?>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-offset-2 col-sm-8 text-justify">
          <?php
            $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
            $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            
            if(count($detail) > 0) 
            {
              foreach($detail as $rows) 
              {
                 $nama= $rows['nama_bencana'];
                $jenis = $rows['jenis_bencana'];
                $lokasi = $rows['lokasi'];
                $penyebab = $rows['penyebab'];
                $jam=$rows['jam'];

                $tanggal=new DateTime($rows['tanggal']);
                $bupati_tgl=new DateTime($rows['bupati_tgl']);

                
                $meninggal = $rows['meninggal'];
            
                $luka_berat = $rows['luka_berat'];
                $luka_ringan = $rows['luka_ringan'];
                $hilang = $rows['hilang'];
                $mengungsi_jiwa = $rows['mengungsi_jiwa'];
                $mengungsi_kk = $rows['mengungsi_kk'];
                
                $rumah = $rows['rumah'];
                $kantor = $rows['kantor'];
                $fasilitas_kesehatan = $rows['fasilitas_kesehatan'];
                $fasilitas_pendidikan = $rows['fasilitas_pendidikan'];
                $fasilitas_umum = $rows['fasilitas_umum'];
                
                $sarana_ibadah = $rows['sarana_ibadah'];
                $jembatan = $rows['jembatan'];
                $jalan = $rows['jalan'];
                $tanggul = $rows['tanggul'];
                $sawah = $rows['sawah'];
                
                $lahan_pertanian = $rows['lahan_pertanian'];
                $lain_lain = $rows['lain_lain'];
                $bupati_jam = $rows['bupati_jam'];
                $posko = $rows['posko'];
                
                $koordinasi = $rows['koordinasi'];
                $evakuasi = $rows['evakuasi'];
                $kesehatan = $rows['kesehatan'];
                $dapur = $rows['dapur'];
                $distribusi = $rows['distribusi'];
                
                $pengerahan = $rows['pengerahan'];
                $sumber_daya = $rows['sumber_daya'];
                $kendala = $rows['kendala'];
                $kebutuhan_mendesak = $rows['kebutuhan_mendesak'];
                $rencana_tindaklanjut = $rows['rencana_tindaklanjut'];

                $korban=(int)$meninggal+(int)$luka_berat+(int)$luka_ringan+(int)$hilang;
                if($posko==1)
                  $posko='Telah mendirikan POSKO SATLAK PB/BPBD';
                else 
                  $posko='Belum mendirikan POSKO SATLAK PB/BPBD';
                if($koordinasi==1)
                  $koordinasi='Telah melakukan rapat koordinasi dengan dinas/instansi/lembaga terkait';
                else 
                  $koordinasi='Belum melakukan rapat koordinasi dengan dinas/instansi/lembaga terkait';
                if($evakuasi==1)
                  $evakuasi='Telah melaksanakan penyelamatan/evakuasi bencana';
                else 
                  $evakuasi='Belum melaksanakan penyelamatan/evakuasi bencana';
                if($kesehatan==1)
                  $kesehatan='Telah melaksanakan pelayanan kesehatan';
                else 
                  $kesehatan='Belum melaksanakan pelayanan kesehatan';
                if($dapur==1)
                  $dapur='Telah melaksanakan pendirian dapur umum';
                else 
                  $dapur='Belum melaksanakan pendirian dapur umum';
                if($distribusi==1)
                  $distribusi='Telah melaksanakan pendistribusian bantuan makanan';
                else 
                  $distribusi='Belum melaksanakan pendistribusian bantuan makanan';
                if($pengerahan==1)
                  $pengerahan='Pengerahan tenaga aparat Pemda, TNI, Polri, SAR, Tagana, PMI, Relwan Masyarakat, dll';
                else 
                  $pengerahan='Belum ada pengerahan tenaga aparat Pemda, TNI, Polri, SAR, Tagana, PMI, Relwan Masyarakat, dll';
                $sub_tim=$rows['sub_tim'];

                $rencana_aksi = $rows['rencana_aksi'];
                $kesimpulan = $rows['kesimpulan'];
                $penutup = $rows['penutup'];

                $kerusakan1=(int)$fasilitas_kesehatan+(int)$fasilitas_pendidikan+(int)$fasilitas_umum+(int)$sarana_ibadah+(int)$jembatan+(int)$jalan+(int)$tanggul;
                $kerusakan2=(int)$sawah+(int)$lahan_pertanian;
                $id_laporan=$rows['id_laporan'];

                echo "
                  <h4>1. Tim Reaksi Cepat BPBD</h4>
                  <div class='indent2'>
                  <p>a. Tim reaksi cepat BPBD terdiri dari ". $sub_tim ." sub Tim melaksanakan peninjauan lapangan terhadap lokasi 
                    peninjauan di ". $lokasi .".</p>
                  <p>b. Membantu SATLAK PB/BPBD untuk:</p>
                    <div class='indent2'>
                      <p>1. Mengaktifkan Posko SATLAK PB/BPBD</p>
                      <p>2. Memperlancar koordinasi dengan sektor terkait melalui rapat koordinasi dalam mendukung penanganan tanggap darurat</p>
                      <p>3. Kegiatan press release kepada mass media cetak/elektronik</p>
                    </div>
                  </div>

                  <h4>2. Bencana</h4>
                  <div class='indent2'>
                  <p>a. Kejadian</p>
                    <div class='indent2'>
                    <p>1. Jenis kejadian: ".br(1)."<div class='indent5'>". $jenis .".</div></p>
                    <p>2. Waktu kejadian:" .br(1)."<div class='indent5'>".
                          "hari ". $hari[(int)$tanggal->format('w')] .", tanggal ". $tanggal->format('j ') .
                           $bulan[(int)$tanggal->format('m')] .$tanggal->format(' Y') ." Jam ". $jam .".</div></p>
                    <p>3. Lokasi kejadian: ".br(1)."<div class='indent5'>". $lokasi .".</div></p>
                    <p>4. Penyebab kejadian: ".br(1)."<div class='indent5'>". $penyebab .".</div></p>
                    </div>
                  <p>b. Kondisi Mutakhir</p>
                    <div class='indent2'>
                    <p>1. Korban: ". $korban ." orang, dengan rincian".br(1)."<div class='indent5'>".
                        $meninggal." orang meninggal, ".
                        br(1).$luka_berat." orang luka berat, ".
                        br(1).$luka_ringan." orang luka ringan, ".
                        br(1).$hilang." orang hilang/hanyut.</div></p>
                    <p>2. Mengungsi: ".br(1)."<div class='indent5'>". 
                        $mengungsi_jiwa ." jiwa.". 
                        br(1).$mengungsi_kk ." KK.</div></p>
                    <p>3. Kerusakan: ".br(1)."<div class='indent5'>". 
                        $rumah ." rumah, ".
                        br(1).$kantor ." kantor, ".
                        br(1).$fasilitas_kesehatan ." fasilitas kesehatan, ".
                        br(1).$fasilitas_pendidikan ." fasilitas pendidikan, ".
                        br(1).$fasilitas_umum ." fasilitas umum, ".
                        br(1).$sarana_ibadah ." sarana ibadah, ".
                        br(1).$jembatan ." jembatan, ".
                        br(1).$jalan ." jalan, ".
                        br(1).$tanggul ." tanggul, ".
                        br(1).$sawah ." sawah, ".
                        br(1).$lahan_pertanian ." lahan pertanian, ".
                        br(1).$lain_lain ." lain-lain.</div></p>
                    <p>4. Dampak bencana:</p>
                    </div>
                  <p>c. Upaya penanganan yang telah dilakukan oleh SATLAK PB/BPBD Kabupaten Kota</p>
                    <div class='indent2'>
                    <p>1. Bupati/Walikota pada tanggal ". $bupati_tgl->format('j ') . $bulan[(int)$bupati_tgl->format('m')] .$bupati_tgl->format(' Y') ." jam ". $bupati_jam ." telah meninjau lokasi bencana.</p>
                    <p>2. ". $posko ."</p>
                    <p>3. ". $koordinasi ."</p>
                    <p>4. ". $evakuasi ."</p>
                    <p>5. ". $kesehatan ."</p>
                    <p>6. ". $dapur ."</p>
                    <p>7. ". $distribusi ."</p>
                    <p>8. ". $pengerahan ."</p>
                    <p>9. Dan lain-lain</p>
                    </div>
                  <p>d. Sumber daya yang tersedia di lokasi bencana:</p><p class = 'indent2'>". $sumber_daya ."</p>
                  <p>e. Tabel rincian bantuan (dibutuhkan, diterima, disalurkan, persediaan, kekurangan)</p>
                  <p>f. Kendala/hambatan: </p><p class = 'indent2'>". $kendala ."</p>
                  <p>g. Kebutuhan mendesak sesuai urutan prioritas: </p><p class = 'indent2'>". $kebutuhan_mendesak ."</p>
                  <p>h. Rencana tindak lanjut SATLAK PB/BPBD Kabupaten Kota: </p><p class = 'indent2'>". $rencana_tindaklanjut. "</p>
                  </div>

                <h4>3. Analisa singkat sementara</h4>
                <div class='indent2'>
                  <p>a. Korban: ".br(1)."<div class='indent5'>". $korban ." orang.</div></p>";
                  if ($pengungsi==NULL)
                    $pengungsi=0;
                echo "
                  <p>b. Pengungsi: ".br(1)."<div class='indent5'>". $pengungsi ." orang.</div></p>
                  <p>c. Pemenuhan kebutuhan minimun: ".br(1)."<div class='indent5'>". $kebutuhan_mendesak .".</div></p>
                  <p>d. Kerusakan</p>
                    <div class='indent2'>
                    <p>Rumah: ".br(1)."<div class='indent5'>". $rumah ." buah.</div></p>
                    <p>Sarana dan prasarana umum: ".br(1)."<div class='indent5'>". $kerusakan1 ." buah.</div> </p>
                    <p>Lahan/sawah/kebun/tanaman/ternak: ".br(1)."<div class='indent5'>". $kerusakan2 ." buah.</div></p>
                    </div>
                </div>";

                $attributes = array('id' => 'editform','class'=>'form-horizontal', 'role'=>'form');
                echo form_open('report/pdf2/'.$id_laporan,$attributes);
                echo "<div class='col-sm-12'>";
                echo "<h4>4. Rencana Aksi TIM</h4>";
                echo "</div>";
                  echo "<div class='col-sm-8 ";
                  echo form_error('rencana_aksi') == '' ? '' : 'has-error';
                  echo "'>";
                    $data = array(
                    'name'    => 'rencana_aksi',
                    'id'    => 'rencana_aksi',
                    'value'   => set_value('rencana_aksi',$rencana_aksi),
                    'class' => 'form-control',
                    'placeholder'=>'Masukkan rencana aksi TIM',
                    'rows' => '7',
                    'cols'    => '35',
                    'autofocus'   => 'autofocus',
                    );
                    if(!$this->session->userdata('logged_in'))
                    {
                      $hidden = array("disabled"=>"");
                      $data = array_merge($data, $hidden);
                    }
                  echo form_textarea($data);
                  echo form_error('rencana_aksi'); 
                  echo "</div>";

                echo "<div class='col-sm-12'>";
                echo "<h4>5. Kesimpulan dan Rekomendasi</h4>";
                echo "</div>";
                  echo "<div class='col-sm-8 ";
                  echo form_error('kesimpulan') == '' ? '' : 'has-error';
                  echo "'>";
                    $data = array(
                    'name'    => 'kesimpulan',
                    'id'    => 'kesimpulan',
                    'value'   => set_value('kesimpulan',$kesimpulan),
                    'class' => 'form-control',
                    'placeholder'=>'Masukkan kesimpulan dan rekomendasi',
                    'rows' => '7',
                    'cols'    => '35',
                    );
                    if(!$this->session->userdata('logged_in'))
                    {
                      $hidden = array("disabled"=>"");
                      $data = array_merge($data, $hidden);
                    }
                  echo form_textarea($data);
                  echo form_error('kesimpulan'); 
                  echo "</div>";

                echo "<div class='col-sm-12'>";
                echo "<h4>6. Penutup</h4>";
                echo "</div>";
                  echo "<div class='col-sm-8 ";
                  echo form_error('penutup') == '' ? '' : 'has-error';
                  echo "'>";
                    $data = array(
                    'name'    => 'penutup',
                    'id'    => 'penutup',
                    'value'   => set_value('penutup',$penutup),
                    'class' => 'form-control',
                    'placeholder'=>'Masukkan penutup',
                    'rows' => '7',
                    'cols'    => '35',
                    );
                    if(!$this->session->userdata('logged_in'))
                    {
                      $hidden = array("disabled"=>"");
                      $data = array_merge($data, $hidden);
                    }
                  echo form_textarea($data);
                  echo form_error('penutup'); 
                  echo "</div>";

                
              }
            } 
          ?>
        </div>
      </div>

      <br /><br /><br />
          
      <?php
        echo 
          "<div class='col-sm-offset-2 col-sm-3'>";
          
          $data = array(
            'type'    => 'submit',
            'name'    => 'pdf2',
            'class'   => 'button btn btn-primary btn-block',
            'value'   => 'Tampil dalam PDF',
          );
          if($this->session->userdata('logged_in'))
          {
            echo form_input($data);
          }
          echo "</div>";
      ?>
