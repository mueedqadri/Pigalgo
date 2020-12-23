jQuery(document).ready(function($) {
    $('.cq-newsblock').each(function(index) {
        var _this = $(this);
        var _isloop = _this.data('isloop') == "yes" ? true : false;
        // var _titlecolor = _this.data('titlecolor');
        // var _contentcolor = _this.data('contentcolor');
        // var _labelcolor = _this.data('labelcolor');
        var _hoverdisable = _this.data('hoverdisable') == "yes" ? true : false;
        var _autodelay = parseInt(_this.data('autodelay'), 10);
        var _autodelayObj;
        if(_autodelay > 0){
            _autodelayObj = {
                delay: _autodelay*1000,
                disableOnInteraction: _hoverdisable,
            }
        }else{
            _autodelayObj = false;
        }

        // if(_titlecolor != ""){
        //     $('.cq-newsblock-title', _this).css('color', _titlecolor);
        // }
        // if(_contentcolor != ""){
        //     $('.cq-newsblock-content', _this).css('color', _titlecolor);
        // }
        // if(_labelcolor != ""){
        //     $('.cq-newsblock-label', _this).css('color', _titlecolor);
        // }

        var swiper = new Swiper(_this,  {
          direction: 'vertical',
          loop: _isloop,
          // pagination: {
          //   el: '.cq-newsblock-pagination',
          //   clickable: true,
          // },
          autoHeight: true,
          spaceBetween: 80,
          autoplay: _autodelayObj,
          navigation: {
            nextEl: $('.cq-newsblock-btnnext', _this),
            prevEl: $('.cq-newsblock-btnprev', _this),
          },
        });


    });

});
