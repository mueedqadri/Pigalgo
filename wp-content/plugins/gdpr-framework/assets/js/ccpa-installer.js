jQuery(function ($) {

    /**
     * Init select2
     */
    $('.js-ccpa-select2').select2({
        width: 'style'
    });

    $('#tabs').tabs();

    $(".sortable").sortable();

    /**
     * https://github.com/DubFriend/jquery.repeater
     */
    $repeater = $('.js-ccpa-repeater');
    if ($repeater.length) {
        $repeater.repeater({
            ready: function (setIndexes) {
                $(".sortable").on('sortupdate', setIndexes);
            }
        });

        if (typeof window.ccpaConsentTypes !== undefined) {
            $repeater.setList(window.ccpaConsentTypes);
        }
    }

    /**
     * Auto-fill DPA info
     */
    $('.js-ccpa-country-selector').on('change', function () {
        var dpaData, $website, $email, $phone;
        var countryCode = $(this).val();

        if (!window.ccpaDpaData[countryCode]) {
            return;
        }

        dpaData = window.ccpaDpaData[countryCode];

        $website = $('#ccpa_dpa_website');
        if ('' === $website.data('set')) {
            $website.val(dpaData['website']);
        }

        $email = $('#ccpa_dpa_email');
        if ('' === $email.data('set')) {
            $email.val(dpaData['email']);
        }

        $phone = $('#ccpa_dpa_phone');
        if ('' === $phone.data('set')) {
            $phone.val(dpaData['phone']);
        }
    });
});
