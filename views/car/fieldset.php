<div class="block">
	<h2><?php echo __((Request::current()->action() == 'add') ? 'Add car' : 'Edit car'); ?></h2>
	<div class="content">
		<form action="" method="post">
			<fieldset>
		<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
		<?php echo View::factory('misc/fieldset/messages')->set('messages', isset($messages) ? $messages : array()); ?>
				<dl>
					<dt><label for="f_year"><?php echo __('Year'); ?></label></dt>
					<dd><input type="text" name="year" id="f_year" value="<?php echo (isset($car) ? $car->year : p('year')); ?>" /></dd>
		
					<dt><label for="f_make"><?php echo __('Make'); ?></label></dt>
					<dd><input type="text" name="make" id="f_make" value="<?php echo (isset($car) ? $car->make : p('make')); ?>" /></dd>
		
					<dt><label for="f_model"><?php echo __('Model'); ?></label></dt>
					<dd><input type="text" name="model" id="f_model" value="<?php echo (isset($car) ? $car->model : p('model')); ?>" /></dd>
		
					<dt><label for="f_licence_plate"><?php echo __('Licence plate'); ?></label></dt>
					<dd><input type="text" name="licence_plate" id="f_licence_plate" value="<?php echo (isset($car) ? $car->licence_plate : p('licence_plate')); ?>" /></dd>
				</dl>
				<input type="submit" value="<?php echo __('Save'); ?>" />
			</fieldset>
		</form>
	</div>
</div>