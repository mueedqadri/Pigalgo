jQuery(document).ready(function($) {
  $('.cq-material-card').each(function(index) {

      var _this = $(this);
      var _bordercolor = $(this).data('bordercolor');
      var _colorstyle = $(this).data('colorstyle');
      var _titlecolor = $(this).data('titlecolor');
      // var _linkcolor = $(this).data('linkcolor');
      var _contentcolor = $(this).data('contentcolor');
      var _isripple = $(this).data('isripple');
      var _cardwidth = $(this).data('cardwidth');
      var _titlemargin = $(this).data('titlemargin');

      if(_cardwidth!="") $(this).css('width', _cardwidth);

      if(_colorstyle!="customized"){
        _bordercolor = _colorstyle;
      }
      $(this).find('.material-card-title').css({
        'margin': _titlemargin,
        'color': _titlecolor
      });
      $(this).find('.material-card-content p').css({
        'color': _contentcolor
      });
      // $(this).find('.material-card-content .card-summary a').css({
        // 'color': _linkcolor
      // });

      // var _noripplelink = $(this).data('noripplelink') || '';

      if($(this).find('.material-card-label')[0]){
        $(this).find('.material-card-content p:last').css({
          'margin-bottom': '2em'
        });
      }

      if(_bordercolor!=""){
        $(this).find('.material-card-content').css({
          'border-top-color': _bordercolor
        });
        $(this).find('.material-card-label').css({
          'background-color': _bordercolor
        });
        // $(this).find('.card-author').css({
        //   'color': _bordercolor
        // });
      }
      $(this).find('.material-card-label-link').on('click', function(event) {
        // event.preventDefault();
        if(_isripple!="on"){
          // if(_noripplelink=="" || !$(this).hasClass(_noripplelink)){
            $(this).css({
                // 'position': 'relative',
                // 'display': 'inline-block'
              //   'overflow': 'hidden'
              });

              var _circlediv = $('<div/>'),
                  btnOffset = $(this).offset(),
                  xPos = event.pageX - btnOffset.left,
                  yPos = event.pageY - btnOffset.top;

              _circlediv
                .addClass('ripple-circle')
                .css({
                  'background-color': _bordercolor,
                  top: yPos - 32,
                  left: xPos - 32
                })
                .appendTo($(this));
                _circlediv.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd',function(e) {
                    $(this).remove();
                });

          // }
        }

     });

  });
});

