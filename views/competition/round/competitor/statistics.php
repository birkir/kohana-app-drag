<div class="box">
	<h3><?=__('Statistics');?></h3>
	<table class="properties">
		<tbody>
			<tr>
				<th></th>
				<th>Min</th>
				<th>Max</th>
				<th>Average</th>
			</tr>
			<tr>
				<th><?=__('Reaction time');?></th>
				<td><?=$item['rt']['min'];?></td>
				<td><?=$item['rt']['max'];?></td>
				<td><?=$item['rt']['avg'];?></td>
			</tr>
			<tr>
				<th><?=__('60ft');?></th>
				<td><?=$item['60ft']['min'];?></td>
				<td><?=$item['60ft']['max'];?></td>
				<td><?=$item['60ft']['avg'];?></td>
			</tr>
			<tr>
				<th><?=__('660ft');?></th>
				<td><?=$item['660ft']['min'];?></td>
				<td><?=$item['660ft']['max'];?></td>
				<td><?=$item['660ft']['avg'];?></td>
			</tr>
			<tr>
				<th><?=__('660mph');?></th>
				<td><?=$item['660mph']['min'];?></td>
				<td><?=$item['660mph']['max'];?></td>
				<td><?=$item['660mph']['avg'];?></td>
			</tr>
			<tr>
				<th><?=__('1320ft');?></th>
				<td><?=$item['1320ft']['min'];?></td>
				<td><?=$item['1320ft']['max'];?></td>
				<td><?=$item['1320ft']['avg'];?></td>
			</tr>
			<tr>
				<th><?=__('1320mph');?></th>
				<td><?=$item['1320mph']['min'];?></td>
				<td><?=$item['1320mph']['max'];?></td>
				<td><?=$item['1320mph']['avg'];?></td>
			</tr>
			<tr>
				<th></th>
				<th>Left</th>
				<th>Right</th>
				<th></th>
			</tr>
			<tr>
				<th>Lane usage</th>
				<td>2 (100%)</td>
				<td>0 (0%)</td>
				<td></td>
			</tr>
		</tbody>
	</table>
</div>
