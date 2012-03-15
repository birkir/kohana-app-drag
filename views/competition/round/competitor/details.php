<div class="box">
	<h3><?=__('Competitor');?></h3>
	<table class="properties">
		<tbody>
			<tr>
				<th><?=__('Identity');?></th>
				<td><?=$item->identity;?></td>
			</tr>
			<tr>
				<th><?=__('Class');?></th>
				<td><?=$item->class->description;?></td>
			</tr>
			<tr>
				<th><?=__('Driver');?></th>
				<td><?=$item->driver;?></td>
			</tr>
			<tr>
				<th><?=__('Car');?></th>
				<td><?=$item->car;?></td>
			</tr>
		</tbody>
	</table>
</div>
