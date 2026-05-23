<!-- Introduction -->
<div class="slogan-wrapper">
	<div class="slogan"><?= htmlspecialchars(t('contact.slogan')) ?></div>
</div>
<!-- Coordonnées -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('contact.addresses_title')) ?></h2>
		<div><?= nl2br(htmlspecialchars(t('contact.address_loisirs'))) ?></div>
		<div style="height:1px;background:rgba(0,0,0,0.1);margin:8px 0;"></div>
		<div><?= nl2br(htmlspecialchars(t('contact.address_carpo'))) ?></div>
		<div style="height:1px;background:rgba(0,0,0,0.1);margin:8px 0;"></div>
		<div><?= nl2br(htmlspecialchars(t('contact.address_postal'))) ?></div>
	</div>
	<div class="bloc-right">
		<h2><?= htmlspecialchars(t('contact.title')) ?></h2>
		<p><strong><?= htmlspecialchars(t('contact.phone')) ?></strong> <a href="tel:+352691200220">+352 691 200 220</a></p>
		<p><strong><?= htmlspecialchars(t('contact.email')) ?></strong> <a href="mailto:info@baggerweier.lu">info@baggerweier.lu</a></p>
		<a href="<?= BASE_URL ?>/assets/img/flyer_contact.jpg" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/flyer_contact.jpg" alt="<?= htmlspecialchars(t('contact.flyer_alt')) ?>" class="img-stamp">
		</a>
		<p><strong><?= htmlspecialchars(t('contact.gps')) ?></strong><br>49°29'31.3"N 6°21'38.4"E<br>49.492023, 6.360655</p>
		<a class="btn" href="https://www.google.com/maps/search/?api=1&query=49.492022966802296,6.360654494607042" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars(t('buttons.google_maps')) ?></a>
	</div>
</section>
<!-- Carte -->
<section class="bloc-card">
	<iframe src="https://maps.google.com/maps?q=49.492022966802296,6.360654494607042&z=15&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="width:100%;min-height:420px;border:0;border-radius:12px;"></iframe>
</section>
<!-- Transports -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h3><?= htmlspecialchars(t('contact.public_transport_title')) ?></h3>
		<p><?= htmlspecialchars(t('contact.public_transport_text')) ?></p>
		<p><a href="https://www.mobiliteit.lu" target="_blank" rel="noopener" class="btn"><?= htmlspecialchars(t('buttons.timetables')) ?></a></p>
	</div>
	<div class="bloc-right">
		<a href="https://www.mobiliteit.lu" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/partners/mobiliteit.jpg" alt="<?= htmlspecialchars(t('contact.mobiliteit_alt')) ?>" class="img-stamp">
		</a>
	</div>
</section>