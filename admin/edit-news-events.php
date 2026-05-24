<?php
/* Protection admin */
require __DIR__.'/../bootstrap.php';
if(empty($_SESSION['admin'])){
	header('Location: '.BASE_URL.'/admin/admin-login.php');
	exit;
}
/* Type demandé : news, events, carpo-events */
$type=$_GET['type']??'news';
if(!in_array($type,['news','events','carpo-events'],true)){
	header('Location: '.BASE_URL.'/admin/admin.php');
	exit;
}
/* Fichier JSON et préfixe d'id selon le type */
switch($type){
	case 'news':
		$pageTitle='Actualités';
		$file=BASE_PATH.'/data/news.json';
		$idPrefix='news';
		break;
	case 'events':
		$pageTitle='Événements publics';
		$file=BASE_PATH.'/data/public-events.json';
		$idPrefix='event';
		break;
	case 'carpo-events':
		$pageTitle='Événements carpodrome';
		$file=BASE_PATH.'/data/carpo-events.json';
		$idPrefix='carpo';
		break;
	default:
		die('Type invalide');
}
/* Init variables globales */
$items=[];
$error='';
$successMsg='';
/* Message de confirmation d'upload via GET */
if(isset($_GET['uploaded'])&&$_GET['uploaded']!==''){
	$successMsg='Image liée : '.htmlspecialchars($_GET['uploaded']);
}
/* Lecture du fichier JSON */
if(file_exists($file)){
	$json=file_get_contents($file);
	$data=json_decode($json,true);
	if(is_array($data)) $items=$data;
}
/* -------------------------------------------------- */
/* HELPERS */
/* -------------------------------------------------- */
/* Retourne un tableau de traduction vide */
function defaultTranslation():array{
	return['title'=>'','text'=>'','details'=>'','bullets'=>[]];
}
/* Retourne un item vide avec valeurs par défaut */
function defaultItem(string $idPrefix):array{
	return[
		'id'=>'','created_at'=>date('Y-m-d'),
		'date_start'=>date('Y-m-d'),'date_end'=>date('Y-m-d'),
		'date_display'=>'','time_start'=>'','time_end'=>'',
		'location'=>'','published'=>true,'link'=>'','image'=>'',
		'translations'=>['fr'=>defaultTranslation(),'de'=>defaultTranslation(),'en'=>defaultTranslation()]
	];
}
/* Normalise un bloc de traduction */
function normalizeTranslation($trans):array{
	if(!is_array($trans)) return defaultTranslation();
	$bullets=$trans['bullets']??[];
	if(!is_array($bullets)) $bullets=[];
	$bullets=array_values(array_filter(array_map(static fn($v)=>trim((string)$v),$bullets),static fn($v)=>$v!==''));
	return[
		'title'=>trim((string)($trans['title']??'')),
		'text'=>trim((string)($trans['text']??'')),
		'details'=>trim((string)($trans['details']??'')),
		'bullets'=>$bullets
	];
}
/* Normalise un item complet */
function normalizeItem(array $item,string $idPrefix):array{
	$item=array_replace(defaultItem($idPrefix),$item);
	foreach(['id','created_at','date_start','date_end','date_display','time_start','time_end','location','link','image'] as $k){
		$item[$k]=trim((string)($item[$k]??''));
	}
	$item['published']=!empty($item['published']);
	if($item['created_at']==='') $item['created_at']=date('Y-m-d');
	if($item['date_end']==='') $item['date_end']=$item['date_start'];
	$t=is_array($item['translations']??null)?$item['translations']:[];
	$item['translations']=[
		'fr'=>normalizeTranslation($t['fr']??[]),
		'de'=>normalizeTranslation($t['de']??[]),
		'en'=>normalizeTranslation($t['en']??[]),
	];
	return $item;
}
/* Trie et sauvegarde les items dans le fichier JSON */
function saveItems(string $file,array $items,string $idPrefix):bool{
	$normalized=array_map(static fn($item)=>normalizeItem(is_array($item)?$item:[],$idPrefix),$items);
	usort($normalized,static function($a,$b){
		$d=strcmp($b['date_start']??'',$a['date_start']??'');
		return $d!==0?$d:strcmp($b['id']??'',$a['id']??'');
	});
	$json=json_encode($normalized,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	if($json===false) return false;
	return file_put_contents($file,$json,LOCK_EX)!==false;
}
/* Génère un id unique : prefix_YYYYMMDD_N */
function generateItemId(string $prefix,string $dateStart,array $items):string{
	$datePart=preg_replace('/[^0-9]/','',$dateStart)?:date('Ymd');
	$max=0;
	foreach($items as $item){
		$id=(string)($item['id']??'');
		if(preg_match('/^'.preg_quote($prefix,'/').'_'.$datePart.'_(\d+)$/',$id,$m)&&(int)$m[1]>$max){
			$max=(int)$m[1];
		}
	}
	return $prefix.'_'.$datePart.'_'.($max+1);
}
/* Convertit un tableau de puces en texte multiligne pour textarea */
function bulletsToTextarea($value):string{
	if(!is_array($value)) return '';
	return implode("\n",array_values(array_filter(array_map(static fn($v)=>trim((string)$v),$value),static fn($v)=>$v!=='')));
}
/* Convertit un texte multiligne en tableau de puces */
function textareaToBullets(string $value):array{
	return array_values(array_filter(array_map('trim',preg_split('/\R/u',$value)),static fn($v)=>$v!==''));
}
/* Valide une date au format YYYY-MM-DD */
function isValidDate(string $value):bool{
	if(!preg_match('/^\d{4}-\d{2}-\d{2}$/',$value)) return false;
	[$y,$m,$d]=array_map('intval',explode('-',$value));
	return checkdate($m,$d,$y);
}
/* -------------------------------------------------- */
/* SUPPRESSION */
/* -------------------------------------------------- */
if(isset($_GET['delete'])){
	$id=trim((string)($_GET['delete']??''));
	$items=array_values(array_filter($items,static fn($item)=>(string)($item['id']??'')!==$id));
	if(saveItems($file,$items,$idPrefix)){
		header('Location: '.BASE_URL.'/admin/edit-news-events.php?type='.$type);
		exit;
	}
	$error='Impossible d\'enregistrer le fichier JSON.';
}
/* -------------------------------------------------- */
/* ENREGISTREMENT */
/* -------------------------------------------------- */
if($_SERVER['REQUEST_METHOD']==='POST'){
	/* Récupération des champs */
	$id=trim((string)($_POST['id']??''));
	$dateStart=trim((string)($_POST['date_start']??''));
	$dateEnd=trim((string)($_POST['date_end']??''));
	$dateDisplay=trim((string)($_POST['date_display']??''));
	$timeStart=trim((string)($_POST['time_start']??''));
	$timeEnd=trim((string)($_POST['time_end']??''));
	$location=trim((string)($_POST['location']??''));
	$published=isset($_POST['published']);
	$link=trim((string)($_POST['link']??''));
	/* Image : on part de l'image actuelle, remplacée si un fichier est uploadé */
	$image=trim((string)($_POST['image_current']??''));
	if(isset($_FILES['image_file'])&&$_FILES['image_file']['error']!==UPLOAD_ERR_NO_FILE){
		$allowedMimes=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp','image/avif'=>'avif'];
		$uploadError='';
		$uploadName=pathinfo($_FILES['image_file']['name'],PATHINFO_FILENAME);
		$file_=$_FILES['image_file'];
		if($file_['error']!==UPLOAD_ERR_OK){
			$uploadError='Erreur lors de l\'upload (code '.$file_['error'].').';
		}elseif($uploadName===''){
			$uploadError='Nom de fichier vide.';
		}elseif(!preg_match('/^[a-z0-9_\-]+$/i',$uploadName)){
			$uploadError='Nom invalide : lettres, chiffres, tirets et underscores uniquement.';
		}else{
			$mime=mime_content_type($file_['tmp_name']);
			if(!isset($allowedMimes[$mime])){
				$uploadError='Type de fichier non autorisé ('.$mime.').';
			}else{
				$ext=$allowedMimes[$mime];
				$finalName=$uploadName.'.'.$ext;
				$dest=BASE_PATH.'/assets/img/news_events/'.$finalName;
				if(file_exists($dest)){
					/* Fichier déjà présent : on le lie sans re-uploader */
					$image='news_events/'.$finalName;
				}elseif(!move_uploaded_file($file_['tmp_name'],$dest)){
					$uploadError='Impossible de déplacer le fichier uploadé.';
				}else{
					/* Upload réussi */
					$image='news_events/'.$finalName;
				}
			}
		}
		if($uploadError!=='') $error=$uploadError;
	}
	/* Récupération des traductions */
	$titleFr=trim((string)($_POST['title_fr']??''));
	$textFr=trim((string)($_POST['text_fr']??''));
	$detailsFr=trim((string)($_POST['details_fr']??''));
	$bulletsFr=textareaToBullets(trim((string)($_POST['bullets_fr']??'')));
	$titleDe=trim((string)($_POST['title_de']??''));
	$textDe=trim((string)($_POST['text_de']??''));
	$detailsDe=trim((string)($_POST['details_de']??''));
	$bulletsDe=textareaToBullets(trim((string)($_POST['bullets_de']??'')));
	$titleEn=trim((string)($_POST['title_en']??''));
	$textEn=trim((string)($_POST['text_en']??''));
	$detailsEn=trim((string)($_POST['details_en']??''));
	$bulletsEn=textareaToBullets(trim((string)($_POST['bullets_en']??'')));
	/* Validation */
	if($dateStart===''){
		$error='La date de début est obligatoire.';
	}elseif(!isValidDate($dateStart)){
		$error='La date de début est invalide.';
	}elseif($dateEnd!==''&&!isValidDate($dateEnd)){
		$error='La date de fin est invalide.';
	}elseif($titleFr===''){
		$error='Le titre FR est obligatoire.';
	}else{
		if($dateEnd==='') $dateEnd=$dateStart;
		if($dateEnd<$dateStart){
			$error='La date de fin ne peut pas être antérieure à la date de début.';
		}else{
			/* Génération ou récupération de l'id et du created_at */
			if($id===''){
				$id=generateItemId($idPrefix,$dateStart,$items);
				$createdAt=date('Y-m-d');
			}else{
				$createdAt='';
				foreach($items as $existing){
					if((string)($existing['id']??'')===$id){
						$createdAt=trim((string)($existing['created_at']??''));
						break;
					}
				}
				if($createdAt==='') $createdAt=date('Y-m-d');
			}
			/* Construction de l'item */
			$item=normalizeItem([
				'id'=>$id,'created_at'=>$createdAt,
				'date_start'=>$dateStart,'date_end'=>$dateEnd,
				'date_display'=>$dateDisplay,'time_start'=>$timeStart,'time_end'=>$timeEnd,
				'location'=>$location,'published'=>$published,'link'=>$link,'image'=>$image,
				'translations'=>[
					'fr'=>['title'=>$titleFr,'text'=>$textFr,'details'=>$detailsFr,'bullets'=>$bulletsFr],
					'de'=>['title'=>$titleDe,'text'=>$textDe,'details'=>$detailsDe,'bullets'=>$bulletsDe],
					'en'=>['title'=>$titleEn,'text'=>$textEn,'details'=>$detailsEn,'bullets'=>$bulletsEn],
				]
			],$idPrefix);
			/* Mise à jour ou ajout */
			$updated=false;
			foreach($items as &$existing){
				if((string)($existing['id']??'')===$id){
					$existing=$item;
					$updated=true;
					break;
				}
			}
			unset($existing);
			if(!$updated) $items[]=$item;
			/* Sauvegarde et redirection */
			if(saveItems($file,$items,$idPrefix)){
				header('Location: '.BASE_URL.'/admin/edit-news-events.php?type='.$type.'&uploaded='.urlencode($image));
				exit;
			}
			$error='Impossible d\'enregistrer le fichier JSON.';
		}
	}
}
/* -------------------------------------------------- */
/* EDITION : chargement de l'item à éditer */
/* -------------------------------------------------- */
$edit=defaultItem($idPrefix);
if(isset($_GET['edit'])){
	$editId=trim((string)($_GET['edit']??''));
	foreach($items as $item){
		if((string)($item['id']??'')===$editId){
			$edit=normalizeItem($item,$idPrefix);
			break;
		}
	}
}
/* Tri pour l'affichage de la liste */
usort($items,static function($a,$b){
	$d=strcmp($b['date_start']??'',$a['date_start']??'');
	return $d!==0?$d:strcmp($b['id']??'',$a['id']??'');
});
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Admin <?= htmlspecialchars($pageTitle) ?></title>
	<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
	<style>
		body{font-family:Arial;max-width:1100px;margin:40px auto;}
		form{background:#f8f9fa;padding:20px;border-radius:8px;}
		input,textarea{width:100%;padding:10px;margin-top:8px;font-size:15px;box-sizing:border-box;}
		input[type="checkbox"]{width:auto;margin-right:8px;}
		button{margin-top:15px;padding:10px 20px;background:#007cba;color:#fff;border:none;cursor:pointer;}
		.error{background:#f8d7da;color:#842029;padding:12px 15px;border:1px solid #f5c2c7;margin-bottom:20px;}
		.success{background:#d1e7dd;color:#0f5132;padding:12px 15px;border:1px solid #badbcc;margin-bottom:20px;}
		.grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;}
		.lang-block,.meta-block{margin-top:20px;padding:15px;background:#fff;border:1px solid #ddd;border-radius:6px;}
		.list{margin-top:30px;}
		.list ul{padding-left:20px;}
		.list li{margin-bottom:10px;}
		.top-links a{margin-right:15px;}
		.checkbox-line{display:flex;align-items:center;margin-top:15px;}
	</style>
</head>
<body>
	<div class="top-links">
		<a href="<?= BASE_URL ?>/admin/admin.php">← Admin</a>
		<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=news">Actualités</a>
		<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=events">Événements publics</a>
		<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=carpo-events">Événements carpodrome</a>
		<a href="<?= BASE_URL ?>/admin/edit-faq.php?type=events">FAQ</a>
	</div>
	<h1><?= htmlspecialchars($pageTitle) ?></h1>
	<h2><?= !empty($edit['id'])?'Modifier une entrée':'Nouvelle entrée' ?></h2>
	<?php if($error!==''){ ?>
		<div class="error"><?= htmlspecialchars($error) ?></div>
	<?php } ?>
	<?php if($successMsg!==''){ ?>
		<div class="success"><?= $successMsg ?></div>
	<?php } ?>
	<form method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?= htmlspecialchars($edit['id']) ?>">
		<input type="hidden" name="image_current" value="<?= htmlspecialchars($edit['image']) ?>">
		<div class="grid">
			<div class="meta-block">
				<h3>Métadonnées</h3>
				<label>Date de création</label>
				<input type="date" value="<?= htmlspecialchars($edit['created_at']) ?>" disabled>
				<label>Date de début</label>
				<input type="date" name="date_start" value="<?= htmlspecialchars($edit['date_start']) ?>">
				<label>Date de fin</label>
				<input type="date" name="date_end" value="<?= htmlspecialchars($edit['date_end']) ?>">
				<label>Date libre affichée</label>
				<input type="text" name="date_display" value="<?= htmlspecialchars($edit['date_display']) ?>" placeholder="Ex. : Chaque 1er mercredi du mois">
				<label>Heure de début</label>
				<input type="time" name="time_start" value="<?= htmlspecialchars($edit['time_start']) ?>">
				<label>Heure de fin</label>
				<input type="time" name="time_end" value="<?= htmlspecialchars($edit['time_end']) ?>">
				<label>Lieu</label>
				<input type="text" name="location" value="<?= htmlspecialchars($edit['location']) ?>">
				<label>Lien</label>
				<input type="text" name="link" value="<?= htmlspecialchars($edit['link']) ?>" placeholder="/pages/... ou URL externe">
				<label>Fichier image (jpg, png, webp, avif)</label>
				<input type="file" name="image_file" accept=".jpg,.jpeg,.png,.webp,.avif">
				<?php if($edit['image']!==''){ ?>
					<div style="margin-top:6px;font-size:13px;color:#555;">Image actuelle : <code><?= htmlspecialchars($edit['image']) ?></code></div>
				<?php } ?>
				<label class="checkbox-line">
					<input type="checkbox" name="published" <?= !empty($edit['published'])?'checked':'' ?>>
					Publié
				</label>
			</div>
			<div>
				<div class="lang-block">
					<h3>FR</h3>
					<label>Titre FR</label>
					<input type="text" name="title_fr" value="<?= htmlspecialchars($edit['translations']['fr']['title']) ?>">
					<label>Texte FR</label>
					<textarea name="text_fr" rows="4"><?= htmlspecialchars($edit['translations']['fr']['text']) ?></textarea>
					<label>Détails FR</label>
					<textarea name="details_fr" rows="4"><?= htmlspecialchars($edit['translations']['fr']['details']) ?></textarea>
					<label>Puces FR (une par ligne)</label>
					<textarea name="bullets_fr" rows="4"><?= htmlspecialchars(bulletsToTextarea($edit['translations']['fr']['bullets'])) ?></textarea>
				</div>
				<div class="lang-block">
					<h3>DE</h3>
					<label>Titre DE</label>
					<input type="text" name="title_de" value="<?= htmlspecialchars($edit['translations']['de']['title']) ?>">
					<label>Texte DE</label>
					<textarea name="text_de" rows="4"><?= htmlspecialchars($edit['translations']['de']['text']) ?></textarea>
					<label>Détails DE</label>
					<textarea name="details_de" rows="4"><?= htmlspecialchars($edit['translations']['de']['details']) ?></textarea>
					<label>Puces DE (une par ligne)</label>
					<textarea name="bullets_de" rows="4"><?= htmlspecialchars(bulletsToTextarea($edit['translations']['de']['bullets'])) ?></textarea>
				</div>
				<div class="lang-block">
					<h3>EN</h3>
					<label>Titre EN</label>
					<input type="text" name="title_en" value="<?= htmlspecialchars($edit['translations']['en']['title']) ?>">
					<label>Texte EN</label>
					<textarea name="text_en" rows="4"><?= htmlspecialchars($edit['translations']['en']['text']) ?></textarea>
					<label>Détails EN</label>
					<textarea name="details_en" rows="4"><?= htmlspecialchars($edit['translations']['en']['details']) ?></textarea>
					<label>Puces EN (une par ligne)</label>
					<textarea name="bullets_en" rows="4"><?= htmlspecialchars(bulletsToTextarea($edit['translations']['en']['bullets'])) ?></textarea>
				</div>
			</div>
		</div>
		<button type="submit">Enregistrer</button>
		<?php if(!empty($edit['id'])){ ?>
			<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=<?= urlencode($type) ?>">Annuler</a>
		<?php } ?>
		<button type="button" onclick="window.location.href='<?= BASE_URL ?>/?page=home'">⬅️ Retour</button>
	</form>
	<div class="list">
		<h2>Liste des <?= htmlspecialchars($pageTitle) ?></h2>
		<?php if(empty($items)){ ?>
			<p>Aucune entrée.</p>
		<?php }else{ ?>
			<ul>
				<?php foreach($items as $item){ $item=normalizeItem($item,$idPrefix); ?>
					<li>
						<strong><?= htmlspecialchars($item['date_start']!==''?$item['date_start']:'(sans date)') ?></strong>
						— <?= htmlspecialchars($item['translations']['fr']['title']!==''?$item['translations']['fr']['title']:'(sans titre)') ?>
						<?= !empty($item['published'])?'[publié]':'[brouillon]' ?>
						<a href="?type=<?= urlencode($type) ?>&edit=<?= urlencode($item['id']) ?>">éditer</a>
						<a href="?type=<?= urlencode($type) ?>&delete=<?= urlencode($item['id']) ?>" onclick="return confirm('Supprimer cette entrée ?')">supprimer</a>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
	</div>
</body>
</html>