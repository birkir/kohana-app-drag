<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($competitions as $competition): ?>
		<tr>
			<td><?php echo $competition->id; ?></td>
			<td><a href="/competition/rounds?id=<?php echo $competition->id; ?>"><?php echo $competition->name; ?></a></td>
			<td><a href="/competition/rounds?id=<?php echo $competition->id; ?>"><?php echo $competition->description; ?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>