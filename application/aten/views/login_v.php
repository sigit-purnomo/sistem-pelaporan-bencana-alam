        <?php
          $attributes = array('id' => 'loginform','class'=>'form-horizontal', 'role'=>'form');
          echo form_open('account/login/',$attributes);
        ?>
        <div class="col-sm-7 well  well-lg">
            <?php echo $this->session->flashdata('message');?>
            <h2>Verifikasi Pengguna</h2>
            <div class="form-group">
              <label class="control-label col-sm-3" for="username">Nama pengguna:</label>
              <div class="col-sm-8 <?php echo form_error('username') == '' ? '' : 'has-error';?>">
              <?php
                $data = array(
                'name'    => 'username',
                'id'    => 'username',
                'value'   => set_value('username'),
                'class' => 'form-control',
                'placeholder'=>'Masukkan nama pengguna',
                'maxlength' => '50',
                'size'    => '35',
                'autofocus'   => 'autofocus',
                );
              echo form_input($data); ?>
              <?php echo form_error('username'); ?>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="password">Kata Sandi:</label>
              <div class="col-sm-8 <?php echo form_error('password') == '' ? '' : 'has-error';?>">
            <?php
              $data = array(
              'name'    => 'password',
              'id'      => 'password',
              'value'   => '',
              'class'   => 'form-control',
              'type'    => 'password',
              'placeholder' =>'Masukkan password',
              'maxlength'   => '50',
              'size'        => '35',
              );
            echo form_input($data); ?>
            <?php echo form_error('password'); ?>
            </div>
            </div>
            <div class="col-sm-offset-3 col-sm-4">
            <?php
            $data = array(
              'type'    => 'submit',
              'name'    => 'masuk',
              'class'   => 'button btn btn-primary btn-block',
              'value'   => 'Masuk',
            );
            echo form_input($data); ?>
          </div>
</div>