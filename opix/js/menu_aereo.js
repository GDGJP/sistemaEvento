	$(document).ready(
		function()
		{
			$('#dock').Fisheye(
				{
					maxWidth: 20,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: 40,
					proximity: 30,
					halign : 'center'
				}
			)
		}
	);
	



