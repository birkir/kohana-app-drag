<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Class'); ?></th>
			<th><?php echo __('Identity'); ?></th>
			<th><?php echo __('Driver'); ?></th>
			<th><?php echo __('Car'); ?></th>
			<th><?php echo __('Actions'); ?></th>
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
			<td><a href="/competition/competitor/<?php echo $competitor->id; ?>/<?php echo $parent; ?>"><?php echo __('View details'); ?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>