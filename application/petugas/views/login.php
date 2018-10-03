<!doctype html>

<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="<?php echo base_url();?>../assets/csslogin/reset.css">
	<link rel="stylesheet" href="<?php echo base_url();?>../assets/csslogin/animate.css">
	<link rel="stylesheet" href="<?php echo base_url();?>../assets/csslogin/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		
		<!-- <form> -->
		<form name ="formLogin" onsubmit="return validateForm()" action="<?php echo site_url('login_control/login');?>" method="post">
			<center>
				<a href="http://www.uajy.ac.id"><img src="<?php echo base_url('../assets/img/uajy.png');?>" class="user-image img-responsive" height="100" width="100"/></a>
				<a href="#"><img src="<?php echo base_url('../assets/img/bpbd.png');?>" class="user-image img-responsive" height="100" width="100"/></a>
			</center>

			<label for="name">Username:</label>
			<label for="email" style="color:red;"><?php echo form_error('username', '<span class="error">', '</span>'); ?></label>
			<input type="name" id="username" name="username">
			
			<label for="username">Password:</label>
			
			<!-- <p><a href="#">Forgot your password?</a> -->
			<label for="password" style="color:red;"><?php echo form_error('password', '<span class="error">', '</span>'); ?></label>
			<input type="password"  id="password" name="password">
			
			<div id="lower">
			
				<!-- <input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label> -->
				
				<input type="submit" value="Masuk">
		
			</div>
		
		</form>
	</div>
	
	<!-- End Page Content -->
	
</body>

<script>
	function validateForm() {
	    var username = document.forms["formLogin"]["username"].value;
	    var pass = document.forms["formLogin"]["password"].value;
	    // if ((username==null || username=="") && (pass==null || pass=="")) 
	    // {
	    //     alert("Inputan Username dan Password tidak boleh kosong");
	    //     return false;
	    // }
	    // else if(username==null || username=="")
	    // {
	    // 	alert("Inputan Username tidak boleh kosong");
	    //     return false;
	    // }
	    // else if(pass==null || pass=="")
	    // {
	    // 	alert("Inputan Password tidak boleh kosong");
	    //     return false;
	    // }
	}
</script>

</html>
