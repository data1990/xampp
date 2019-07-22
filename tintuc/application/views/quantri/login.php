<html lang="vi"><head>
	<title>Login System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link href="images/icons/favicon.ico" rel="icon" type="image/png">
<!--===============================================================================================-->
	<link href="<?php echo public_url('assets/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
	<link href="<?php echo public_url('assets/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
	<link href="<?php echo public_url('assets/') ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
	<link href="<?php echo public_url('assets/') ?>vendor/animate/animate.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->	
	<link href="<?php echo public_url('assets/') ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
	<link href="<?php echo public_url('assets/') ?>vendor/select2/select2.min.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
	<link href="<?php echo public_url('assets/') ?>css/util.css" rel="stylesheet" type="text/css">
	<link href="<?php echo public_url('assets/') ?>css/main.css" rel="stylesheet" type="text/css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<font color="red"><b><?php echo $this->session->flashdata('thongbao'); ?></b></font>
				<form method="post">
					<span class="login100-form-title p-b-55">
						Login
					</span>
					
					<div class="wrap-input100 validate-input m-b-16" data-validate="Valid email is required: ex@abc.xyz">
						<input name="username" class="input100" type="text" placeholder="Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Password is required">
						<input name="pass" class="input100" type="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="contact100-form-checkbox m-l-4">
						<input name="remember-me" class="input-checkbox100" id="ckb1" type="checkbox">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>
					
					<div class="container-login100-form-btn p-t-25">
						<input name="Ok" value="Save" class="btn btn-primary" type="submit">
						<input value="Login" class="login100-form-btn" type="submit">
					</div>

					

					<div class="text-center w-full p-t-115">
						<span class="txt1">
							Not a member?
						</span>

						<a class="txt1 bo1 hov1" href="#">
							Sign up now							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?php echo public_url('assets/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('assets/') ?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo public_url('assets/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('assets/') ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?php echo public_url('assets/') ?>js/main.js"></script>


</body></html>