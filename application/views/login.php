<div class="container">
	<div class="jumbotron text-center">
  		<img src="<?php echo base_url(); ?>public/assets/images/stockspapi-logo.jpg" style="height: 100px;">
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-2 col-md-offset-5 text-center">
			<h3>Login</h3>
		</div>
	</div>
	<hr class="col-md-4 col-md-offset-4">
	<?php echo form_open(); ?>
	<div class="row">
		<label for="username" class="col-md-2 col-md-offset-4"> Username </label><input type="text" name="username" id ="username" class="col-md-2">
	</div>
	<br>
	<div class="row">
		<label for="password" class="col-md-2 col-md-offset-4"> Password </label><input type="password" name="password" id ="password" class="col-md-2">
	</div>
	<br>
	<div class="row">
		<div class="col-md-2 col-md-offset-5 text-center">
			<input type="submit" value="Login" id="login_btn" class="btn btn-primary">
		</div>
	</div>

	<?php echo form_close(); ?>
</div>