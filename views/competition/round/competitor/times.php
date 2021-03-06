<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Date'); ?></th>
			<th><?php echo __('Index'); ?></th>
			<th><?php echo __('RT'); ?></th>
			<th><?php echo __('60ft time'); ?></th>
			<th><?php echo __('660ft time'); ?></th>
			<th><?php echo __('660ft speed'); ?></th>
			<th><?php echo __('1320ft time'); ?></th>
			<th><?php echo __('1320ft speed'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($matches as $match): ?>
<?php $time = ($competitor_id == $match->competitor_a) ? $match->a_time : $match->b_time; ?>
		<tr>
			<td><?php echo $time->id; ?></td>
			<td><?php echo $time->date; ?></td>
			<td><?php echo $time->index; ?> s</td>
			<td><?php echo $time->rt; ?> s</td>
			<td><?php echo $time->{'60ft'}; ?> s</td>
			<td><?php echo $time->{'660ft'}; ?> s</td>
			<td><?php echo $time->{'660mph'}; ?> mph</td>
			<td><?php echo $time->{'1320ft'}; ?> s</td>
			<td><?php echo $time->{'1320mph'}; ?> mph</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>