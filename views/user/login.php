<form action="" method="post">
	<fieldset>
<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
		<dl>
			<dt><label for="f_username"><?php echo __('Username'); ?></label></dt>
			<dd><input type="text" name="username" id="f_username" /></dd>

			<dt><label for="f_password"><?php echo __('Password'); ?></label></dt>
			<dd><input type="password" name="password" id="f_password" /></dd>
		</dl>
		<input type="submit" value="<?php echo __('Login'); ?>" />
		<input type="button" onclick="window.location='/user/lostpassword'" value="<?php echo __('Lost password'); ?>" />
	</fieldset>
</form>