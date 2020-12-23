window.addEventListener("load", function () {
  if (ccpa_policy_page.ccpa_url) {
    if (ccpa_policy_page.ccpa_popup) {
      var layoutcheck = 'ccpa-cool-layout';
    } else {
      var layoutcheck = 'ccpa-cool-layout-wlink';
    }
  } else {
    var layoutcheck = 'ccpa-cool-layout-wlink';
  }
  window.cookieconsent.initialise({
    layout: layoutcheck,
    layouts: {
      'ccpa-cool-layout': '{{header}}{{message}}{{link}}{{compliance}}<span aria-label="dismiss cookie message" role="button" tabindex="0" class="ccpa-close"><span class="emoji ccpa-close-popup  cc-close">&#10005;</span></span>',
      'ccpa-cool-layout-wlink': '{{header}}{{message}}{{compliance}}<span aria-label="dismiss cookie message" role="button" tabindex="0" class="ccpa-close"><span class="emoji ccpa-close-popup cc-close">&#10005;</span></span>',
    },
    "palette": {
      "popup": {
        "background": ccpa_policy_page.ccpa_popup_background,
        "text": ccpa_policy_page.ccpa_popup_text
      },
      "button": {
        "background": ccpa_policy_page.ccpa_button_background,
        "text": ccpa_policy_page.ccpa_button_text,
        "border": ccpa_policy_page.ccpa_button_border
      }
    }, 
    "position": ccpa_policy_page.ccpa_popup_position,
    "static": ccpa_policy_page.ccpa_popup_static,
    "theme": ccpa_policy_page.ccpa_popup_theme,
    "type": ccpa_policy_page.ccpa_popup_type,
    "content": {
      "header": ccpa_policy_page.ccpa_header, //"Cookies used on the website!"
      "message": ccpa_policy_page.ccpa_message,
      "href": ccpa_policy_page.ccpa_url,
      "link": ccpa_policy_page.ccpa_link,
      "deny": ccpa_policy_page.ccpa_dismiss,
      "allow": ccpa_policy_page.ccpa_allow,
      "policy": ccpa_policy_page.policy,
      "target": ccpa_policy_page.ccpa_link_target,
    },
    onStatusChange: function (status, chosenBefore) {
      if (chosenBefore == 'false' || status == "allow") {
        jQuery(document).ready(function ($) {
          $.getJSON('https://api.ipify.org?format=json', function (data) {
            $.ajax({
              url: ccpa_policy_page.ajaxurl,
              type: 'POST',
              data: {
                action: 'CCPA_add_consent_accept_cookies',
                userip: data.ip
              },
              success: function (data) {
                $('.cc-close').click();
                if (ccpa_policy_page.ccpa_hide) {
                  $(".cc-revoke").hide();
                }
              }
            });
          });
        });
      } else if (chosenBefore == 'false' || status == "deny") {
        jQuery(document).ready(function ($) {
          $.getJSON('https://api.ipify.org?format=json', function (data) {
            $.ajax({
              url: ccpa_policy_page.ajaxurl,
              type: 'POST',
              data: {
                action: 'CCPA_add_consent_deny_cookies',
                userip: data.ip
              },
              success: function (data) {
                $('.cc-close').click();
                if (ccpa_policy_page.ccpa_hide) {
                  $(".cc-revoke").hide();
                }
              }
            });
          });
        });
      }
    }
  })
});
