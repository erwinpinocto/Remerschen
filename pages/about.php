<!-- about.php -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/about.css">
<!-- Histoire -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('about.history_title')) ?></h2>
		<p><?= t('about.history_text') ?></p>
	</div>
	<div class="bloc-right">
		<a href="<?= BASE_URL ?>/assets/img/baggerweieren.jpg" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/baggerweieren.jpg" alt="<?= htmlspecialchars(t('about.history_img_alt')) ?>" class="img-thumb">
		</a>
	</div>
</section>
<!-- Ateliers -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('about.workshops_title')) ?></h2>
		<p><?= nl2br(htmlspecialchars(t('about.workshops_text'))) ?></p>
		<a href="<?= BASE_URL ?>/?page=ateliers" class="btn"><?= htmlspecialchars(t('about.workshops_button')) ?></a>
	</div>
	<div class="bloc-right">
		<a href="<?= BASE_URL ?>/assets/img/flyer_ateliers_1.jpg" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/flyer_ateliers_1.jpg" alt="<?= htmlspecialchars(t('about.workshops_img_alt')) ?>" class="img-thumb">
		</a>
	</div>
</section>