<table class="basic box">
	<caption><?=__('Competitors');?></caption>
	<thead>
		<tr>
			<th><?=__('ID');?></th>
			<th><?=__('Identity');?></th>
			<th><?=__('Driver');?></th>
			<th><?=__('Car');?></th>
			<th><?=__('Class');?></th>
			<th><?=__('Actions');?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>
		<tr>
			<td><?=$item->id;?></td>
			<td><?=$item->identity;?></td>
			<td><?=$item->driver;?></td>
			<td><?=$item->car;?></td>
			<td>
				<a href="/competition/<?=$param['competition'];?>/round/<?=$param['round'];?>/class/<?=$item->class->id;?>/details"><?=$item->class->description;?></a>
			</td>
			<td>
				<a href="/competition/<?=$param['competition'];?>/round/<?=$param['round'];?>/competitor/<?=$item->id;?>"><?=__('View');?></a>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
