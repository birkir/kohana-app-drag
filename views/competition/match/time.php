<table class="ui-table">
	<tbody>
		<tr>
			<th>Identity</th>
			<td><?php echo $identity; ?></td>
		</tr>
		<tr>
			<th>Driver</th>
			<td><?php echo $competitor->driver; ?></td>
		</tr>
		<tr>
			<th>Car</th>
			<td><?php echo $competitor->car; ?></td>
		</tr>
		<tr>
			<th>RT</th>
			<td><?php echo $time->rt; ?></td>
		</tr>
		<tr>
			<th>60 feet</th>
			<td><?php echo $time->{'60ft'}; ?></td>
		</tr>
		<tr>
			<th>660 feet</th>
			<td><?php echo $time->{'660ft'}; ?></td>
		</tr>
		<tr>
			<th>660 mph</th>
			<td><?php echo $time->{'660mph'}; ?></td>
		</tr>
		<tr>
			<th>1320 feet</th>
			<td><?php echo $time->{'1320ft'}; ?></td>
		</tr>
		<tr>
			<th>1320 mph</th>
			<td><?php echo $time->{'1320mph'}; ?></td>
		</tr>
	</tbody>
</table>