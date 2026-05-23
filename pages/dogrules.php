<?php
/* =========================================================
   WRAPPER DOCUMENT : dogrules
========================================================= */
require __DIR__.'/../bootstrap.php';

/* Choix langue */
$docLang = in_array($lang,['fr','de','en'],true)?$lang:'fr';
$docFile = BASE_PATH.'/lang/'.$docLang.'/dogrules.php';

if(!file_exists($docFile)){
    $docFile = BASE_PATH.'/lang/fr/dogrules.php';
}
?>
<!-- CSS -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/docs.css">
<!-- WRAPPER -->
<div class="doc-wrapper">
    <div class="doc-container">
        <?php require $docFile; ?>
        <!-- Actions -->
        <div class="print-actions no-print">
            <button
                class="btn-back"
                onclick="window.location.href='<?= BASE_URL ?>/?page=loisirs'"
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