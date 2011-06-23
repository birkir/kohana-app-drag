<table class="ui-table">
	<tbody>
		<tr>
			<th>Lofthiti</th>
			<td><?php echo $weather['lofthiti']; ?>°C</td>
		</tr>
		<tr>
			<th>Rakastig</th>
			<td><?php echo $weather['rakastig']; ?>%</td>
		</tr>
		<tr>
			<th>Loftþrýstingur</th>
			<td><?php echo $weather['leiðréttur loftþrýstingur í stöðvarhæð']; ?> hPa</td>
		</tr>
		<tr>
			<th>Úrkoma</th>
			<td><?php echo $weather['úrkoma']; ?></td>
		</tr>
		<tr>
			<th>Vindátt</th>
			<td><?php echo $weather['vindátt']; ?>°</td>
		</tr>
		<tr>
			<th>Vindur</th>
			<td><?php echo $weather['10 mín. meðalvindhraði']; ?> m/s</td>
		</tr>
	</tbody>
</table>