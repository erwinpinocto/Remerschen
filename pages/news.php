<?php
/* Chargement des actualités */
$newsFile=BASE_PATH.'/data/news.json';
$newsItems=[];

/* Lecture JSON */
if(file_exists($newsFile)){
	$json=file_get_contents($newsFile);
	$data=json_decode($json,true);
	if(is_array($data)){$newsItems=$data;}
}

/* Filtre publié */
$newsItems=array_filter($newsItems,static function($item){
	return !empty($item['published']);
});

/* Tri décroissant */
usort($newsItems,static function($a,$b){
	return strcmp($b['date_start']??'',$a['date_start']??'');
});

/* Fallback champ traduit */
function trField(array $item,string $lang,string $key):string{
	$val=trim((string)($item['translations'][$lang][$key]??''));
	if($val!==''){return $val;}
	return trim((string)($item['translations']['fr'][$key]??''));
}

/* Bullets traduits */
function trBullets(array $item,string $lang):array{
	$bullets=$item['translations'][$lang]['bullets']??[];
	if(!is_array($bullets)||empty($bullets)){$bullets=$item['translations']['fr']['bullets']??[];}
	return is_array($bullets)?$bullets:[];
}

/* Format date */
function formatItemDate(array $item,string $lang):string{
	$display=$item['date_display']??'';
	if(is_array($display)){
		$display=trim((string)($display[$lang]??$display['fr']??''));
	}else{
		$display=trim((string)$display);
	}
	$start=$item['date_start']??'';
	$end=$item['date_end']??'';
	if($display!==''){return $display;}
	$startTs=$start!==''?strtotime($start):false;
	$endTs=$end!==''?strtotime($end):false;
	if(!$startTs){return '';}
	if(!$endTs||$start===$end){return date('d/m/Y',$startTs);}
	return date('d/m/Y',$startTs).' - '.date('d/m/Y',$endTs);
}

/* Format méta */
function formatItemMeta(array $item):string{
	$parts=[];
	$location=trim((string)($item['location']??''));
	$timeStart=trim((string)($item['time_start']??''));
	$timeEnd=trim((string)($item['time_end']??''));
	if($location!==''){$parts[]=$location;}
	if($timeStart!==''&&$timeEnd!==''){$parts[]=$timeStart.' - '.$timeEnd;}
	elseif($timeStart!==''){$parts[]=$timeStart;}
	return implode(' · ',$parts);
}
?>
<h2><?= htmlspecialchars(t('news.latest_title')) ?></h2>
<?php if(empty($newsItems)): ?>
<article class="dated-bloc-2cols">
	<div class="dated-bloc-main">
		<div class="bloc-left">
			<p class="item-text"><?= htmlspecialchars(t('news.empty')) ?></p>
		</div>
	</div>
</article>
<?php else: ?>
<?php foreach($newsItems as $item): ?>
<?php
/* Champs traduits */
$title=trField($item,$lang,'title');
$text=trField($item,$lang,'text');
$details=trField($item,$lang,'details');
$bullets=trBullets($item,$lang);
$date=formatItemDate($item,$lang);
$meta=formatItemMeta($item);
$link=trim((string)($item['link']??''));
$image=trim((string)($item['image']??''));

/* Détails */
$hasBullets=!empty($bullets);
$hasDetails=$details!==''||$hasBullets||$link!=='';

/* Ignore entrée vide */
if($title===''&&$text===''&&$meta===''&&$date===''&&!$hasDetails&&$image===''){continue;}
?>
<article class="dated-bloc-2cols">
	<div class="dated-bloc-main">
		<div class="bloc-left">
			<?php if($date!==''): ?>
			<span class="item-date"><?= htmlspecialchars($date) ?></span>
			<?php endif; ?>
			<?php if($title!==''): ?>
			<h3 class="item-title"><?= htmlspecialchars($title) ?></h3>
			<?php endif; ?>
			<?php if($meta!==''): ?>
			<p class="item-meta"><?= htmlspecialchars($meta) ?></p>
			<?php endif; ?>
			<?php if($text!==''): ?>
			<p class="item-text"><?= nl2br(htmlspecialchars($text)) ?></p>
			<?php endif; ?>
		</div>
		<?php if($image!==''): ?>
		<div class="bloc-right item-media">
			<a href="<?= BASE_URL ?>/assets/img/<?= htmlspecialchars($image) ?>" target="_blank" rel="noopener">
				<img src="<?= BASE_URL ?>/assets/img/<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($title!==''?$title:t('news.default_alt')) ?>" class="img-thumb">
			</a>
		</div>
		<?php endif; ?>
	</div>
	<?php if($hasDetails): ?>
	<details class="dated-bloc-details-toggle">
		<summary><?= htmlspecialchars(t('news.details')) ?></summary>
		<div class="dated-bloc-details">
			<?php if($details!==''): ?>
			<p class="item-text"><?= nl2br(htmlspecialchars($details)) ?></p>
			<?php endif; ?>
			<?php if($hasBullets): ?>
			<ul>
				<?php foreach($bullets as $bullet): ?>
				<?php $bullet=trim((string)$bullet); if($bullet===''){continue;} ?>
				<li><?= htmlspecialchars($bullet) ?></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<?php if($link!==''): ?>
			<div class="item-action">
				<a href="<?= htmlspecialchars(BASE_URL.$link) ?>" class="btn"><?= htmlspecialchars(t('news.more_button')) ?></a>
			</div>
			<?php endif; ?>
		</div>
	</details>
	<?php endif; ?>
</article>
<?php endforeach; ?>
<?php endif; ?>