<?php
// Chargement de l’environnement global (langue, config, fonctions)
require __DIR__.'/../bootstrap.php';
// Titre de page via i18n
$pageTitle=t('forms.wantermoart.meta_title');
// Détermination du fichier de règlement selon la langue active
$langCode=$lang?:$LANG_DEFAULT;
// Chemin vers le fichier langue spécifique du règlement
$rulesPartial=BASE_PATH.'/lang/'.$langCode.'/wantermoart_rules.php';
// Fallback FR si fichier absent ou non lisible
if(!is_readable($rulesPartial)) $rulesPartial=BASE_PATH.'/lang/'.$LANG_DEFAULT.'/wantermoart_rules.php';
?>
<!-- CSS spécifique documents (pas de style.css pour éviter conflits) -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/docs.css">
<style>
.doc-container.reglement{
	font-size:10pt;
	line-height:1.35;
	padding:18mm 20mm;
}
.doc-container.reglement .doc-section{
	margin-bottom:10px;
}
.doc-container.reglement .doc-section h2{
	font-size:12pt;
	margin:0 0 8px;
}
.doc-container.reglement .doc-section h3{
	font-size:11pt;
	margin:10px 0 4px;
}
.doc-container.reglement .article-text{
	margin:0 0 6px;
	line-height:1.28;
	text-align:left;
}
</style>
<!-- Wrapper global (simulation feuille A4 écran) -->
<div class="doc-wrapper">
	<!-- Conteneur document -->
	<div class="doc-container">
		<!-- =================================================
				EN-TÊTE DU DOCUMENT
		================================================= -->
		<header class="doc-header">
			<div class="doc-header-logo">
				<img src="<?= BASE_URL ?>/assets/img/logo_baggerweier.svg" alt="Logo Erliefnis Baggerweier">
			</div>
			<div class="doc-header-title">
				<h1><?= htmlspecialchars($pageTitle) ?></h1>
				<div class="version"><?= htmlspecialchars(t('forms.common.form_fill')) ?></div>
			</div>
		</header>
		<!-- =================================================
				FORMULAIRE
		================================================= -->
		<form class="doc-form">
			<section>
				<div style="display:flex;align-items:center;justify-content:space-between;gap:10px;">
					<h2 style="margin:0;"><?= htmlspecialchars(t('forms.wantermoart.general_title')) ?></h2>
					<p style="margin:0;">Téléphone : 691 200 220 — Email : info@baggerweier.lu</p>
				</div>
			</section>
			<p class="article-text">
				<strong>Lieu :</strong> Baggerweier – Bréicherwee – L-5441 Remerschen<br>
				<strong>Dates :</strong> <?= htmlspecialchars(t('forms.wantermoart.dates')) ?><br>
				<span style="color:red;"><?= htmlspecialchars(t('forms.wantermoart.installation_note')) ?></span>
			</p>
			<section>
				<h2><?= htmlspecialchars(t('forms.common.exhibitor_details')) ?></h2>
				<table class="form-table">
					<tr>
						<td><?= htmlspecialchars(t('forms.common.association')) ?></td>
						<td><input type="text" name="association"></td>
						<td><?= htmlspecialchars(t('forms.common.last_name')) ?></td>
						<td><input type="text" name="nom" required></td>
						<td><?= htmlspecialchars(t('forms.common.first_name')) ?></td>
						<td><input type="text" name="prenom" required></td>
					</tr>
					<tr>
						<td><?= htmlspecialchars(t('forms.common.address')) ?></td>
						<td colspan="5"><input type="text" name="adresse" required></td>
					</tr>
					<tr>
						<td><?= htmlspecialchars(t('forms.common.postal_code')) ?></td>
						<td><input type="text" name="cp" required></td>
						<td><?= htmlspecialchars(t('forms.common.city')) ?></td>
						<td><input type="text" name="localite" required></td>
						<td><?= htmlspecialchars(t('forms.common.phone')) ?></td>
						<td><input type="tel" name="telephone" required></td>
					</tr>
					<tr>
						<td><?= htmlspecialchars(t('forms.common.email')) ?></td>
						<td colspan="5"><input type="email" name="email" required></td>
					</tr>
				</table>
			</section>
			<!-- Emplacement compact 3 colonnes -->
			<section>
				<h2><?= htmlspecialchars(t('forms.common.pitch.title')) ?></h2>
				<div class="grid-3">
					<label><input type="radio" name="emplacement" value="pagode_privee" required><?= htmlspecialchars(t('forms.common.pitch.pagode_private')) ?> :<small>100 € / 3 jours</small></label>
					<label><input type="radio" name="emplacement" value="stand_vente"><?= htmlspecialchars(t('forms.common.pitch.sales_stand')) ?> : <small>25 € / 3 jours</small></label>
					<label><input type="radio" name="emplacement" value="pagode_location"><?= htmlspecialchars(t('forms.common.pitch.pagode_rental')) ?> :<small>200 € / 3 jours</small></label>
				</div>
			</section>
			<section>
				<h2><?= htmlspecialchars(t('forms.common.additional_equipment')) ?></h2>
				<table class="form-table">
					<tr>
						<td><label><input type="checkbox" name="electricite" value="1"><?= htmlspecialchars(t('forms.common.connections.electricity')) ?></label></td>
						<td><label><input type="checkbox" name="table" value="1">Table</label></td>
						<td><input type="number" name="qte_tables" min="0" step="1" placeholder="<?= htmlspecialchars(t('forms.common.quantity')) ?>"></td>
						<td><label><input type="checkbox" name="banc" value="1">Banc</label></td>
						<td><input type="number" name="qte_bancs" min="0" step="1" placeholder="<?= htmlspecialchars(t('forms.common.quantity')) ?>"></td>
					</tr>
					<tr>
						<td><?= htmlspecialchars(t('forms.common.consumption_kw')) ?></td>
						<td colspan="2"><input type="text" name="conso_kw"></td>
						<td><?= htmlspecialchars(t('forms.common.other')) ?></td>
						<td><input type="text" name="autre_materiel"></td>
					</tr>
				</table>
				<p class="article-text"><strong>Note :</strong> <?= htmlspecialchars(t('forms.wantermoart.equipment_note')) ?></p>
			</section>
			<section>
				<h2><?= htmlspecialchars(t('forms.common.commitment')) ?></h2>
				<div class="grid-2">
					<label><input type="checkbox" name="presence_complete" value="1" required><?= htmlspecialchars(t('forms.common.full_event_presence')) ?></label>
					<label><input type="checkbox" name="reglement_ok" value="1" required><?= htmlspecialchars(t('forms.common.rules_acceptance')) ?></label>
				</div>
			</section>
			<section>
				<h2><?= htmlspecialchars(t('forms.common.validation')) ?></h2>
				<div class="grid-3">
					<label><?= htmlspecialchars(t('forms.common.place_done')) ?><input type="text" name="fait_a"></label>
					<label><?= htmlspecialchars(t('forms.common.date')) ?><input type="date" name="date_signature"></label>
					<label><?= htmlspecialchars(t('forms.common.signatory_name')) ?><input type="text" name="signataire" required></label>
				</div>
			</section>
		</form>
	</div>
</div>
<!-- Wrapper global (simulation feuille A4 écran) -->
<div class="doc-wrapper">
	<!-- Conteneur document -->
	<div class="doc-container reglement">
		<!-- =================================================
				RÈGLEMENT
		================================================= -->
		<?php require $rulesPartial; ?>
		<!-- Actions écran (non imprimées) -->
		<div class="print-actions no-print">
			<!-- Retour page events -->
			<button type="button" onclick="window.location.href='<?= BASE_URL ?>/?page=events'">⬅️ <?= htmlspecialchars(t('buttons.back')) ?></button>
			<!-- Impression / export PDF -->
			<button type="button" onclick="window.print()">🖨️ <?= htmlspecialchars(t('buttons.print')) ?></button>
		</div>
	</div>
</div>