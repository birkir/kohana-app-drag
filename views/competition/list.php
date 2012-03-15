<table class="basic box">
	<caption><?=__('Competitions');?></caption>
	<thead>
		<tr>
			<th><?=__('Name');?></th>
			<th><?=__('Description');?></th>
			<th><?=__('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>
		<tr>
			<td><?=$item->name;?></td>
			<td><?=$item->description;?></td>
			<td><a href="/competition/<?=$item->slug;?>"><?=__('View');?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>