$(document).ready(function(){

	Drag.init();

});

var Drag = {

	init: function()
	{
		this.equal_height_columns();
	},

	equal_height_columns: function()
	{
		var columns = {
			content: $('#content'),
			aside: $('aside')
		};

		if (columns.content.height() > columns.aside.height())
		{
			columns.aside.css({ height: columns.content.height() });
		}
	}

};
