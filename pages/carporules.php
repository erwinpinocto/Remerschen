<?php
require __DIR__.'/../bootstrap.php';

/* langue */
$docLang = in_array($lang,['fr','de','en'],true)?$lang:'fr';
$docFile = BASE_PATH.'/lang/'.$docLang.'/carporules.php';
if(!file_exists($docFile)){
	$docFile = BASE_PATH.'/lang/fr/carporules.php';
}
?>

<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/docs.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/rates.css">

<div class="doc-wrapper">
	<div class="doc-container">

		<?php require $docFile; ?>

		<div class="print-actions no-print">
			<button
				class="btn-back"
				onclick="window.location.href='<?= BASE_URL ?>/?page=carpodrome'"
			>
				⬅️ <?= htmlspecialchars(t('buttons.back')) ?>
			</button>

			<button
				class="btn-print"
				onclick="window.print()"
			>
				🖨️ <?= htmlspecialchars(t('buttons.print')) ?>
			</button>
		</div>

	</div>
</div>