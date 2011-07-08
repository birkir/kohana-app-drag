<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Class'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Rules'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($classes as $class): ?>
		<tr>
			<td><?php echo $class->id; ?></td>
			<td><?php echo $class->name; ?></td>
			<td><?php echo $class->description; ?></td>
			<td><?php echo empty($class->rules) ? __('No rules') : __('Click to read'); ?></td>
			<td>
<?php if ($user->has('roles', ORM::factory('role', array('name' => 'admin')))): ?>
				<a href="/competition/class_edit/<?php echo $id; ?>/<?php echo $class->id; ?>" class="button ui-icon ui-icon-pencil" title="<?php echo __('Edit class'); ?>"></a>
				<a href="/competition/class_delete/<?php echo $id; ?>/<?php echo $class->id; ?>" class="button ui-icon ui-icon-trash ajax item-delete" title="<?php echo __('Delete class'); ?>"></a>
<?php endif; ?>
			</td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
<?php if ($user->has('roles', ORM::factory('role', array('name' => 'admin')))): ?>
<script type="text/javascript">
$(document).ready(function(){
	var url = '';
	$("#dialog").dialog({
		title: "<?php echo __('Delete class'); ?>",
		resizable: false,
		height:140,
		modal: true,
		autoOpen: false,
		buttons: {
			"<?php echo __('Delete class'); ?>": function() {
				var t = $(this);
				$.getJSON(url, function(data){
					t.dialog("close");
					if (data.status != 200){
						alert(data.status + " - " + data.message);
					}else
					{
						window.location = 'http://'+window.location.host+window.location.pathname + "?time=<?php echo time(); ?>#" + "msg,error,<?php echo __('Successfully deleted class'); ?>";
					}
				});
			},
			"<?php echo __('Cancel'); ?>": function(){
				$(this).dialog("close");
			}
		}
	});
	$('.item-delete').bind('click', function(){
		$('#dialog').dialog('option', 'title', $(this).parent('td').prev().prev().find('a').text());
		url = $(this).attr('href');
		$('#dialog').dialog('open');
		return false;
	});
});
</script>
<div class="hidden">
	<div id="dialog">
		<?php echo __('Are you sure you want to delete this class?'); ?>
	</div>
</div>
<br />
<a href="/competition/class_add/<?php echo $id; ?>" class="button small"><?php echo __('Add class'); ?></a>
<?php endif; ?>