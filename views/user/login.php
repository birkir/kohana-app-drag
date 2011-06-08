<form action="" method="post">
	<fieldset>
		<legend><?php echo __('Login'); ?></legend>
		<dl>
			<dt><label for="f_username"><?php echo __('Username'); ?></label></dt>
			<dd><input type="text" name="username" id="f_username" /></dd>

			<dt><label for="f_password"><?php echo __('Password'); ?></label></dt>
			<dd><input type="password" name="password" id="f_password" /></dd>
		</dl>
		<input type="submit" value="<?php echo __('Login'); ?>" />
		<a class="button" href="/user/lostpassword"><?php echo __('Lost password'); ?></a>
	</fieldset>
</form>
<?php echo isset($errors) ? Debug::vars($errors) : NULL; ?>