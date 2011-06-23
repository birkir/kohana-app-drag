<table class="ui-table">
	<thead>
		<tr>
			<td><?php echo __('#'); ?></td>
			<td><?php echo __('Class'); ?></td>
			<td><?php echo __('Identity'); ?></td>
			<td><?php echo __('Driver'); ?></td>
			<td><?php echo __('Car'); ?></td>
			<td><?php echo __('Actions'); ?></td>
		</tr>
	</thead>
	<tbody>
<?php foreach ($competitors as $competitor): ?>
		<tr>
			<td><?php echo $competitor->id; ?></td>
			<td><?php echo $competitor->class->name; ?></td>
			<td><?php echo $competitor->identity; ?></td>
			<td><?php echo $competitor->driver; ?></td>
			<td><?php echo $competitor->car; ?></td>
			<td><a href="/competition/competitor/<?php echo $competitor->id; ?>?id=<?php echo $id; ?>"><?php echo __('View details'); ?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>