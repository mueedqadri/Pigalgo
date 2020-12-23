jQuery(document).ready(function($) {
	function _reiszeImage(){
		$('.card-image').each(function() {
			var maxWidth = $(this).data('maxwidth');
			var maxHeight = $(this).data('maxheight');
			var _mratio = maxWidth/maxHeight;
			var _imageContainer = $(this);
			$(this).find('img').each(function(index) {
				var ratio = $(this).data('ratio');
		        var width = $(this).data('width');
		        var height = $(this).data('height');
		        if(ratio<_mratio){
		        	// _imageContainer.css('width', maxWidth);
		        	// _imageContainer.css({
		        	// 	'width': maxWidth
		        	// });
		            $(this).css("min-height", maxHeight);
		        }

		        // Check if current height is larger than max
		        if(ratio>=_mratio){
		            // _imageContainer.css({
		            // 	'width': maxHeight*ratio
		            // });
		            // $(this).css("width", maxHeight*ratio);
		            $(this).css("min-width", maxWidth);
		        }



			});
	    });
	}

	$('.cq-cards-container').each(function(index) {
		var _this = $(this);
		var _imageposition = $(this).data('imageposition');
		var _backgroundcolor = $(this).data('backgroundcolor');
		var _captioncolor = $(this).data('captioncolor');
		var _buttonbg = $(this).data('buttonbg');
		var _buttonhoverbg = $(this).data('buttonhoverbg');
		var _minheight = $(this).data('minheight') || 160;
		var _smallheight = $(this).data('smallheight') || 100;
		var _autoplayspeed = $(this).data('autoplayspeed') || 4000;
		var _titlesize = $(this).data('titlesize') || '1.2em';
		_this.css({
			'background-color': _backgroundcolor,
			'color': _captioncolor
		});
		_this.find('h3').css({
			'color': _captioncolor,
			'font-size': _titlesize
		});;
		$('.card-image-container', _this).css({
			'height': _minheight
		});
		if(_buttonbg!=""){
			var _buttons = $('.card-caption-container .cq-button', _this);
			_buttons.css('background-color', _buttonbg);
			_buttons.on('mouseover', function(event) {
				$(this).css('background-color', _buttonhoverbg);
			}).on('mouseleave', function(event) {
				$(this).css('background-color', _buttonbg);
			});

		}
		var _carousel = $('.card-image', _this).slick({
			arrow: false,
			dots: false,
		    slidesToShow: 1,
		    autoplay: true,
		    autoplaySpeed: _autoplayspeed,
		    slidesToScroll: 1,
		    infinite: false,
		    arrows: false
		});
		var _index = index;
		_this.find('a.cq-thumb-lightbox').each(function(index) {
				$(this).attr('rel', 'cq-gallery'+_index).boxer({
					fixed : true
		   		});
		});
		$(window).on('resize', function(event) {
			var _w = $(this).width();
			if(_w<=480){
				// $('.card-image-container, .card-caption-container', _this).css({
				// 	'height': _smallheight
				// });
			}else{
				if(_imageposition!="top"&&_imageposition!="bottom"){
				var _containerheight = $('.card-image-container', _this).height();
				var _captionheight = $('.card-caption-container', _this).height();
					$('.card-caption-container', _this).css('margin-top', (_containerheight - _captionheight)*0.5);
				}

			}

			// var _cwidth = $('.caption-content', _this).outerWidth();
			// var _cheight = $('.caption-content', _this).outerHeight();
			// var _w = $(this).width();
			// if(_w>=768){
			// 	// $('.card-caption-container', _this).css({
			// 	// 	'min-height': _cheight
			// 	// });

			// }else{
			// 	$('.card-caption-container', _this).css({
			// 		'height': _cheight
			// 	});
			// 	$('.card-image-container', _this).css({
			// 		'height': _cheight
			// 	})
			// }
			// $('.card-image').data('maxwidth', _cwidth);
			// $('.card-image').data('maxheight', _cheight);
			// $('.card-image-container', _this).css({
			// 	'height': _cheight
			// });
			// if(!$('.card-image-container', _this).hasClass('top')){
				// $('.card-image').css({
				// 	'width': _cwidth
				// 	// 'height': _cheight
				// });;
				// $('.cq-link-block').css('height', _cheight)
				// _reiszeImage();
			// }
			// _reiszeImage();

		});
		$(window).trigger('resize');

	});

});
