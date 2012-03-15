<div class="box">
	<h3><?=__('Statistics');?></h3>
	<table class="properties">
		<tbody>
			<tr>
				<th><?=__('Date');?></th>
				<td><?=utf8_encode(strftime('%e. %B %Y', strtotime($round->datetime)));?></td>
			</tr>
			<tr>
				<th><?=__('Time');?></th>
				<td><?=strftime('%R', strtotime($round->datetime));?></td>
			</tr>
			<tr>
				<th><?=__('Competition'); ?></th>
				<td><?=$competition->name; ?></td>
			</tr>
			<tr>
				<th><?=__('Round');?></th>
				<td><?=$round->name;?></td>
			</tr>
			<tr>
				<th><?=__('Track');?></th>
				<td><?=$round->track->name;?></td>
			</tr>
			<tr>
				<th><?=__('Total competitors');?></th>
				<td><?=$round->competitors->count_all();?></td>
			</tr>
			<tr>
				<th><?=__('Total matches');?></th>
				<td><?=$round->matches->count_all();?></td>
			</tr>
			<tr>
				<th><?=__('Lane usage'); ?></th>
				<td><?=__('Left');?>: <?=$lr['lv'];?> (<?=$lr['lp'];?>%)
			</tr>
			<tr>
				<th></th>
				<td><?=__('Right');?>: <?=$lr['rv'];?> (<?=$lr['rp'];?>%)</td>
			</tr>
		</tbody>
	</table>
</div>
