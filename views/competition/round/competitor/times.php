<table class="ui-table">
	<thead>
		<tr>
			<td><?php echo __('#'); ?></td>
			<td><?php echo __('Date'); ?></td>
			<td><?php echo __('60ft time'); ?></td>
			<td><?php echo __('660ft time'); ?></td>
			<td><?php echo __('660ft speed'); ?></td>
			<td><?php echo __('1320ft time'); ?></td>
			<td><?php echo __('1320ft speed'); ?></td>
		</tr>
	</thead>
	<tbody>
<?php foreach ($matches as $match): ?>
<?php $time = ($competitor_id == $match->competitor_a) ? $match->a_time : $match->b_time; ?>
		<tr>
			<td><?php echo $time->id; ?></td>
			<td><?php echo $time->date; ?></td>
			<td><?php echo $time->{'60ft'}; ?> s</td>
			<td><?php echo $time->{'660ft'}; ?> s</td>
			<td><?php echo $time->{'660mph'}; ?> mph</td>
			<td><?php echo $time->{'1320ft'}; ?> s</td>
			<td><?php echo $time->{'1320mph'}; ?> mph</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>