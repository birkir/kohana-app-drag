<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Username'); ?></th>
			<th><?php echo __('Created'); ?></th>
			<th><?php echo __('Last login'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($users as $item): ?>
		<tr data-id="<?php echo $item->id; ?>">
			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->username; ?></td>
			<td><?php echo $item->created; ?></td>
			<td><?php echo $item->last_login; ?></td>
			<td>
<?php if ($user->has('roles', ORM::factory('role', array('name' => 'admin')))): ?>
				<a href="/competition/edit/<?php echo $item->id; ?>" class="button ui-icon ui-icon-pencil" title="<?php echo __('Edit user'); ?>"></a>
				<a href="/competition/delete/<?php echo $item->id; ?>" class="button ui-icon ui-icon-trash ajax item-delete" title="<?php echo __('Delete user'); ?>"></a>
<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>