<div class="row col-xs-6 col-lg-offset-3">

	<h1 class="demo-logo" style="text-align:'center'">
		
		<div class="text-center"><span class="fui-check-circle"></span> JOIN ANYBABA</div>
	</h1>
	<?php echo form_open('users/registerMember'); ?>
	<div class="login-form">

		<div class="form-group">
			<div class="row">
			<div class="col-lg-6">
			<input name="user[first_name]" type="text" class="form-control login-field" value="" placeholder="First Name" id="first-name">
			
			</div>
			<div class="col-lg-6">
			<input type="text" name="user[last_name]" class="form-control login-field" value="" placeholder="Last Name" id="last-name">
			
			</div>
		</div>
		</div>
		
		<div class="form-group">
			<input name="user[email]" type="text" class="form-control login-field" value="" placeholder="Email Address" id="login-name">
			<label class="login-field-icon fui-user" for="login-name"></label>
		</div>

		<div class="form-group">
			<input name="user[password]" type="password" class="form-control login-field" value="" placeholder="Password" id="login-pass">
			<label class="login-field-icon fui-lock" for="login-pass"></label>
		</div>

		<div class="form-group">
			<input name="user[confirm]" type="password" class="form-control login-field" value="" placeholder="Confirm Password" id="confirm-pass">
			<label class="login-field-icon fui-lock" for="confirm-pass"></label>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block" value="Submit">Sign In</button>

		<a class="login-link"  href="<?php echo site_url('auth/login') ?>">Already have account ?</a>

		<div class="form-group">
			<div class="row">
			<div class="col-lg-6">
			<a class="btn btn-info  btn-lg btn-block  " href="#"><span class="fui-facebook"> </span>Facebook</a>
			
			</div>
			<div class="col-lg-6">
			<a class="btn btn-danger btn-lg btn-block " href="#"><span class="fui-google-plus"> Google +</span></a>
			
			</div>
		</div>
		</div>
	</div>
</php  echo form_close(); ?>
</div>