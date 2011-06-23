<table class="ui-table">
	<thead>
		<tr>
			<td><?php echo __('#'); ?></td>
			<td><?php echo __('Class'); ?></td>
			<td><?php echo __('Description'); ?></td>
			<td><?php echo __('Rules'); ?></td>
		</tr>
	</thead>
	<tbody>
<?php foreach ($classes as $class): ?>
		<tr>
			<td><?php echo $class->id; ?></td>
			<td><?php echo $class->name; ?></td>
			<td><?php echo $class->description; ?></td>
			<td><?php echo empty($class->rules) ? __('No rules') : __('Click to read'); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>