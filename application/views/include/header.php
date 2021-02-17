<!DOCTYPE html>
<html lang="en">
<head>
	<title> STOCKS PAPI - dhillonds.com </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Personalized CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/style.css">
	<!-- Latest compiled and minified Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<!-- jQuery Bootstrap library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<!-- Latest compiled Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    
	<!-- Personalized CSS -->
	<script src="<?php //echo base_url(); ?>public/assets/js/admin_functions.js"></script>

	<!-- Font awesome-->
	<script src="https://kit.fontawesome.com/28d1525660.js"></script>

	<!-- Jquery Datapicker-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script type="text/javascript">
		// var js_base_url = "<?php echo base_url();?>";
		// var PRISTINE_SHIFT = "<?php echo PRISTINE_SHIFT; ?>";
		// var BALANCED_SHIFT = "<?php echo BALANCED_SHIFT; ?>";
		// var ZEROED_SHIFT = "<?php echo ZEROED_SHIFT; ?>";
		// var UNDECIDED_ARITHMETIC = "<?php echo UNDECIDED_ARITHMETIC; ?>";
		// var ARITHMETIC_MINUS = "<?php echo ARITHMETIC_MINUS; ?>";
		// var ARITHMETIC_PLUS = "<?php echo ARITHMETIC_PLUS; ?>";
		// var IS_DAILY = "<?php echo IS_DAILY; ?>";
		// var NOT_DAILY = "<?php echo NOT_DAILY; ?>";
		// var DAILY_SHIFT = "<?php echo DAILY_SHIFT; ?>";
		// var FIRST_SHIFT = "<?php echo FIRST_SHIFT; ?>";
		// var SECOND_SHIFT = "<?php echo SECOND_SHIFT; ?>";
	</script>
</head>
<body>
<?php
	if(!empty(is_logged_in())){
?>
<nav class="navbar navbar-default sp-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php //echo base_url(); ?>"><img src="<?php echo base_url(); ?>public/assets/images/stockspapi-logo.jpg" style="max-height: 200%;"></a>
    </div>
    <ul class="nav navbar-nav" style="float: right;">
      <li><a href="#" class="disabled" style="pointer-events: none;"><i class="far fa-user"></i> <?php echo $this->session->userdata['user_creds']['full_name']; ?></a></li>
      <li><a href="#" class="btn btn-danger" id="logout_btn"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
  </div>
</nav>
<?php
	}
?>