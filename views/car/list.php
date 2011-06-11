<div class="block">
	<h2><?php echo __('Cars list'); ?></h2>
	<div class="content">
		<table class="ui-table">
			<thead>
				<tr>
					<td><?php echo __('Year'); ?></td>
					<td><?php echo __('Make'); ?></td>
					<td><?php echo __('Model'); ?></td>
					<td><?php echo __('Owner'); ?></td>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($cars as $car): ?>
				<tr>
					<td><?php echo $car->year; ?></td>
					<td><?php echo $car->make; ?></td>
					<td><?php echo $car->model; ?></td>
					<td><?php echo $car->user->username; ?></td>
				</tr>
		<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>