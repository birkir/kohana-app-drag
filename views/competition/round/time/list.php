<table class="basic box">
	<caption><?=__('Times');?></caption>
	<thead>
		<th><?=__('ID');?></th>
		<th><?=__('Date');?></th>
		<th><?=__('Identity');?></th>
		<th><?=__('Index');?></th>
		<th><?=__('RT');?></th>
		<th><?=__('60ft');?></th>
		<th><?=__('660ft');?></th>
		<th><?=__('660mph');?></th>
		<th><?=__('1320ft');?></th>
		<th><?=__('1320mph');?></th>
		<th><?=__('Action');?></th>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>
		<tr>
			<td><?=$item->id;?></td>
			<td><?=date('H:i:s', strtotime($item->date));?></td>
			<td><a href="/competition/<?=$param['competition'];?>/round/<?=$param['round'];?>/competitor/<?=$item->identity;?>"><?=$item->identity; ?></a></td>
			<td><?=$item->index; ?> s</td>
			<td><?=$item->rt; ?> s</td>
			<td><?=$item->{'60ft'};?> s</td>
			<td><?=$item->{'660ft'};?> s</td>
			<td><?=$item->{'660mph'};?></td>
			<td><?=$item->{'1320ft'};?> s</td>
			<td><?=$item->{'1320mph'};?></td>
			<td><a href="/competition/<?=$param['competition'];?>/round/<?=$param['round'];?>/time/<?=$item->id;?>"><?=__('View');?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
