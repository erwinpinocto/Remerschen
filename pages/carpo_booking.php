<?php
require __DIR__.'/../bootstrap.php';
?><!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars(t('forms.common.event_title')) ?></title>
	<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/docs.css">
</head>
<body>
	<div class="doc-wrapper">
		<div class="doc-container">
			<header class="doc-header">
				<div class="doc-header-logo">
					<img src="<?= BASE_URL ?>/assets/img/logo.jpg" alt="<?= htmlspecialchars(t('logo_alt')) ?>">
				</div>
				<div class="doc-header-title">
					<h1><?= htmlspecialchars(t('forms.common.event_title')) ?></h1>
				</div>
			</header>
			<form class="doc-form">
				<section id="participant">
					<h2><?= htmlspecialchars(t('forms.common.contact_name')) ?></h2>
					<label><?= htmlspecialchars(t('forms.common.last_name')) ?></label>
					<input type="text" name="last_name">
					<label><?= htmlspecialchars(t('forms.common.first_name')) ?></label>
					<input type="text" name="first_name">
					<label><?= htmlspecialchars(t('forms.common.email')) ?></label>
					<input type="email" name="email">
					<label><?= htmlspecialchars(t('forms.common.phone')) ?></label>
					<input type="text" name="phone">
				</section>
				<section id="event">
					<h2><?= htmlspecialchars(t('forms.common.event')) ?></h2>
					<label><?= htmlspecialchars(t('forms.common.event_name')) ?></label>
					<input type="text" name="event_name">
					<label><?= htmlspecialchars(t('forms.common.date')) ?></label>
					<input type="date" name="event_date">
				</section>
				<section id="participants">
					<h2><?= htmlspecialchars(t('forms.common.participants')) ?></h2>
					<div class="grid-2">
						<label><?= htmlspecialchars(t('forms.common.nb_adults')) ?><input type="number" name="participants_adults" min="0" value="1"></label>
						<label><?= htmlspecialchars(t('forms.common.nb_children')) ?><input type="number" name="participants_children" min="0" value="0"></label>
					</div>
				</section>
				<section id="needs">
					<h2><?= htmlspecialchars(t('forms.common.needs')) ?></h2>
					<textarea name="special_needs" placeholder="<?= htmlspecialchars(t('forms.common.needs_placeholder')) ?>"></textarea>
				</section>
				<section id="confirmation">
					<h2><?= htmlspecialchars(t('forms.common.confirmation')) ?></h2>
					<label><input type="checkbox" name="terms"><?= htmlspecialchars(t('forms.common.confirmation_txt')) ?></label>
				</section>
				<div class="print-actions no-print">
					<button type="button" onclick="window.location.href='<?= BASE_URL ?>/?page=events'">⬅️ <?= htmlspecialchars(t('buttons.back')) ?></button>
					<button type="button" onclick="window.print()">🖨️ <?= htmlspecialchars(t('buttons.print')) ?></button>
				</div>
			</form>
		</div>
	</div>
</body>
</html>