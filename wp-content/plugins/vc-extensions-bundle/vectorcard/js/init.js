jQuery(document).ready(function($) {
    $('.cq-vectorcard').each(function(index, el) {

        var _avatar = $(this).data('avatar');
        var _backgroundcolor = $(this).data('backgroundcolor');
        var _cardbottombgcolor = $(this).data('cardbottombgcolor');
        var _backgroundimage = $(this).data('backgroundimage');
        var _backgroundimagetype = $(this).data('backgroundimagetype');
        var _avatartype = $(this).data('avatartype');
        var _iconcolor = $(this).data('iconcolor');
        var _iconbgcolor = $(this).data('iconbgcolor');
        var _avatartooltip = $(this).data('avatartooltip');
        var _iconsize = $(this).data('iconsize');
        var _authorcolor = $(this).data('authorcolor');
        var _elementheight = $(this).data('elementheight');

        if(_backgroundcolor!=""){
            $(this).find('.cq-vectorcard-top').css('background-color', _backgroundcolor);
        }
        if(_elementheight!=""){
            $(this).css('min-height', _elementheight);
        }
        if(_cardbottombgcolor!=""){
            $(this).css('background-color', _cardbottombgcolor);
        }

        if(_authorcolor!=""){
            $(this).find('.cq-vectorcard-author, .cq-vectorcard-authorrole, .cq-vectorcard-extrainfo .cq-vectorcard-extralink').css('color', _authorcolor);
        }

        if(_avatartooltip!=""){
            $(this).find('.cq-vectorcard-avatar').tooltipster({
                content: _avatartooltip,
                position: 'top',
                offsetY: '-4',
                delay: 200,
                speed: 300,
                touchDevices: true,
                interactive: false,
                animation: 'fade',
                theme: 'tooltipster-shadow',
                contentAsHTML: true
            });
        }


        if(_backgroundimage!=""){
            if(_backgroundimagetype=="cover"){
                $(this).find('.cq-vectorcard-top').css({
                    'background': 'url(' + _backgroundimage + ') no-repeat',
                    'background-position': 'center',
                    'background-size': 'cover'
                });
            }else if(_backgroundimagetype=="repeat"){
                $(this).find('.cq-vectorcard-top').css({
                    'background': 'url(' + _backgroundimage + ') repeat'
                });

            }else{
                $(this).find('.cq-vectorcard-top').css({
                    'background': 'url(' + _backgroundimage + ') no-repeat'
                });
            }

        }
        // var _topheight = $(this).find('.cq-vectorcard-bottom').height();
        // var _line = $(this).find('.cq-vectorcard-line');
        // console.log('_topheight', _topheight, _line.height());
        // _line.css({
        //     // 'bottom': _topheight + _line.height()
        //     'margin-top': -(_topheight*2 + _line.height())
        // });

        if(_avatar!=""&&_avatartype=="image"){
            $(this).find('.cq-vectorcard-avatar').css({
              'background': 'url('+_avatar+') no-repeat center center',
              'background-size': 'cover'
            });
        }

        if(_iconsize!=""){
            $(this).find('.cq-vectorcard-icon').css('font-size', _iconsize);
        }
        if(_iconcolor!=""){
            $(this).find('.cq-vectorcard-icon').css('color', _iconcolor);
        }

        if(_iconbgcolor!=""){
            $(this).find('.cq-vectorcard-icon').css('background-color', _iconbgcolor);
        }

     //    if(_iconsize!=""){
    	// 	$(this).find('.cq-videocover-icon, .cq-videocover-label').css({
    	// 		'font-size': _iconsize
    	// 	});
    	// }
    	// if(_iconbgsize!=""){
    	// 	_iconbgsize == parseInt(_iconbgsize) + 'px';
    	// 	$(this).find('.cq-videocover-iconcontainer').css({
    	// 		'width': _iconbgsize,
    	// 		'height': _iconbgsize
    	// 	});
    	// 	$(this).find('.cq-videocover-icon, .cq-videocover-label').css({
    	// 		'line-height': _iconbgsize
    	// 	})
    	// }

    	// if(_iconcolor!=""){
    	// 	$(this).find('.cq-videocover-icon, .cq-videocover-label').css({
    	// 		'color': _iconcolor
    	// 	});
    	// }
    	// if(_iconbgcolor!=""){
    	// 	$(this).find('.cq-videocover-iconcontainer').css({
    	// 		'background-color': _iconbgcolor
    	// 	});
    	// }


    });
});
