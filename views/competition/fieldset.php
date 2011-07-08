<form action="" method="post">
	<fieldset>
<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
		<dl>
			<dt><label for="f_name"><?php echo __('Name'); ?></label></dt>
			<dd><input type="text" name="name" id="f_name" value="<?php echo p('name', isset($item->name) ? $item->name : NULL); ?>" /></dd>

			<dt><label for="f_description"><?php echo __('Description'); ?></label></dt>
			<dd><textarea name="description" id="f_description"><?php echo p('description', isset($item->description) ? $item->description : NULL); ?></textarea></dd>
		</dl>
		<input type="submit" value="<?php echo __('Save'); ?>" />
	</fieldset>
</form>