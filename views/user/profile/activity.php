<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('Date'); ?></th>
			<th><?php echo __('Message'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>
<?php $ref = ! empty ($item->ref_type) ? ORM::factory($item->ref_type, $item->ref_id) : NULL; ?>
		<tr>
			<td><?php echo $item->date; ?></td>
			<td><?php echo __($item->message, array(
									':user' => '<a href="'.$item->user_id.'">'.$item->user->username.'</a>',
									':ref' => '<a href="'.$item->ref_id.'">'.$ref.'</a>')); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>