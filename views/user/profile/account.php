<div id="change-account-window">
	<table class="ui-table">
		<tbody>
			<tr>
				<th><?php echo __('Username'); ?></th>
				<td><?php echo $account->username; ?></td>
			</tr>
			<tr>
				<th><?php echo __('Password'); ?></th>
				<td><span style="color:#999;">*****</span> <span style="font-size:11px;">[ <a href="/user/changepassword"><?php echo __('Change password'); ?></a> ]</span></td>
			</tr>
			<tr>
				<th><?php echo __('Email'); ?></th>
				<td><?php echo $account->email; ?></td>
			</tr>
			<tr>
				<th><?php echo __('Theme'); ?></th>
				<td><?php echo $account->theme; ?></td>
			</tr>
			<tr>
				<th><?php echo __('Language'); ?></th>
				<td><?php echo $account->language; ?></td>
			</tr>
		</tbody>
	</table>
	<br />
	<a href="/user/profile/change" class="button small" id="change-account-button"><?php echo __('Change account'); ?></a>
</div>
<script type="text/javascript">
$('.button').button();
$('#change-account-button').bind('click', function(){
	$('#change-account-window').append($(document.createElement('div')).addClass('loading'));
	$.get($(this).attr('href'), function(data){
		$('#change-account-window').html(data);
	});
	return false;
});
</script>