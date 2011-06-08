<form action="" method="post">
	<fieldset>
		<legend><?php echo __('Register'); ?></legend>
		<dl>
			<dt><label for="f_username"><?php echo __('Username'); ?></label></dt>
			<dd><input type="text" name="username" id="f_username" /></dd>

			<dt><label for="f_email"><?php echo __('Email'); ?></label></dt>
			<dd><input type="text" name="email" id="f_email" /></dd>

			<dt><label for="f_password"><?php echo __('Password'); ?></label></dt>
			<dd><input type="password" name="password" id="f_password" /></dd>

			<dt><label for="f_confirm_password"><?php echo __('Confirm password'); ?></label></dt>
			<dd><input type="password" name="confirm_password" id="f_confirm_password" /></dd>

			<dt><label for="f_captcha"><?php echo __('Captcha'); ?></label></dt>
			<dd><?php echo $captcha; ?></dd>
		</dl>
		<input type="submit" value="<?php echo __('Register'); ?>" />
	</fieldset>
</form>
<?php echo isset($errors) ? Debug::vars($errors) : NULL; ?>