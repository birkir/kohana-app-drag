<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Class'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Rules'); ?></th>
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