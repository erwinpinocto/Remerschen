<?php
/* Bootstrap */
require __DIR__ . '/../bootstrap.php';
?>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/docs.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/rates.css">
<div class="doc-wrapper">
	<div class="doc-container">
		<header class="doc-header">
			<div class="doc-header-logo">
				<img src="<?= BASE_URL ?>/assets/img/logo.jpg" alt="Logo Erliefnis Baggerweier">
			</div>
			<div class="doc-header-title">
				<h1><?= htmlspecialchars(t('rates.doc.title')) ?></h1>
				<div class="version"><?= htmlspecialchars(t('rates.doc.subtitle')) ?></div>
			</div>
		</header>
		<section class="doc-section">
			<p class="article-text"><?= htmlspecialchars(t('rates.doc.intro')) ?></p>
		</section>
		<section class="doc-section">
			<h2>1. <?= htmlspecialchars(t('rates.carpo.title')) ?></h2>
			<div class="doc-rates">
				<?php
				$ratesDisplay='flyer';
				$ratesBloc=$RATES['carpodrome']??null;
				require BASE_PATH.'/partials/rates_display.php';
				?>
			</div>
		</section>
		<section class="doc-section">
			<h2>2. <?= htmlspecialchars(t('rates.loisirs.title')) ?></h2>
			<div class="doc-rates">
				<?php
				$ratesBloc=$RATES['loisirs']??null;
				require BASE_PATH.'/partials/rates_display.php';
				?>
			</div>
		</section>
		<section class="doc-section">
			<h2>3. <?= htmlspecialchars(t('rates.doc.events_title')) ?></h2>
			<p class="article-text"><?= htmlspecialchars(t('rates.doc.events_text')) ?></p>
		</section>
		<div class="print-actions no-print">
			<button class="btn-back" onclick="window.location.href='<?= BASE_URL ?>/'">⬅️ <?= htmlspecialchars(t('buttons.back')) ?></button>
			<button class="btn-print" onclick="window.print()">🖨️ <?= htmlspecialchars(t('buttons.print')) ?></button>
		</div>
	</div>
</div>