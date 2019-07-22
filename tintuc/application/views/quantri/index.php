<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('quantri/head'); ?>
</head>
<body class="skin-blue sidebar-mini wysihtml5-supported" style="height: auto; min-height: 100%;">
	<div class="wrapper" style="height: auto; min-height: 100%;">
		<header class="main-header"> 
			<?php $this->load->view('quantri/header'); ?>
		</header>
		<!-- menu trái -->
		<?php $this->load->view('quantri/left'); ?>
		<!--- main ---->
		<div class="content-wrapper" style="min-height: 926px;">
		    <!-- Content Header (Page header) -->
		    <section class="content-header">
				<?php $this->load->view($temp); ?>
			</section>
		</div>
		<!-- footer -->
		<?php $this->load->view('quantri/footer'); ?>
		<?php $this->load->view('quantri/control'); ?>
		<div class="control-sidebar-bg"></div>
	</div>
	<script src="<?php echo public_url('') ?>bower_components/jquery/dist/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo public_url('') ?>bower_components/jquery-ui/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo public_url('') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- Morris.js charts -->
	<script src="<?php echo public_url('') ?>bower_components/raphael/raphael.min.js"></script>
	<script src="<?php echo public_url('') ?>bower_components/morris.js/morris.min.js"></script>
	<!-- Sparkline -->
	<script src="<?php echo public_url('') ?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?php echo public_url('') ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo public_url('') ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo public_url('') ?>bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="<?php echo public_url('') ?>bower_components/moment/min/moment.min.js"></script>
	<script src="<?php echo public_url('') ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- datepicker -->
	<script src="<?php echo public_url('') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<!-- Bootstrap WYSIHTML5 -->
	<script src="<?php echo public_url('') ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?php echo public_url('') ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo public_url('') ?>bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo public_url('') ?>dist/js/adminlte.min.js"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?php echo public_url('') ?>dist/js/pages/dashboard.js"></script>
	
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo public_url('') ?>dist/js/demo.js"></script>
</body>
</html>