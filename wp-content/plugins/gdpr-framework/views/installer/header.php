<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>
        <?php echo esc_html_x( 'WordPress GDPR &rsaquo; Setup Wizard', '(Admin)', 'gdpr-framework' ); ?>
    </title>
    <?php wp_print_scripts(['jquery']); ?>
    <?php do_action('admin_print_styles'); ?>
    <?php do_action('admin_head'); ?>
</head>

<body class="gdpr-installer wp-core-ui">

    <div class="container gdpr-installer-container">
        <div class="gdpr-header">
          <div class="gdpr-header_left">
            <img class="gdpr-logo" src="<?= gdpr('config')->get('plugin.url'); ?>/assets/gdpr-framework-logo.svg" />
          </div>
          <div class="gdpr-header_right">
            <h1>
              <?= esc_html_x('The GDPR Framework', '(Admin)', 'gdpr-framework'); ?>
            </h1>
            <a href="<?= gdpr('helpers')->docs('wordpress-site-owners-guide-to-gdpr/'); ?>" class="button button-secondary button-side" target="_blank">
              <?= esc_html_x('I need help', '(Admin)', 'gdpr-framework'); ?>
            </a>
            <a href="<?= gdpr('helpers')->docs('wordpress-gdpr-framework-developer-docs/'); ?>" class="button button-secondary button-side" target="_blank">
              <?= esc_html_x('Developer Docs', '(Admin)', 'gdpr-framework'); ?>
            </a>
          </div>
        </div>
        <div class="gdpr-breadcrumbs">
          <div class="gdpr-breadcrumbs_unit <?= $activeSteps > 0 ? 'active' : ''; ?>">
            <div class="gdpr-breadcrumbs_item">
              <?= esc_html_x('Configuration', '(Admin)', 'gdpr-framework'); ?>
            </div>
          </div>
          <div class="gdpr-breadcrumbs_unit <?= $activeSteps > 1 ? 'active' : ''; ?>">
            <div class="gdpr-breadcrumbs_item">
              <?= esc_html_x('Privacy Policy', '(Admin)', 'gdpr-framework'); ?>
            </div>
          </div>
          <div class="gdpr-breadcrumbs_unit <?= $activeSteps > 2 ? 'active' : ''; ?>">
            <div class="gdpr-breadcrumbs_item">
              <?= esc_html_x('Forms & Consent', '(Admin)', 'gdpr-framework'); ?>
            </div>
          </div>
          <div class="gdpr-breadcrumbs_unit <?= $activeSteps > 3 ? 'active' : ''; ?>">
            <div class="gdpr-breadcrumbs_item">
              <?= esc_html_x('Integrations', '(Admin)', 'gdpr-framework'); ?>
            </div>
          </div>
        </div>

        <div class="gdpr-content">

            <?php if (isset($_GET['gdpr-error'])): ?>
                <p class="error">Failed to validate nonce! Please reload page and try again.</p>
            <?php endif; ?>

            <!-- Open the installer form -->
            <form method="POST">
                <input type="hidden" name="gdpr-installer" value="next" />
