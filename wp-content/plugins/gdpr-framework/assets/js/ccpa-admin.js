jQuery(function ($) {
  /**
   * requried issue on Consent show repeater
   */
  $(document).on("click", ".show_form_consent_ccpa", function (e) {
    $(".ccpa-hidden input").prop("disabled", false);
    $(".ccpa-hidden").removeClass("ccpa-hidden");
    $(".show_form_consent_ccpa").hide();
  });
  /**
   * requried issue on Consent hide repeater
   */

  $(document).on("click", ".hide_form_consent_ccpa", function (e) {
    $(".ccpa-show-hide").addClass("ccpa-hidden");
    $(".ccpa-hidden input").prop("disabled", true);
    $(".show_form_consent_ccpa").show();
  });
  /**
   * Fix issue with more then one consent add.
   */
  $(document).ready(function () {
    $(".ccpa-hidden input").prop("disabled", true);
  });
  // Handler to open the modal dialog
  $(document).on("click", ".ccpa-open-modal", function (e) {
    $($(this).data("ccpa-modal-target")).dialog("open");
    e.preventDefault();
  });

  // Initialize all modals on page
  $(".ccpa-modal").each(function (i, e) {
    var $base = $(this);

    $base.dialog({
      title: $base.data("ccpa-title"),
      dialogClass: "wp-dialog",
      autoOpen: false,
      draggable: false,
      width: "auto",
      modal: true,
      resizable: false,
      closeOnEscape: true,
      position: {
        my: "center",
        at: "center",
        of: window
      },
      create: function () {
        // style fix for WordPress admin
        $(".ui-dialog-titlebar-close").addClass("ui-button");
      },
      open: function () {
        // Bind a click on the overlay to close the dialog
        $(".ui-widget-overlay").bind("click", function () {
          $base.dialog("close");
        });

        // Bind a custom close button to close the dialog
        $base.find(".ccpa-close-modal").bind("click", function (e) {
          $base.dialog("close");
          e.preventDefault();
        });

        // Fix overlay CSS issues in admin
        $(".wp-dialog").css("z-index", 9999);
        $(".ui-widget-overlay").css("z-index", 9998);
      },
      close: function () {
        $(".wp-dialog").css("z-index", 101);
        $(".ui-widget-overlay").css("z-index", 100);
      }
    });
  });

  /**
   * https://github.com/DubFriend/jquery.repeater
   */
  $(".js-ccpa-repeater").each(function () {
    var $repeater = $(this).repeater({
      isFirstItemUndeletable: true
    });
    if (window.repeaterData != undefined) {
      // will only work if repeater data is defined.
      if (typeof window.repeaterData[$(this).data("name")] !== undefined) {
        $repeater.setList(window.repeaterData[$(this).data("name")]);
      }
    }
  });

  /**
   * Init select2
   */
  $(".js-ccpa-select2").select2({
    width: "style"
  });

  /**
   * Auto-fill DPA info
   */
  $(".js-ccpa-country-selector").on("change", function () {
    var dpaData, $website, $email, $phone;
    var countryCode = $(this).val();

    if (!window.ccpaDpaData[countryCode]) {
      return;
    }

    dpaData = window.ccpaDpaData[countryCode];

    $website = $("#ccpa_dpa_website");
    if ("" === $website.data("set")) {
      $website.val(dpaData["website"]);
    }

    $email = $("#ccpa_dpa_email");
    if ("" === $email.data("set")) {
      $email.val(dpaData["email"]);
    }

    $phone = $("#ccpa_dpa_phone");
    if ("" === $phone.data("set")) {
      $phone.val(dpaData["phone"]);
    }
  });
});
