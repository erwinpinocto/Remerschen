<?php
/* Chargement FAQ */
$faq=load_json('data/faq.json');
if(!is_array($faq)){$faq=[];}
$search=trim($_GET['q']??'');

/* Filtrage recherche */
if($search!==''){
    $faq=array_filter($faq,function($item) use($search,$lang){
        $faqItem=tr($item,$lang);
        $keywords='';
        if(!empty($faqItem['keywords'])&&is_array($faqItem['keywords'])){
            $keywords=implode(' ',$faqItem['keywords']);
        }
        $haystack=mb_strtolower(
            ($faqItem['question']??'').' '.
            ($faqItem['answer']??'').' '.
            ($faqItem['category']??'').' '.
            ($item['page']??'').' '.
            $keywords
        );
        return mb_strpos($haystack,mb_strtolower($search))!==false;
    });
    $faq=array_values($faq);
}
?>
<!-- CSS spécifique -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/faq.css">
<div class="slogan-wrapper">
    <div class="slogan"><?= htmlspecialchars(t('faq.slogan')) ?></div>
</div>
<p class="faq-intro-text"><?= htmlspecialchars(t('faq.intro')) ?></p>
<form method="get" class="faq-search-form">
    <input type="hidden" name="page" value="faq">
    <div class="faq-search-row">
        <input type="text" name="q" class="faq-search" placeholder="<?= htmlspecialchars(t('faq.search_placeholder')) ?>" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn"><?= htmlspecialchars(t('faq.search_button')) ?></button>
        <?php if($search!==''): ?>
        <a href="<?= BASE_URL ?>/?page=faq" class="btn"><?= htmlspecialchars(t('faq.reset_button')) ?></a>
        <?php endif; ?>
    </div>
</form>
<?php if($search!==''): ?>
<p class="faq-result-info"><?= htmlspecialchars(t('faq.results_for')) ?> <strong><?= htmlspecialchars($search) ?></strong> — <?= count($faq) ?> <?= count($faq)>1?htmlspecialchars(t('faq.results_plural')):htmlspecialchars(t('faq.results_singular')) ?></p>
<?php endif; ?>
<?php if(empty($faq)): ?>
<div class="faq-empty"><?= htmlspecialchars(t('faq.empty')) ?></div>
<?php else: ?>
<?php foreach($faq as $item):$faqItem=tr($item,$lang); ?>
<section class="bloc-card">
    <?php if(!empty($faqItem['category'])): ?>
        <div class="faq-category">
            <?php if(!empty($item['page'])): ?>
                <a href="<?= BASE_URL ?>/?page=<?= urlencode($item['page']) ?>">
                    <?= htmlspecialchars($faqItem['category']) ?>
                </a>
            <?php else: ?>
                <?= htmlspecialchars($faqItem['category']) ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <h3><?= htmlspecialchars($faqItem['question']??'') ?></h3>
    <p><?= nl2br(htmlspecialchars($faqItem['answer']??'')) ?></p>
</section>
<?php endforeach; ?>
<?php endif; ?>