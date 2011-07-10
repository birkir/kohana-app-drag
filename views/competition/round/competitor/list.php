<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Class'); ?></th>
			<th><?php echo __('Identity'); ?></th>
			<th><?php echo __('Driver'); ?></th>
			<th><?php echo __('Car'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($competitors as $competitor): ?>
		<tr>
			<td><?php echo $competitor->id; ?></td>
			<td><?php echo $competitor->class->name; ?></td>
			<td><?php echo $competitor->identity; ?></td>
			<td><?php echo $competitor->driver; ?></td>
			<td><?php echo $competitor->car; ?></td>
			<td>
				<a href="/competition/competitor/<?php echo $competitor->id; ?>/<?php echo $id; ?>" class="button ui-icon ui-icon-search" title="<?php echo __('View details'); ?>"></a>
<?php if ($user->has('roles', ORM::factory('role', array('name' => 'admin')))): ?>
				<a href="/competition/competitor_edit/<?php echo $competitor->id; ?>/<?php echo $id; ?>" class="button ui-icon ui-icon-pencil" title="<?php echo __('Edit competitor'); ?>"></a>
				<a href="/competition/competitor_delete/<?php echo $competitor->id; ?>/<?php echo $id; ?>" class="button ui-icon ui-icon-trash ajax item-delete" title="<?php echo __('Delete competitor'); ?>"></a>
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
		title: "<?php echo __('Delete competitor'); ?>",
		resizable: false,
		height:140,
		modal: true,
		autoOpen: false,
		buttons: {
			"<?php echo __('Delete competitor'); ?>": function() {
				var t = $(this);
				$.getJSON(url, function(data){
					t.dialog("close");
					if (data.status != 200){
						alert(data.status + " - " + data.message);
					}else
					{
						window.location = 'http://'+window.location.host+window.location.pathname + "?time=<?php echo time(); ?>#" + "msg,error,<?php echo __('Successfully deleted competitor'); ?>";
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
		<?php echo __('Are you sure you want to delete this competitor?'); ?>
	</div>
</div>
<br />
<a href="/competition/competitor_add/<?php echo $id; ?>/<?php echo $parent; ?>" class="button small"><?php echo __('Add competitor'); ?></a>
<?php endif; ?>