<table class="ui-table">
	<thead>
		<tr>
			<td><?php echo __('#'); ?></td>
			<td><?php echo __('Name'); ?></td>
			<td><?php echo __('Track'); ?></td>
			<td><?php echo __('Date'); ?></td>
			<td><?php echo __('Competitors'); ?></td>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rounds as $round): ?>
		<tr>
			<td><?php echo $round->id; ?></td>
			<td><a href="/competition/competitors/<?php echo $round->id; ?>?id=<?php echo $round->competition->id; ?>"><?php echo $round->competition->name; ?>: <?php echo $round->name; ?></a></td>
			<td><a href="/competition/competitors/<?php echo $round->id; ?>?id=<?php echo $round->competition->id; ?>"><?php echo $round->track->name; ?></a></td>
			<td><a href="/competition/competitors/<?php echo $round->id; ?>?id=<?php echo $round->competition->id; ?>"><?php echo $round->datetime; ?></a></td>
			<td><a href="/competition/competitors/<?php echo $round->id; ?>?id=<?php echo $round->competition->id; ?>"><?php echo $round->competitors->find_all()->count(); ?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>