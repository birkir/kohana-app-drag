<form action="" method="post">
	<fieldset style="width: 328px;margin: 5em auto;">
		<legend><?php echo __('Lost password'); ?></legend>
<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
		<dl>
			<dt><label for="f_username"><?php echo __('Username'); ?></label></dt>
			<dd><input type="text" name="username" id="f_username" /></dd>

			<dt><label for="f_email"><?php echo __('Email'); ?></label></dt>
			<dd><input type="text" name="email" id="f_email" /></dd>
		</dl>
		<input type="submit" value="<?php echo __('Get password'); ?>" />
	</fieldset>
</form>