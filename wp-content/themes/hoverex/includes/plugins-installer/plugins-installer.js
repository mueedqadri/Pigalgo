/* global hoverex_plugins_installer */

jQuery(document).ready(function() {
	jQuery('body').on('click', '.hoverex_plugins_installer_link', function (e) {
		var bt = jQuery(this);
		if (bt.hasClass('process-now')) return;
		bt.html(bt.data('processing')).addClass('process-now updating-message');
		var slug = bt.data('slug'),
			url = bt.attr('href');
		//Request plugin activation
		jQuery.get(url).done(function(response) {
			location.reload();
		});
        e.preventDefault();
		return false;
    });
});
