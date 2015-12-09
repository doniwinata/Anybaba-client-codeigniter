<div class="row col-xs-6 col-lg-offset-3">

	<h1 class="demo-logo" style="text-align:'center'">
		<div class="text-center"><span class="fui-check-circle"></span> JOIN ANYBABA</div>
	</h1>
	<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo validation_errors(); ?>
	</div>
	<?php } ?>
	
	<?php echo form_open('users/signupMember'); ?>
	<div class="login-form">

		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					<input name="user[first_name]" type="text" class="form-control login-field" value="<?php echo set_value('user[first_name]'); ?>" placeholder="First Name" id="first-name" required>

				</div>
				<div class="col-lg-6">
					<input type="text" name="user[last_name]" class="form-control login-field" value="<?php echo set_value('user[last_name]'); ?>" placeholder="Last Name" id="last-name" required>

				</div>
			</div>
		</div>
		
		<div class="form-group">
			<input name="user[email]" type="email" class="form-control login-field" value="<?php echo set_value('user[email]'); ?>" placeholder="Email Address" id="login-name"  required>
			<label class="login-field-icon fui-user" for="login-name"></label>
		</div>

		<div class="form-group">
			<input name="user[password]" type="password" class="form-control login-field" value="<?php echo set_value('user[password]'); ?>" placeholder="Password" id="login-pass" pattern=".{8,}"   required title="8 chars minimum">
			<label class="login-field-icon fui-lock" for="login-pass"></label>
		</div>

		<div class="form-group">
			<input name="user[confirm]" type="password" class="form-control login-field" value="<?php echo set_value('user[confirm]'); ?>" placeholder="Confirm Password" id="confirm-pass" pattern=".{8,}"   required title="8 chars minimum">
			<label class="login-field-icon fui-lock" for="confirm-pass"></label>
		</div>
		<button type="submit" class="btn btn-primary btn-lg btn-block" value="Submit">Sign In</button>
<hr>

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
