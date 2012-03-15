<div class="box">
	<h3><?=__('Details');?></h3>
	<table class="properties">
		<tbody>
			<tr>
				<th><?=__('Date');?></th>
				<td><?=utf8_encode(strftime('%e. %B %Y', strtotime($item->date)));?></td>
			</tr>
			<tr>
				<th><?=__('Time');?></th>
				<td><?=strftime('%R', strtotime($item->date));?></td>
			</tr>
			<tr>
				<th><?=__('Identity');?></th>
				<td><a href="/competition/<?=$param['competition'];?>/round/<?=$param['round'];?>/competitor/<?=$item->identity;?>"><?=$item->identity; ?></a></td>
			</tr>
			<tr>
				<th><?=__('Lane');?></th>
				<td><?=__($item->lane == 'l' ? 'Left' : 'Right');?></td>
			</tr>
			<tr>
				<th><?=__('Won');?></th>
				<td><?=__($item->won == 1 ? 'Yes' : 'No');?></td>
			</tr>
			<tr>
				<th><?=__('Foul');?></th>
				<td><?=__($item->foul == 1 ? 'Yes' : 'No');?></td>
			</tr>
			<tr>
				<th><?=__('Index time');?></th>
				<td><?=$item->index; ?> s</td>
			</tr>
			<tr>
				<th><?=__('Reaction time');?></th>
				<td><?=$item->rt; ?> s</td>
			</tr>
			<tr>
				<th><?=__('60ft time');?></th>
				<td><?=$item->{'60ft'};?> s</td>
			</tr>
			<tr>
				<th><?=__('660ft time');?></th>
				<td><?=$item->{'660ft'};?> s</td>
			</tr>
			<tr>
				<th><?=__('660 mph');?></th>
				<td><?=$item->{'660mph'};?> mph</td>
			</tr>
			<tr>
				<th><?=__('1320ft time');?></th>
				<td><?=$item->{'1320ft'};?> s</td>
			</tr>
			<tr>
				<th><?=__('1320 mph');?></th>
				<td><?=$item->{'1320mph'};?> mph</td>
			</tr>
		</tbody>
	</table>
</div>
