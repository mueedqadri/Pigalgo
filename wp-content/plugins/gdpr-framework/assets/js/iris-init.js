jQuery(document).ready(function ($) {

    $('.ccpa-color-picker').iris({
        hide: true,
        palettes: true
    });
    $(document).click(function (e) {
        if (!$(e.target).is(".ccpa-color-picker, .iris-picker, .iris-picker-inner")) {
            $('.ccpa-color-picker').iris('hide');
        }
    });
    $('.ccpa-color-picker').click(function (event) {
        $('.ccpa-color-picker').iris('hide');
        $(this).iris('show');
        return false;
    });

});
