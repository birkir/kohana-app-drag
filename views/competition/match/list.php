<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th style="text-align: center;"><?php echo __('Car'); ?></th>
			<th style="text-align: center;"><?php echo __('Competitor'); ?></th>
			<th style="width: 3%;text-align: center;">vs</th>
			<th style="text-align: center;"><?php echo __('Competitor'); ?></th>
			<th style="text-align: center;"><?php echo __('Car'); ?></th>
			<th style="text-align: center;"><?php echo __('Times'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($matches as $match): ?>
		<tr>
			<td><?php echo $match->id; ?></td>
			<td style="text-align: center;"><?php echo $match->a_competitor->car; ?></td>
			<td style="text-align: center;"><?php echo $match->a_competitor->driver; ?></td>
			<td style="text-align: center;">vs</td>
			<td style="text-align: center;"><?php echo $match->b_competitor->driver; ?></td>
			<td style="text-align: center;"><?php echo $match->b_competitor->car; ?></td>
			<td style="text-align: center;"><a href="/competition/match/<?php echo $match->id; ?>?id=<?php echo $_GET['id']; ?>&amp;r=<?php echo $match->round->id; ?>"><?php echo __('View timeslip'); ?></a></td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>