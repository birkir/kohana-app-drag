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
<?php foreach ($times as $time): ?>
<?php if ($time->{'60ft'} == '0.000' AND $time->{'660ft'} == '0.000' AND $time->{'1320ft'} == '0.000') continue; ?>
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