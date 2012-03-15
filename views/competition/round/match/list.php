<table class="basic box">
	<caption><?=__('Matches');?></caption>
	<thead>
		<th><?=__('Car');?></th>
		<th><?=__('Driver');?></th>
		<th><?=__('vs');?></th>
		<th><?=__('Driver');?></th>
		<th><?=__('Car');?></th>
		<th><?=__('Action');?></th>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>
<?php $times = $item->times->find_all()->as_array(); ?>
		<tr>
			<td><?=$times[0]->competitor->car;?></td>
			<td><?=$times[0]->competitor->driver;?></td>
			<td><?=__('vs');?></td>
			<td><?=$times[1]->competitor->driver;?></td>
			<td><?=$times[1]->competitor->car;?></td>
			<td><a href="/competition/<?=$param['competition'];?>/round/<?=$param['round'];?>/match/<?=$item->id;?>"><?=__('View');?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
