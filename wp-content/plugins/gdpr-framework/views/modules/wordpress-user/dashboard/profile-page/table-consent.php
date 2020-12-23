<hr>
<?php if ($consentData): ?>
	<table class="gdpr-consent">
		<th colspan="2"><?= _x('Consents given', '(Admin)', 'gdpr-framework'); ?></th>
		<?php foreach ($consentData as $item): ?>
			<tr>
				<td>
					&#10004;
				</td>
				<td>
					<?= $item['title']; ?> Valid until <?= $item['valid_until']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
<?php else: ?>
	<p><?= _x('No consents given', '(Admin)', 'gdpr-framework'); ?>.</p>
<?php endif; ?>
