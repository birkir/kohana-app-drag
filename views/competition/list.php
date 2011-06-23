<table class="ui-table">
	<thead>
		<tr>
			<td><?php echo __('#'); ?></td>
			<td><?php echo __('Year'); ?></td>
			<td><?php echo __('Name'); ?></td>
			<td><?php echo __('Description'); ?></td>
		</tr>
	</thead>
	<tbody>
<?php foreach ($competitions as $competition): ?>
		<tr>
			<td><?php echo $competition->id; ?></td>
			<td><a href="/competition/rounds?id=<?php echo $competition->id; ?>"><?php echo $competition->year; ?></a></td>
			<td><a href="/competition/rounds?id=<?php echo $competition->id; ?>"><?php echo $competition->name; ?></a></td>
			<td><a href="/competition/rounds?id=<?php echo $competition->id; ?>"><?php echo $competition->description; ?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>