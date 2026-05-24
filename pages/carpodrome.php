<!-- CSS spécifique -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/rates.css">
<!-- Introduction -->
<div class="slogan-wrapper">
	<div class="slogan"><?= htmlspecialchars(t('carpodrome.slogan_1')) ?></div>
</div>
<img src="<?= BASE_URL ?>/assets/img/peche-famille.jpg" alt="<?= htmlspecialchars(t('carpodrome.img_family_alt')) ?>" class="img-default">
<div class="slogan-wrapper">
	<div class="slogan"><?= htmlspecialchars(t('carpodrome.slogan_2')) ?></div>
</div>
<!-- Présentation -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<?php
			$lang=$_SESSION['lang']??'fr';
			$file=BASE_PATH.'/lang/'.$lang.'/carpo-welcome.php';
			if(!is_readable($file)) $file=BASE_PATH.'/lang/fr/carpo-welcome.php';
			include $file;
		?>
	</div>
	<div class="bloc-right" style="flex-direction:column;align-items:flex-start;">
		<h2><?= htmlspecialchars(t('carpodrome.hours_title')) ?></h2>
		<p><?= htmlspecialchars((($CONFIG['carpodrome']['message'][$lang]??'')!=='')?($CONFIG['carpodrome']['message'][$lang]??''):($CONFIG['carpodrome']['message']['fr']??t('carpodrome.hours_intro'))) ?></p>
		<div class="structured-table-group">
			<table class="structured-table">
				<thead>
					<tr>
						<th colspan="2"><?= htmlspecialchars(t('carpodrome.hours_summer_title')) ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?= htmlspecialchars(t('carpodrome.hours_everyday')) ?></td>
						<td><?= htmlspecialchars(t('carpodrome.hours_summer_time')) ?></td>
					</tr>
				</tbody>
			</table>
			<table class="structured-table">
				<thead>
					<tr>
						<th colspan="2"><?= htmlspecialchars(t('carpodrome.hours_winter_title')) ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?= htmlspecialchars(t('carpodrome.hours_everyday')) ?></td>
						<td><?= htmlspecialchars(t('carpodrome.hours_winter_time')) ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!-- Loisirs  -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('carpodrome.leisure_title')) ?></h2>
		<p><?= nl2br(t('carpodrome.leisure_text')) ?></p>
	</div>
<div class="bloc-right">
		<a href="<?= BASE_URL ?>/assets/img/enfant_carpe.jpg" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/enfant_carpe.jpg" alt="<?= htmlspecialchars(t('carpodrome.flyer_alt')) ?>" class="img-thumb">
		</a>
		<a href="<?= BASE_URL ?>/assets/img/flyer_carpodrome.jpg" target="_blank" rel="noopener">
			<img src="<?= BASE_URL ?>/assets/img/flyer_carpodrome.jpg" alt="<?= htmlspecialchars(t('carpodrome.flyer_alt')) ?>" class="img-thumb">
		</a>

	</div>
</section>
<!-- Teambuilding -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('carpodrome.teambuilding_title')) ?></h2>
		<p><?= htmlspecialchars(t('carpodrome.teambuilding_text')) ?></p>
	</div>
	<div class="bloc-right">
		<a href="<?= BASE_URL ?>/assets/img/carpo_stands.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/carpo_stands.jpg" alt="<?= htmlspecialchars(t('carpodrome.img_stands_alt')) ?>" class="img-thumb"></a>
	</div>
</section>
<section class="bloc-bordure-gauche">
	<!-- Évènements -->
	<div class="bloc-2cols">
		<div class="bloc-left">
			<h2><?= htmlspecialchars(t('carpodrome.events_title')) ?></h2>
			<p><?= htmlspecialchars(t('carpodrome.events_text')) ?></p>
			<div class="bloc-action">
				<a href="<?= BASE_URL ?>/pages/carpo_booking.php" class="btn"><?= htmlspecialchars(t('carpodrome.events_btn')) ?></a>
			</div>
		</div>
		<div class="bloc-right">
			<img src="<?= BASE_URL ?>/assets/img/unsplash_concours_peche.avif" alt="<?= htmlspecialchars(t('carpodrome.img_events_alt')) ?>" class="img-stamp">
			<a href="<?= BASE_URL ?>/assets/img/carpo1.jpg" target="_blank" rel="noopener noreferrer"><img src="<?= BASE_URL ?>/assets/img/carpo1.jpg" alt="<?= htmlspecialchars(t('carpodrome.img_events_alt')) ?>" class="img-thumb"></a>
		</div>
	</div>
	<details class="bloc-collapsible">
		<summary class="bloc-collapsible-header">
			<span class="bloc-collapsible-headtext">
				<span class="bloc-collapsible-title">📅 <?= htmlspecialchars(t('carpodrome.calendar_title')) ?></span>
				<span class="bloc-collapsible-subtitle"><?= htmlspecialchars(t('carpodrome.calendar_subtitle')) ?></span>
			</span>
		</summary>
		<div class="bloc-collapsible-content">
			<div id="calendrier-peche" style="padding:0 .4rem;">
				<?php include BASE_PATH.'/partials/carpo_calendar.php'; ?>
			</div>
		</div>
	</details>
</section>
<!-- Tarifs -->
<section>
	<?php
	$ratesBloc=$RATES['carpodrome']??null;
	$ratesDisplay='carpodrome';
	require BASE_PATH.'/partials/rates_display.php';
	?>
</section>
<!-- Plan -->
<section class="bloc-card" style="text-align:center;">
	<p><strong><?= htmlspecialchars(t('carpodrome.map_text')) ?></strong></p>
	<a href="<?= BASE_URL ?>/assets/img/zones/carpodrome.jpg" target="_blank" rel="noopener">
		<img src="<?= BASE_URL ?>/assets/img/zones/carpodrome.jpg" alt="<?= htmlspecialchars(t('carpodrome.map_alt')) ?>" class="img-thumb">
	</a>
</section>
<!-- Règlement -->
<section class="bloc-2cols">
	<div class="bloc-left">
		<h2><?= htmlspecialchars(t('carpodrome.rules_title')) ?></h2>
		<p><?= htmlspecialchars(t('carpodrome.rules_text')) ?></p>
	</div>
	<div class="bloc-right">
		<p><?= htmlspecialchars(t('carpodrome.rules_pdf_text')) ?></p>
		<a href="<?= BASE_URL ?>/pages/carporules.php" class="btn" target="_blank" rel="noopener"><?= htmlspecialchars(t('carpodrome.rules_btn')) ?></a>
	</div>
</section>