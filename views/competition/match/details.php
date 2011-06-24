<table class="ui-table">
	<tbody>
		<tr>
			<th><?php echo __('Air temperature'); ?></th>
			<td><?php echo $weather['lofthiti']; ?>°C</td>
		</tr>
		<tr>
			<th><?php echo __('Humidity'); ?></th>
			<td><?php echo $weather['rakastig']; ?>%</td>
		</tr>
		<tr>
			<th><?php echo __('Atmospheric Pressure'); ?></th>
			<td><?php echo $weather['leiðréttur loftþrýstingur í stöðvarhæð']; ?> hPa</td>
		</tr>
<!--
		<tr>
			<th><?php echo __('Precipitation'); ?></th>
			<td><?php echo $weather['úrkoma']; ?></td>
		</tr>
-->
		<tr>
			<th><?php echo __('Wind direction'); ?></th>
			<td><?php echo $weather['vindátt']; ?>°</td>
		</tr>
		<tr>
			<th><?php echo __('Wind speed'); ?></th>
			<td><?php echo $weather['10 mín. meðalvindhraði']; ?> m/s</td>
		</tr>
	</tbody>
</table>