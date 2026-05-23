<!-- home.php -->
<!-- CSS spécifiques -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/home.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/rates.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/contact.css">
<!-- Hero -->
<section class="hero" style="background-image:url('<?= BASE_URL ?>/assets/img/blue_mirror_banner.jpg');">
	<!--<h1><?= htmlspecialchars(t('home.hero_title')) ?></h1>-->
</section>
<section class="bloc-card">
	<!-- Information du jour -->
	<div class="bloc-card">
		<div class="home-info-title"><?= htmlspecialchars(t('home.info_title')) ?></div>
		<div class="home-info-text"><?= htmlspecialchars((($CONFIG['info_du_jour'][$lang] ?? '') !== '' ? ($CONFIG['info_du_jour'][$lang] ?? '') : ($CONFIG['info_du_jour']['fr'] ?? ''))) ?></div>
	</div>
	<!-- Statuts -->
	<div id="statuts" class="bloc-2cols statuts-layout">
		<div class="bloc-left">
			<div class="indicateur">
				<?php $carpoOpen=(($CONFIG['carpodrome']['statut']??'ferme')==='ouvert'); ?>
				<div class="statut-icon" style="color:<?= $carpoOpen ? '#28a745' : '#dc3545' ?>;"><?= $carpoOpen ? '✅' : '❌' ?></div>
				<div class="statut-text"><?= htmlspecialchars(t('home.carpodrome_label')) ?> : <?= htmlspecialchars($carpoOpen ? t('home.open') : t('home.closed')) ?></div>
				<div class="statut-message"><?= htmlspecialchars((($CONFIG['carpodrome']['message'][$lang]??'')!=='')?($CONFIG['carpodrome']['message'][$lang]??''):($CONFIG['carpodrome']['message']['fr']??'')) ?></div>
			</div>
		</div>
		<div class="bloc-right">
			<div class="indicateur">
				<?php $loisirsOpen=(($CONFIG['loisirs']['statut']??'ferme')==='ouvert'); ?>
				<div class="statut-icon" style="color:<?= $loisirsOpen ? '#28a745' : '#dc3545' ?>;"><?= $loisirsOpen ? '✅' : '❌' ?></div>
				<div class="statut-text"><?= htmlspecialchars(t('home.loisirs_label')) ?> : <?= htmlspecialchars($loisirsOpen ? t('home.open') : t('home.closed')) ?></div>
				<div class="statut-message"><?= htmlspecialchars((($CONFIG['loisirs']['message'][$lang]??'')!=='')?($CONFIG['loisirs']['message'][$lang]??''):($CONFIG['loisirs']['message']['fr']??'')) ?></div>
			</div>
			<div class="temperature">
				<div class="home-info-title temperature-title"><?= htmlspecialchars(t('home.temperature')) ?></div>
				<div class="home-info-text temperature-value"><?= htmlspecialchars($CONFIG['temperature'] ?? '') ?></div>
			</div>
		</div>
	</div>
	<!-- Boutons -->
	<div class="bloc-2cols statuts-layout" style="box-shadow:none;">
		<div class="bloc-left">
			<a href="<?= BASE_URL ?>/?page=carpodrome" class="btn"><?= htmlspecialchars(t('home.carpodrome_button')) ?></a>
		</div>
		<div class="bloc-right">
			<a href="<?= BASE_URL ?>/?page=loisirs" class="btn"><?= htmlspecialchars(t('home.loisirs_button')) ?></a>
		</div>
	</div>
</section>
<!-- Tarifs -->
<div class="tickets-page">
	<section class="bloc-2cols">
		<div class="bloc-left">
<?php
			$ratesBloc=$RATES['carpodrome'] ?? null;
			$ratesDisplay='home';
			require BASE_PATH . '/partials/rates_display.php';
?>
		</div>
		<div class="bloc-right">
<?php
			$ratesBloc=$RATES['loisirs'] ?? null;
			$ratesDisplay='home';
			require BASE_PATH . '/partials/rates_display.php';
?>
		</div>
	</section>
	<p style="text-align:center;margin-top:30px;">
		<a href="<?= BASE_URL ?>/pages/rates_flyer.php" target="_blank" rel="noopener noreferrer" class="btn"><?= htmlspecialchars(t('home.all_rates_button')) ?></a>
	</p>
</div>
<!-- Billetterie -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h3><?= htmlspecialchars(t('home.ticketing_title')) ?></h3>
		<p><?= htmlspecialchars(t('home.ticketing_text')) ?></p>
		<a href="https://baggerweier.regiondo.fr/categories" target="_blank" rel="noopener noreferrer" class="btn"><?= htmlspecialchars(t('home.ticketing_button')) ?></a>
	</div>
	<div class="bloc-right">
		<img src="<?= BASE_URL ?>/assets/img/billetterie.jpg" alt="<?= htmlspecialchars(t('home.ticketing_img_alt')) ?>" class="img-stamp">
	</div>
</section>
<!-- Météo -->
<section class="meteo">
	<h2><?= htmlspecialchars(t('home.weather')) ?></h2>
	<a class="weatherwidget-io" href="https://forecast7.com/de/49d496d35/remerschen/" data-label_1="REMERSCHEN" data-label_2="Wetter" data-font="Roboto" data-icons="Climacons Animated" data-theme="pure">REMERSCHEN</a>
</section>
<!-- Contact -->
<section class="bloc-card">
	<h2><?= htmlspecialchars(t('contact.title')) ?></h2>
	<div class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('contact.addresses_title')) ?></h2>
			<p><?= nl2br(htmlspecialchars(t('contact.address_loisirs'))) ?></p>
		</div>
		<div class="bloc-right">
			<p><strong><?= htmlspecialchars(t('contact.phone')) ?></strong> <a href="tel:+352691200220">+352 691 200 220</a></p>
			<p><strong><?= htmlspecialchars(t('contact.email')) ?></strong> <a href="mailto:info@baggerweier.lu">info@baggerweier.lu</a></p>
			<p>
				<a class="btn" href="https://www.google.com/maps/search/?api=1&query=49.492022966802296,6.360654494607042" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars(t('buttons.google_maps')) ?></a>
			</p>
		</div>
	</div>
</section>