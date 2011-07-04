<table class="ui-table">
	<tbody>
		<tr>
			<th><?php echo __('Date'); ?></th>
			<td><?php echo $time->date; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Identity'); ?></th>
			<td><?php echo $identity; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Driver'); ?></th>
			<td><?php echo $competitor->driver; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Car'); ?></th>
			<td><?php echo $competitor->car; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Index'); ?></th>
			<td><?php echo $time->index; ?></td>
		</tr>
		<tr>
			<th><?php echo __('RT'); ?></th>
			<td><?php echo $time->rt; ?> s</td>
		</tr>
		<tr>
			<th><?php echo __('60ft time'); ?></th>
			<td><?php echo $time->{'60ft'}; ?> s</td>
		</tr>
		<tr>
			<th><?php echo __('660ft time'); ?></th>
			<td><?php echo $time->{'660ft'}; ?> s</td>
		</tr>
		<tr>
			<th><?php echo __('660ft speed'); ?></th>
			<td><?php echo $time->{'660mph'}; ?> mph</td>
		</tr>
		<tr>
			<th><?php echo __('1320ft time'); ?></th>
			<td><?php echo $time->{'1320ft'}; ?> s</td>
		</tr>
		<tr>
			<th><?php echo __('1320ft speed'); ?></th>
			<td><?php echo $time->{'1320mph'}; ?> mph</td>
		</tr>
	</tbody>
</table>