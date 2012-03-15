<table class="basic box">
	<caption><?=__('Rounds'); ?></caption>
	<thead>
		<tr>
			<th><?=__('Name');?></th>
			<th><?=__('Practice');?></th>
			<th><?=__('Date');?></th>
			<th><?=__('Competitors');?></th>
			<th><?=__('Matches');?></th>
			<th><?=__('Track');?></th>
			<th><?=__('Action');?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($items as $item): ?>

<?php if ( ! isset($last_year) OR date('Y', strtotime($item->datetime)) != $last_year): ?>
		<tr>
			<th colspan="6"><?=date('Y', strtotime($item->datetime));?></th>
		</tr>
<?php endif; ?>

		<tr>
			<td><?=$item->name;?></td>
			<td><?=__($item->practice == 1 ? 'Yes' : 'No');?></td>
			<td><?=utf8_encode(strftime('%e. %B', strtotime($item->datetime)));?>
			<td><?=$item->competitors->count_all();?></td>
			<td><?=$item->matches->count_all();?></td>
			<td><?=$item->track->name;?></td>
			<td><a href="/competition/<?=Request::current()->param('competition');?>/round/<?=$item->id;?>"><?=__('View');?></a></td>
		</tr>

<?php $last_year = date('Y', strtotime($item->datetime)); ?>
<?php endforeach; ?>
	</tbody>
</table>
