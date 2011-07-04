<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Track'); ?></th>
			<th><?php echo __('Date'); ?></th>
			<th><?php echo __('Competitors'); ?></th>
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