<div class="box">
	<h3><?=__('Weather');?></h3>
	<table class="properties">
		<tbody>
			<tr>
				<th><?=__('Temperature');?></th>
				<td><?=number_format($weather['heat'], 2, '.', NULL);?> °C</td>
			</tr>
			<tr>
				<th><?=__('Average wind');?></th>
				<td><?=number_format($weather['wind'], 2, '.', NULL);?> <?=__('m/sec');?></td>
			</tr>
			<tr>
				<th><?=__('Wind direction');?></th>
				<td><?=number_format($weather['direction'], 0, '.', NULL);?> °</td>
			</tr>
			<tr>
				<th><?=__('Max ghust');?></th>
				<td><?=number_format($weather['ghust'], 2, '.', NULL);?> <?=__('m/sec');?></td>
			</tr>
			<tr>
				<th><?=__('Precipitation');?></th>
				<td><?=number_format($weather['rain'], 2, '.', NULL);?> <?=__('mm');?></td>
			</tr>
			<tr>
				<th><?=__('Humidity');?></th>
				<td><?=number_format($weather['humidity'], 1, '.', NULL);?> %</td>
			</tr>
			<tr>
				<th><?=__('Pressure');?></th>
				<td><?=number_format($weather['pressure'] / 1000, 5, '.', NULL);?> <?=__('bar');?></td>
			</tr>
		</tbody>
	</table>
</div>
