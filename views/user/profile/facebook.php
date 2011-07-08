<?php if ($facebook->logged_in()): ?>
<?php $me = $facebook->account(); ?>
<table class="ui-table">
	<tbody>
		<tr>
			<th><?php echo __('Full name'); ?></th>
			<td><?php echo $me['name']; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Location'); ?></th>
			<td><?php echo $me['location']['name']; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Hometown'); ?></th>
			<td><?php echo $me['hometown']['name']; ?></td>
		</tr>
		<tr>
			<th><?php echo __('Gender'); ?></th>
			<td><?php echo __(UTF8::ucfirst($me['gender'])); ?></td>
		</tr>
		<tr>
			<th><?php echo __('Languages'); ?></th>
			<td><?php foreach ($me['languages'] as $i => $language): ?><?php if ($i > 0): ?>, <?php endif; ?><?php echo $language['name']; ?><?php endforeach; ?></td>
		</tr>
	</tbody>
</table>
<br />
<a class="fb_button" href="<?php echo $facebook->facebook()->getLogoutUrl(); ?>"><span class="fb_button_text"><?php echo __('Logout'); ?></span></a>
<?php else: ?>
<a class="fb_button" href="<?php echo $facebook->facebook()->getLoginUrl(); ?>"><span class="fb_button_text"><?php echo __('Login'); ?></span></a>
<?php endif; ?>