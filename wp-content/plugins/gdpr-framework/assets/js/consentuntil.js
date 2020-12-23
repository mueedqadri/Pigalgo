jQuery(function ($) {
	var calvisible = false;
	$('.gdpr-consent-until-cal').click(function(){
		if(calvisible == false){
			$('.gdpr-consent-until').css('opacity', 1);
			calvisible = true;
		}else{
			$('.gdpr-consent-until').css('opacity', 0);
			calvisible = false;
		}		
	});
	$('.gdpr-consent-until').change(function(){
		$('.gdpr-consent-until').css('opacity', 0);
		
	});
});