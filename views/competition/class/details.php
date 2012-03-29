<div class="box">
	<h3><?=__('Details');?></h3>
	<table class="properties">
		<tbody>
			<tr>
				<th><?=__('ID');?></th>
				<td><?=$item->name;?></td>
			</tr>
			<tr>
				<th><?=__('Name');?></th>
				<td><?=$item->description;?></td>
			</tr>
			<tr>
				<th><?=__('Rules');?></th>
				<td><a href="<?=$item->rules;?>"><?=__('Rules');?></a></td>
			</tr>
			<tr>
				<th><?=__('Description');?></th>
				<td><?=$item->summary;?></td>
			</tr>
		</tbody>
	</table>
</div>