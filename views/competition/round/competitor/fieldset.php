<form action="" method="post">
	<fieldset>
<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
		<dl>
			<dt><?php echo Form::label('f_competition_round', UTF8::ucfirst(__('Round'))); ?></dt>
			<dd><?php echo Form::select('competition_round_id', $rounds, p('competition_round_id', isset($item->competition_round_id) ? $item->competition_round_id : $id), array('id' => 'f_competition_round')); ?></dd>

			<dt><?php echo Form::label('f_competition_class', UTF8::ucfirst(__('Competition'))); ?></dt>
			<dd><?php echo Form::select('competition_class_id', $classes, p('competition_class_id', isset($item->competition_class_id) ? $item->competition_class_id : $id), array('id' => 'f_competition_class')); ?></dd>

			<dt><?php echo Form::label('f_driver', UTF8::ucfirst(__('Driver'))); ?></dt>
			<dd><?php echo Form::input('driver', p('driver', isset($item->driver) ? $item->driver : NULL), array('id' => 'f_driver')); ?></dd>

			<dt><?php echo Form::label('f_car', UTF8::ucfirst(__('Car'))); ?></dt>
			<dd><?php echo Form::input('car', p('car', isset($item->car) ? $item->car : NULL), array('id' => 'f_car')); ?></dd>

			<dt><?php echo Form::label('f_identity', UTF8::ucfirst(__('Identity'))); ?></dt>
			<dd><?php echo Form::input('identity', p('identity', isset($item->identity) ? $item->identity : NULL), array('id' => 'f_identity')); ?></dd>

			<dt><?php echo Form::label('f_position', UTF8::ucfirst(__('Position'))); ?></dt>
			<dd><?php echo Form::input('position', p('position', isset($item->position) ? $item->position : NULL), array('id' => 'f_position')); ?></dd>
		</dl>
		<?php echo Form::submit(NULL, __('Save')); ?>
	</fieldset>
</form>