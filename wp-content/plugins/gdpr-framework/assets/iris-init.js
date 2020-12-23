jQuery(document).ready(function($){

    $('.gdpr-color-picker').iris({
        hide: true,
        palettes: true
        });
    $(document).click(function (e) {
        if (!$(e.target).is(".gdpr-color-picker, .iris-picker, .iris-picker-inner")) {
            $('.gdpr-color-picker').iris('hide');
        }
    });
    $('.gdpr-color-picker').click(function (event) {
        $('.gdpr-color-picker').iris('hide');
        $(this).iris('show');
        return false;
    });

});
