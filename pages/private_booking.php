<?php
require __DIR__ . '/../bootstrap.php';
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
				<section id="organizer">
					<h2><?= htmlspecialchars(t('forms.common.organizer')) ?></h2>
					<label><?= htmlspecialchars(t('forms.common.institution')) ?></label>
					<input type="text" name="institution">
					<label><?= htmlspecialchars(t('forms.common.contact_name')) ?></label>
					<input type="text" name="contact_name">
					<label><?= htmlspecialchars(t('forms.common.address')) ?></label>
					<input type="text" name="address">
					<label><?= htmlspecialchars(t('forms.common.postal_code')) ?></label>
					<input type="text" name="postal_code">
					<label><?= htmlspecialchars(t('forms.common.city')) ?></label>
					<input type="text" name="city">
					<label><?= htmlspecialchars(t('forms.common.phone')) ?></label>
					<input type="text" name="phone">
					<label><?= htmlspecialchars(t('forms.common.email')) ?></label>
					<input type="text" name="email">
				</section>
				<section id="event">
					<h2><?= htmlspecialchars(t('forms.common.event')) ?></h2>
					<div class="grid-3">
						<div>
							<label><?= htmlspecialchars(t('forms.common.date')) ?></label>
							<input type="text" name="event_date">
						</div>
						<div>
							<label><?= htmlspecialchars(t('forms.common.start_time')) ?></label>
							<input type="text" name="start_time">
						</div>
						<div>
							<label><?= htmlspecialchars(t('forms.common.end_time')) ?></label>
							<input type="text" name="end_time">
						</div>
					</div>
					<div class="grid-2">
						<div>
							<label><?= htmlspecialchars(t('forms.common.nb_children')) ?></label>
							<input type="text" name="participants_children">
						</div>
						<div>
							<label><?= htmlspecialchars(t('forms.common.nb_adults')) ?></label>
							<input type="text" name="participants_adults">
						</div>
					</div>
					<h3><?= htmlspecialchars(t('forms.common.evt_types.title')) ?></h3>
					<div class="grid-2">
						<label><input type="checkbox" name="event_type[]" value="family_event"><?= htmlspecialchars(t('forms.common.evt_types.family')) ?></label>
						<label><input type="checkbox" name="event_type[]" value="company_seminar"><?= htmlspecialchars(t('forms.common.evt_types.corporate')) ?></label>
						<label><input type="checkbox" name="event_type[]" value="sports_event"><?= htmlspecialchars(t('forms.common.evt_types.sports')) ?></label>
						<label><input type="checkbox" name="event_type[]" value="guided_visit"><?= htmlspecialchars(t('forms.common.evt_types.visit')) ?></label>
						<label><?= htmlspecialchars(t('forms.common.other')) ?></label>
						<label><input type="checkbox" name="event_type[]" value="other"></label>
					</div>
					<input type="text" name="event_type_other">
				</section>
				<section id="services">
					<h2><?= htmlspecialchars(t('forms.common.services')) ?></h2>
					<h3><?= htmlspecialchars(t('forms.common.sales.title')) ?></h3>
					<div class="grid-2">
						<label><?= htmlspecialchars(t('forms.common.sales.armbands1')) ?><input type="text" name="armbands_small"></label>
						<label><?= htmlspecialchars(t('forms.common.sales.armbands2')) ?><input type="text" name="armbands_large"></label>
					</div>
					<h3><?= htmlspecialchars(t('forms.common.rentals.title')) ?></h3>
					<div class="grid-2">
						<label><?= htmlspecialchars(t('forms.common.rentals.sup')) ?><input type="text" name="sup_whaly"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.sup_pmr')) ?><input type="text" name="sup_accessible"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.pedalo')) ?><input type="text" name="pedalo"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.boat')) ?><input type="text" name="boat"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.parasol')) ?><input type="text" name="parasol"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.transat')) ?><input type="text" name="deckchair"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.volley')) ?><input type="text" name="beach_volleyball"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.soccer')) ?><input type="text" name="beach_soccer"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.hippocampe')) ?><input type="text" name="hippocampe"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.pagoda')) ?><input type="text" name="pagoda"></label>
					</div>
					<div class="grid-2">
						<label><?= htmlspecialchars(t('forms.common.rentals.bbq')) ?><input type="text" name="bbq_count"></label>
						<label><?= htmlspecialchars(t('forms.common.rentals.charcoal')) ?><input type="text" name="charcoal_extra"></label>
					</div>
					<h3><?= htmlspecialchars(t('forms.common.connections.title')) ?></h3>
					<div class="grid-2">
						<label><input type="checkbox" name="water"><?= htmlspecialchars(t('forms.common.connections.water')) ?></label>
						<label><input type="checkbox" name="electricity"><?= htmlspecialchars(t('forms.common.connections.electricity')) ?></label>
						<label><input type="checkbox" name="extension_cable"><?= htmlspecialchars(t('forms.common.connections.cable')) ?></label>
						<label><input type="checkbox" name="power_distributor"><?= htmlspecialchars(t('forms.common.connections.power')) ?></label>
					</div>
				</section>
				<section id="catering">
					<h2><?= htmlspecialchars(t('forms.common.catering')) ?></h2>
					<h3><?= htmlspecialchars(t('forms.common.drinks.title')) ?></h3>
					<div class="grid-3">
						<label><?= htmlspecialchars(t('forms.common.drinks.water')) ?><input type="text" name="drink_water"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.coca_z')) ?><input type="text" name="drink_coca_zero"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.coca')) ?><input type="text" name="drink_coca"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.fanta')) ?><input type="text" name="drink_fanta"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.icetea')) ?><input type="text" name="drink_ice_tea"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.minute_maid')) ?><input type="text" name="drink_minute_maid"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.redbull')) ?><input type="text" name="drink_redbull"></label>
						<label><?= htmlspecialchars(t('forms.common.drinks.beer')) ?><input type="text" name="drink_beer"></label>
					</div>
					<h3><?= htmlspecialchars(t('forms.common.icecreams.title')) ?></h3>
					<div class="grid-3">
						<label><?= htmlspecialchars(t('forms.common.icecreams.choco')) ?><input type="text" name="icecream_cone_chocolate"></label>
						<label><?= htmlspecialchars(t('forms.common.icecreams.strawberry')) ?><input type="text" name="icecream_cone_strawberry"></label>
						<label><?= htmlspecialchars(t('forms.common.icecreams.vanilla')) ?><input type="text" name="icecream_cone_vanilla"></label>
						<label><?= htmlspecialchars(t('forms.common.icecreams.minivanilla')) ?><input type="text" name="icecream_mini_vanilla"></label>
						<label><?= htmlspecialchars(t('forms.common.icecreams.choco_hazelnut')) ?><input type="text" name="icecream_stick_choco_hazelnut"></label>
						<label><?= htmlspecialchars(t('forms.common.icecreams.stick_cola')) ?><input type="text" name="icecream_waterstick_cola"></label>
						<label><?= htmlspecialchars(t('forms.common.icecreams.stick_orange')) ?><input type="text" name="icecream_waterstick_orange"></label>
					</div>
				</section>
				<section id="confirmation">
					<h2><?= htmlspecialchars(t('forms.common.confirmation')) ?></h2>
					<label><?= htmlspecialchars(t('forms.common.notes')) ?></label>
					<textarea name="notes"></textarea>
					<label><input type="checkbox" name="terms_accepted" required><?= htmlspecialchars(t('forms.common.confirm_txt')) ?></label>
				</section>
				<section id="admin" class="admin-only">
					<h2><?= htmlspecialchars(t('forms.common.admin.title')) ?></h2>
					<label><?= htmlspecialchars(t('forms.common.admin.payment')) ?></label>
					<input type="text" name="payment_method">
					<label><?= htmlspecialchars(t('forms.common.admin.peppol_id')) ?></label>
					<input type="text" name="peppol_id">
					<label><?= htmlspecialchars(t('forms.common.admin.process_date')) ?></label>
					<input type="text" name="processing_date">
					<label><?= htmlspecialchars(t('forms.common.admin.invoice_nb')) ?></label>
					<input type="text" name="invoice_number">
					<label><?= htmlspecialchars(t('forms.common.admin.pay_date')) ?></label>
					<input type="text" name="payment_date">
					<label><?= htmlspecialchars(t('forms.common.admin.processed_by')) ?></label>
					<input type="text" name="processed_by">
					<label><?= htmlspecialchars(t('forms.common.admin.admin_notes')) ?></label>
					<textarea name="admin_notes"></textarea>
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