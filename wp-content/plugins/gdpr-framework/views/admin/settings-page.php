<div class="wrap gdpr-framework-wrap">
	<h2>
		<?= esc_html_x('The GDPR Framework By Data443', '(Admin)', 'gdpr-framework'); ?>
	</h2>

	<?php if (!empty($_GET['updated'])) : ?>
		<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">
			<p><strong><?php _ex('GDPR settings saved!', '(Admin)', 'gdpr-framework') ?></strong></p>
		</div>
	<?php endif; ?>

	<?php if (count($tabs)): ?>
		<nav class="nav-tab-wrapper">
			<?php foreach ($tabs as $slug => $tab): ?>
				<a href="<?php echo esc_url( $tab['url'] ); ?>" class="nav-tab <?php echo $tab['slug'].' '; echo $tab['active'] ? 'nav-tab-active' : ''; ?>">
					<?php echo esc_html( $tab['title'] ); ?>
				</a>
			<?php endforeach; ?>
		</nav>
	<?php endif; ?>

	<form action="options.php" method="POST">
	  <?= $currentTabContents; ?>
	</form>

	<?php if ($signature): ?>
		<hr>
		<p>
			<em>
				<?= sprintf(
					esc_html_x('The GDPR Framework. Built with &#9829; by %sData443%s.', '(Admin)', 'gdpr-framework'),
					'<a href="https://www.data443.com/" target="_blank">',
						'</a>'
				); ?>
				 &nbsp;
				|
				&nbsp;
				<?= sprintf(
					esc_html_x("Need help? Take a look at our %sdocumentation%s.", '(Admin)', 'gdpr-framework'),
					'<a href="https://www.data443.com/wordpress-site-owners-guide-to-gdpr/" target="_blank">',
					'</a>'
				); ?>
				&nbsp;
				|
				&nbsp;
				<?= sprintf(
					esc_html_x("Support our development efforts! leave a %s5-star rating%s.", '(Admin)', 'gdpr-framework'),
					'<a href="https://wordpress.org/plugins/gdpr-framework/#reviews" target="_blank">',
					'</a>'
				); ?>
			</em>
		</p>
	<?php endif; ?>
</div>
