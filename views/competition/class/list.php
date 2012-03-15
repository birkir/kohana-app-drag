<table class="basic box">
	<caption><?=__('Classes');?></caption>
	<thead>
		<tr>
			<th><?=__('Name');?></th>
			<th><?=__('Description');?></th>
<?php if (isset($detailed) AND $detailed == TRUE): ?>
			<th><?=__('Rules'); ?></th>
<?php endif; ?>
			<th><?=__('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>
		<tr>
			<td><?=$item->name;?></td>
			<td><?=$item->description;?></td>
<?php if (isset($detailed) AND $detailed == TRUE): ?>
			<td><a href="<?=$item->rules;?>"><?=__('Rules'); ?></a></td>
<?php endif; ?>
			<td><a href="/competition/<?=Request::current()->param('competition');?>/class/<?=$item->name;?>"><?=__('View');?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
