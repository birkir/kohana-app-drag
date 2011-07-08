<form action="" method="post">
	<fieldset>
<?php echo View::factory('misc/fieldset/errors')->set('errors', isset($errors) ? $errors : array()); ?>
		<dl>
			<dt><?php echo Form::label('f_competition', UTF8::ucfirst(__('Competition'))); ?></dt>
			<dd><?php echo Form::select('competition_id', $competitions, p('competition_id', isset($item->competition_id) ? $item->competition_id : $id), array('id' => 'f_competition')); ?></dd>

			<dt><?php echo Form::label('f_track', UTF8::ucfirst(__('Track'))); ?></dt>
			<dd><?php echo Form::select('track_id', $tracks, p('track_id', isset($item->track_id) ? $item->track_id : NULL), array('id' => 'f_track')); ?></dd>

			<dt><?php echo Form::label('f_name', UTF8::ucfirst(__('Name'))); ?></dt>
			<dd><?php echo Form::input('name', p('name', isset($item->name) ? $item->name : NULL), array('id' => 'f_name')); ?></dd>

			<dt><?php echo Form::label('f_datetime', UTF8::ucfirst(__('Date'))); ?></dt>
			<dd><?php echo Form::input('datetime', p('datetime', isset($item->datetime) ? $item->datetime : NULL), array('id' => 'f_datetime', 'class' => 'datepicker')); ?></dd>
		</dl>
		<?php echo Form::submit(NULL, __('Save')); ?>
	</fieldset>
</form>