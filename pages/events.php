<!-- events.php -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/events.css">
<div class="slogan-wrapper">
	<div class="slogan"><?= htmlspecialchars(t('events.slogan')) ?></div>
</div>
<!-- Evènements privés -->
<section class="bloc-bordure-gauche">
	<section class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('events.private_title')) ?></h2>
			<p><?= htmlspecialchars(t('events.private_text')) ?></p>
			<p>
				<a href="<?= BASE_URL ?>/pages/private_booking.php" class="btn" target="_blank" rel="noopener"><?= htmlspecialchars(t('events.private_button')) ?></a>
			</p>
		</div>
		<div class="bloc-right">
			<a href="<?= BASE_URL ?>/assets/img/events_mariage2.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/events_mariage2.jpg" alt="<?= htmlspecialchars(t('events.private_img_alt')) ?>" class="img-thumb">
			</a>
			<a href="<?= BASE_URL ?>/assets/img/events_mariage2.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/events_mariage4.jpg" alt="<?= htmlspecialchars(t('events.private_img_alt')) ?>" class="img-thumb">
			</a>
		</div>
	</section>
	<?php require BASE_PATH.'/partials/private_events.php'; ?>
</section>
<!-- Evènements publics -->
<section class="bloc-bordure-gauche">
	<section class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('events.public_title')) ?></h2>
			<p><?= htmlspecialchars(t('events.public_text')) ?></p>
		</div>
		<div class="bloc-right">
			<a href="<?= BASE_URL ?>/assets/img/events8.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/events8.jpg" alt="<?= htmlspecialchars(t('events.public_img_alt')) ?>" class="img-thumb">
			</a>
			<a href="<?= BASE_URL ?>/assets/img/events7.jpg" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/events7.jpg" alt="<?= htmlspecialchars(t('events.public_img_alt')) ?>" class="img-thumb">
			</a>
		</div>
	</section>
	<?php require BASE_PATH.'/partials/public_events.php'; ?>
</section>