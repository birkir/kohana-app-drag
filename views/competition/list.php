<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($competitions as $competition): ?>
		<tr data-id="<?php echo $competition->id; ?>">
			<td><?php echo $competition->id; ?></td>
			<td><a href="/competition/rounds/<?php echo $competition->id; ?>"><?php echo $competition->name; ?></a></td>
			<td><a href="/competition/rounds/<?php echo $competition->id; ?>"><?php echo $competition->description; ?></a></td>
			<td>
				<a href="/competition/rounds/<?php echo $competition->id; ?>" class="button ui-icon ui-icon-search" title="<?php echo __('View details'); ?>"></a>
<?php if ($user->has('roles', ORM::factory('role', array('name' => 'admin')))): ?>
				<a href="/competition/edit/<?php echo $competition->id; ?>" class="button ui-icon ui-icon-pencil" title="<?php echo __('Edit competition'); ?>"></a>
				<a href="/competition/delete/<?php echo $competition->id; ?>" class="button ui-icon ui-icon-trash ajax item-delete" title="<?php echo __('Delete competition'); ?>"></a>
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
		title: "<?php echo __('Delete competition'); ?>",
		resizable: false,
		height:140,
		modal: true,
		autoOpen: false,
		buttons: {
			"<?php echo __('Delete competition'); ?>": function() {
				var t = $(this);
				$.getJSON(url, function(data){
					t.dialog("close");
					if (data.status != 200){
						alert(data.status + " - " + data.message);
					}else
					{
						window.location = 'http://'+window.location.host+window.location.pathname + "?time=<?php echo time(); ?>#" + "msg,error,<?php echo __('Successfully deleted competition'); ?>";
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
		<?php echo __('Are you sure you want to delete this competition?'); ?>
	</div>
</div>
<br />
<a href="/competition/add" class="button small"><?php echo __('Add competition'); ?></a>
<?php endif; ?>