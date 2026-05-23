<?php
/* Chargement des événements publics */
$eventsFile=BASE_PATH.'/data/public-events.json';
$eventsItems=[];

/* Lecture du JSON */
if(file_exists($eventsFile)){
	$json=file_get_contents($eventsFile);
	$data=json_decode($json,true);
	if(is_array($data)){$eventsItems=$data;}
}

/* Filtrer les événements publiés */
$eventsItems=array_filter($eventsItems,static function($item){
	return !empty($item['published']);
});

/* Trier par date décroissante */
usort($eventsItems,static function($a,$b){
	return strcmp($b['date_start']??'',$a['date_start']??'');
});

/* Fallback champ traduit */
function eventField(array $item,string $lang,string $key):string{
	$val=trim((string)($item['translations'][$lang][$key]??''));
	if($val!==''){return $val;}
	return trim((string)($item['translations']['fr'][$key]??''));
}

/* Bullets traduits */
function eventBullets(array $item,string $lang):array{
	$bullets=$item['translations'][$lang]['bullets']??[];
	if(!is_array($bullets)||empty($bullets)){$bullets=$item['translations']['fr']['bullets']??[];}
	return is_array($bullets)?$bullets:[];
}

/* Format date */
function formatEventDate(array $item,string $lang):string{
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
	if(!$endTs||$start===$end){return date('Y-m-d',$startTs);}
	return date('Y-m-d',$startTs).'-'.date('d',$endTs);
}

/* Format méta */
function formatEventMeta(array $item):string{
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
<?php foreach($eventsItems as $item): ?>
<?php
$title=eventField($item,$lang,'title');
$text=eventField($item,$lang,'text');
$details=eventField($item,$lang,'details');
$bullets=eventBullets($item,$lang);
$date=formatEventDate($item,$lang);
$meta=formatEventMeta($item);
$link=trim((string)($item['link']??''));
$image=trim((string)($item['image']??''));
$hasBullets=!empty($bullets);
$hasDetails=$details!==''||$hasBullets||$link!=='';
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
				<a href="<?= htmlspecialchars(BASE_URL.$link) ?>" class="btn" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars(t('news.more_button')) ?></a>
			</div>
			<?php endif; ?>
		</div>
	</details>
	<?php endif; ?>
</article>
<?php endforeach; ?>