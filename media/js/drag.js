$(document).ready(function(){
	$('input[type=button], input[type=submit], .button, button').button();
	$('table.ui-table').tablesorter();
	$('select').combobox();
	$('.datepicker').datetimepicker({
		dateFormat: 'yy-mm-dd'
	});
	if (location.hash != '')
	{
		var hash = (location.hash).replace(/#/, '');
		if (hash.substring(0,3) == 'msg')
		{
			hash = hash.split(",");
			var d = $(document.createElement('div')).addClass('message').addClass(hash[1]);
			d.append($(document.createElement('p')).html(hash[2]));
			$('#main .block:eq(0) .content').prepend(d);
			location.hash = '';
			setTimeout(function(){
				d.fadeOut(330);
			}, 1320);
		}
	}
});