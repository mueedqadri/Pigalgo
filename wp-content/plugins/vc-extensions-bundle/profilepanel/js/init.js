jQuery(document).ready(function($) {
    $('.cq-profilepanel').each(function(index) {
        var _this = $(this);
        var _headerimage = $(this).data('headerimage');
        var _avatartype = $(this).data('avatartype');
        var _avatarimage = $(this).data('avatarimage');
        var _avatarposition = $(this).data('avatarposition');
        var _avataroffset = $(this).data('avataroffset');
        var _avatarsize = $(this).data('avatarsize') == "" ? 100 : parseInt($(this).data('avatarsize'));
        var _avatariconsize = $(this).data('avatariconsize');
        var _contentpadding = $(this).data('contentpadding');
        var _contentmargin = $(this).data('contentmargin');
        var _contentcolor = $(this).data('contentcolor');
        var _titlecolor = $(this).data('titlecolor');
        var _avatariconcolor = $(this).data('avatariconcolor');
        var _titlesize = $(this).data('titlesize');
        var _contentsize = $(this).data('contentsize');
        var _avatarbackgroundcolor = $(this).data('avatarbackgroundcolor');
        var _panelbackground = $(this).data('panelbackground');
        var _headerheight = $(this).data('headerheight') =="" ? _this.find('.cq-profilepanel-header').height() : $(this).data('headerheight');

        var _profileavatar = $(this).find('.cq-profilepanel-avatar');
        var _profileavatar2 = $(this).find('.cq-profilepanel-style2avatar');

        var _profileicon = $(this).find('.cq-profilepanel-icon');


        if(_titlesize!=""){
            $(this).find('.cq-profilepanel-text h3').css('font-size', _titlesize);
        }
        if(_contentsize!=""){
            $(this).find('.cq-profilepanel-text, .cq-profilepanel-text p').css('font-size', _contentsize);
        }

        if(_profileavatar2[0]){
            _profileavatar2.css({
                'width': _avatarsize,
                'height': _avatarsize
            });
            $('.cq-profilepanel-avatarcontainer', _this).css('top', (_headerheight - _avatarsize)*0.5);
            // $(this).find('.cq-profilepanel-style2title').css('line-height', _avatarsize+'px');
        }

        if(_profileavatar.attr('title')!=""){
            var _tooltip = _profileavatar.tooltipster({
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
        if(_profileavatar2.attr('title')!=""){
            var _tooltip2 = _profileavatar2.tooltipster({
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


        if(_panelbackground!=""){
            _this.css('background-color', _panelbackground);
            _this.find('.cq-profilepanel-avatar').css({
                'border-color': _panelbackground
            });
        }


        if(_headerimage!=""){
            _this.find('.cq-profilepanel-header').css({
                '-moz-background-size': 'cover',
                '-o-background-size': 'cover',
                'background-size': 'cover',
                '-webkit-background-size': 'cover',
                'background': 'url("' + _headerimage + '") no-repeat center center'
            });
        }

        if(_avatarbackgroundcolor!=""){
            _profileavatar.css('background-color', _avatarbackgroundcolor);
        }
        if(_avatariconcolor!=""){
            _profileicon.css('color', _avatariconcolor);
        }

        if(_contentpadding!=""){
            _this.find('.cq-profilepanel-text').css('padding', _contentpadding);
        }
        if(_contentmargin!=""){
            _this.find('.cq-profilepanel-text').css('margin', _contentmargin);
        }


        if(_contentcolor!=""){
            _this.find('.cq-profilepanel-text, .cq-profilepanel-text h3, .cq-profilepanel-text p').css('color', _contentcolor);
        }
        if(_titlecolor!=""){
            _this.find('.cq-profilepanel-style2title').css('color', _titlecolor);
        }

        if(_avatariconsize!=""){
            _profileicon.css({
                'font-size': _avatariconsize,
                'width': '100%',
                'text-align': 'center'
            });
        }


        if(_avataroffset!=""&&_avatarposition!="middle"){
            if(_avatarposition=="left"){
                _profileavatar.css({
                    'left': _avataroffset
                });
            }
            if(_avatarposition=="right"){
                _profileavatar.css({
                    'right': _avataroffset
                });
            }
        }

        if(_avatarsize!=""){
            _profileavatar.css({
                'top': _headerheight - _avatarsize*0.5,
                'width': _avatarsize,
                'height': _avatarsize
            });

            // _this.find('.cq-profilepanel-text').css({
            //     'margin-top': _avatarsize*0.5
            // });
            // _profileicon.css({
            //     // 'line-height': (_avatarsize - 5) + 'px'
            //     'line-height': '100%'
            // });
        }else{
            // _this.find('.cq-profilepanel-text').css({
                // 'margin-top': _profileavatar.width()*0.5 - _realcontentpaddding*0.5
            // });
        }

        if(_headerheight!=""){
            _this.find('.cq-profilepanel-header').css('height', _headerheight);
            _profileavatar.css('top', _headerheight - _profileavatar.height()*0.5);
        }

        // &&_avatartype=="image"
        if(_avatarimage!=""&&_avatartype=="image"){
            _profileavatar.css({
                // 'background-color': '#333',
                'background': 'url("' + _avatarimage + '") no-repeat center center',
                '-moz-background-size': 'cover',
                '-o-background-size': 'cover',
                'background-size': 'cover',
                '-webkit-background-size': 'cover'
                // 'background-size': '100px',
            });
            _profileavatar2.css({
                'background': 'url("' + _avatarimage + '") no-repeat center center',
                '-moz-background-size': 'cover',
                '-o-background-size': 'cover',
                'background-size': 'cover',
                '-webkit-background-size': 'cover'
                // 'background-size': '100px',
            });
        }


        // $(window).on('load resize', function(event) {
        //     var _width = $('.cq-profilepanel-style2', _this).width();
        //     console.log('width', _width);
        //     if(_width<=480){
        //         $('.cq-profilepanel-style2title', _this).css('font-size', '1.2em');
        //     }
        // });

    });


});
