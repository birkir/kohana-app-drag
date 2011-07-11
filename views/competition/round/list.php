<table class="ui-table">
	<thead>
		<tr>
			<th><?php echo __('#'); ?></th>
			<th><?php echo __('Name'); ?></th>
			<th><?php echo __('Track'); ?></th>
			<th><?php echo __('Date'); ?></th>
			<th><?php echo __('Competitors'); ?></th>
			<th><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($rounds as $round): ?>
		<tr>
			<td><?php echo $round->id; ?></td>
			<td><a href="/competition/round/<?php echo $round->id; ?>/<?php echo $round->competition->id; ?>"><?php echo $round->competition->name; ?>: <?php echo $round->name; ?></a></td>
			<td><a href="/competition/round/<?php echo $round->id; ?>/<?php echo $round->competition->id; ?>"><?php echo $round->track->name; ?></a></td>
			<td><a href="/competition/round/<?php echo $round->id; ?>/<?php echo $round->competition->id; ?>"><?php echo $round->datetime; ?></a></td>
			<td><a href="/competition/round/<?php echo $round->id; ?>/<?php echo $round->competition->id; ?>"><?php echo $round->competitors->find_all()->count(); ?></a></td>
			<td>
				<a href="/competition/round/<?php echo $round->id; ?>" class="button ui-icon ui-icon-search" title="<?php echo __('View details'); ?>"></a>
<?php if ($user->has('roles', ORM::factory('role', array('name' => 'admin')))): ?>
				<a href="/competition/round_edit/<?php echo $id; ?>/<?php echo $round->id; ?>" class="button ui-icon ui-icon-pencil" title="<?php echo __('Edit round'); ?>"></a>
				<a href="/competition/round_delete/<?php echo $id; ?>/<?php echo $round->id; ?>" class="button ui-icon ui-icon-trash ajax item-delete" title="<?php echo __('Delete round'); ?>"></a>
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
		title: "<?php echo __('Delete round'); ?>",
		resizable: false,
		height:140,
		modal: true,
		autoOpen: false,
		buttons: {
			"<?php echo __('Delete round'); ?>": function() {
				var t = $(this);
				$.getJSON(url, function(data){
					t.dialog("close");
					if (data.status != 200){
						alert(data.status + " - " + data.message);
					}else
					{
						window.location = 'http://'+window.location.host+window.location.pathname + "?time=<?php echo time(); ?>#" + "msg,error,<?php echo __('Successfully deleted round'); ?>";
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
		<?php echo __('Are you sure you want to delete this round?'); ?>
	</div>
</div>
<br />
<a href="/competition/round_add/<?php echo $id; ?>" class="button small"><?php echo __('Add round'); ?></a>
<?php endif; ?>
