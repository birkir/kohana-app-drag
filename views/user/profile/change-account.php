<form action="/user/profile/save" id="account-change-form">
	<table class="ui-table">
		<tbody>
			<tr>
				<th><?php echo Form::label('f_username', __('Username')); ?></th>
				<td><?php echo Form::input('username', $account->username, array('id' => 'f_username', 'disabled' => 'disabled')); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('f_email', __('Email')); ?></th>
				<td><?php echo Form::input('email', $account->email, array('id' => 'f_email')); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('f_confirm_mail', __('Confirm email')); ?></th>
				<td><?php echo Form::input('confirm_email', NULL, array('id' => 'f_confirm_email')); ?></td>
			</tr>
			<tr>
				<th><?php echo Form::label('f_theme', __('Theme')); ?></th>
				<td>
					<?php $themes = array('default' => __('Default')); ?>
					<?php echo Form::select('theme', $themes, $account->theme, array('id' => 'f_theme')); ?>
				</td>
			</tr>
			<tr>
				<th><?php echo Form::label('f_language', __('Language')); ?></th>
				<td>
					<?php $langs = array('en-us' => 'English', 'is-is' => 'Íslenska'); ?>
					<?php echo Form::select('language', $langs, $account->language, array('id' => 'f_theme')); ?>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<br />
<a href="/user/profile/save" class="button small" id="account-change-save"><?php echo __('Save'); ?></a> <a href="/user/profile/view" class="button small" id="account-change-cancel"><?php echo __('Cancel'); ?></a>
<script type="text/javascript">
$('.button').button();
$('#account-change-cancel').bind('click', function(){
	$('#change-account-window').append($(document.createElement('div')).addClass('loading'));
	$.get($(this).attr('href'), function(data){
		$('#change-account-window').html(data);
	});
	return false;
});
$('#account-change-form').bind('submit', function(){
	$('#change-account-window').append($(document.createElement('div')).addClass('loading'));
	$.post($(this).attr('action'), $(this).serialize(), function(data){
		$('#change-account-window').html(data);
	});
	return false;
});
$('#account-change-save').bind('click', function(){
	$('#account-change-form').trigger('submit');
	return false;
});
</script>