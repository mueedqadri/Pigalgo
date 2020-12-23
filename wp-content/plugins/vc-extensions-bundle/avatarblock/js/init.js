jQuery(document).ready(function($) {
    $('.cq-avatarblock').each(function(index, el) {
        var _this = $(this);
        var _tooltip = $(this).data('tooltip');
        var _bgcolor = $(this).data('bgcolor');
        var _custombgcolor = $(this).data('custombgcolor');
        var _contentheight = $(this).data('contentheight');
        var _bordercolor = $(this).data('bordercolor');
        if(_bordercolor!=""){
        	$('.cq-avatarblock-avatar', _this).css('border', '4px solid ' + _bordercolor);
        }
        if(_contentheight!=""){
	        $('.cq-avatarblock-content', _this).css('height', _contentheight);
        }
        if(_bgcolor=="customized"&&_custombgcolor!=""){
        	$('.cq-avatarblock-contentcontainer, .cq-avatarblock-avatar', _this).css('background-color', _custombgcolor);
        }
        if(_tooltip&&_tooltip!==""){
            var _tooltip = $('.cq-avatarblock-avatar', _this).tooltipster({
                content: _tooltip,
                position: 'top',
                // offsetY: '-4',
                delay: 200,
                // minWidth: _minwidth,
                // maxWidth: 600,
                // autoClose: _autoclose,
                interactive: true,
                // onlyOne: true,
                // timer: 2000,
                speed: 300,
                touchDevices: true,
                // interactive: false,
                animation: 'grow',
                theme: 'tooltipster-shadow',
                contentAsHTML: true
            });
        }

    });
});
