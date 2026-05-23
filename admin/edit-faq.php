<?php
/* Protection admin */
require __DIR__.'/../bootstrap.php';
if(empty($_SESSION['admin'])){
	header('Location: '.BASE_URL.'/admin/admin-login.php');
	exit;
}
/* Fichier FAQ */
$faqFile=BASE_PATH.'/data/faq.json';
$faqItems=[];
/* FAQ par défaut */
function faq_default_item():array{
	return[
		'id'=>0,
		'translations'=>[
			'fr'=>['category'=>'','question'=>'','answer'=>'','keywords'=>[]],
			'de'=>['category'=>'','question'=>'','answer'=>'','keywords'=>[]],
			'en'=>['category'=>'','question'=>'','answer'=>'','keywords'=>[]]
		]
	];
}
/* Lecture JSON */
if(file_exists($faqFile)){
	$json=file_get_contents($faqFile);
	$data=json_decode($json,true);
	if(is_array($data)){
		foreach($data as $item){
			$faqItems[]=array_replace_recursive(faq_default_item(),is_array($item)?$item:[]);
		}
	}
}
/* Suppression */
if(isset($_GET['delete'])){
	$id=(int)$_GET['delete'];
	$faqItems=array_values(array_filter($faqItems,function($item)use($id){
		return (int)($item['id']??0)!==$id;
	}));
	file_put_contents($faqFile,json_encode($faqItems,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
	header('Location: '.BASE_URL.'/admin/edit-faq.php');
	exit;
}
/* Enregistrement */
if($_POST){
	$id=(int)($_POST['id']??0);
	if($id===0){
		$ids=array_column($faqItems,'id');
		$id=$ids?max($ids)+1:1;
	}
	$item=[
		'id'=>$id,
		'translations'=>[
			'fr'=>[
				'category'=>trim($_POST['category_fr']??''),
				'question'=>trim($_POST['question_fr']??''),
				'answer'=>trim($_POST['answer_fr']??''),
				'keywords'=>array_values(array_filter(array_map('trim',explode("\n",trim($_POST['keywords_fr']??'')))))
			],
			'de'=>[
				'category'=>trim($_POST['category_de']??''),
				'question'=>trim($_POST['question_de']??''),
				'answer'=>trim($_POST['answer_de']??''),
				'keywords'=>array_values(array_filter(array_map('trim',explode("\n",trim($_POST['keywords_de']??'')))))
			],
			'en'=>[
				'category'=>trim($_POST['category_en']??''),
				'question'=>trim($_POST['question_en']??''),
				'answer'=>trim($_POST['answer_en']??''),
				'keywords'=>array_values(array_filter(array_map('trim',explode("\n",trim($_POST['keywords_en']??'')))))
			]
		]
	];
	$updated=false;
	foreach($faqItems as &$faq){
		if((int)($faq['id']??0)===$id){
			$faq=array_replace_recursive(faq_default_item(),$item);
			$updated=true;
			break;
		}
	}
	unset($faq);
	if(!$updated){
		$faqItems[]=array_replace_recursive(faq_default_item(),$item);
	}
	file_put_contents($faqFile,json_encode($faqItems,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
	header('Location: '.BASE_URL.'/admin/edit-faq.php');
	exit;
}
/* Edition */
$edit=faq_default_item();
if(isset($_GET['edit'])){
	$id=(int)$_GET['edit'];
	foreach($faqItems as $faq){
		if((int)($faq['id']??0)===$id){
			$edit=array_replace_recursive(faq_default_item(),$faq);
			break;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Admin FAQ</title>
	<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
	<style>
		body{font-family:Arial;max-width:1000px;margin:40px auto;}
		form{background:#f8f9fa;padding:20px;border-radius:8px;}
		input,textarea{width:100%;padding:10px;margin-top:8px;font-size:15px;}
		button{margin-top:15px;padding:10px 20px;background:#007cba;color:#fff;border:none;cursor:pointer;}
		ul{margin-top:30px;}
		.lang-block{margin-top:25px;padding:15px;background:#fff;border:1px solid #ddd;border-radius:6px;}
		.lang-block h3{margin:0 0 10px;}
	</style>
</head>
<body>
	<div class="top-links">
		<a href="<?= BASE_URL ?>/admin/admin.php">← Admin</a>
		<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=news">Actualités</a>
		<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=events">Événements publics</a>
		<a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=carpo">Événements carpodrome</a>
		<a href="<?= BASE_URL ?>/admin/edit-faq.php?type=events">FAQ</a>
	</div>
	<h1>FAQ</h1>
	<h2><?= !empty($edit['id'])?'Modifier une entrée':'Nouvelle entrée' ?></h2>
	<form method="POST">
		<input type="hidden" name="id" value="<?= htmlspecialchars((string)($edit['id']??'')) ?>">
		<div class="lang-block">
			<h3>FR</h3>
			<label>Catégorie</label>
			<input name="category_fr" value="<?= htmlspecialchars($edit['translations']['fr']['category']??'') ?>">
			<label>Question</label>
			<input name="question_fr" value="<?= htmlspecialchars($edit['translations']['fr']['question']??'') ?>">
			<label>Réponse</label>
			<textarea name="answer_fr" rows="4"><?= htmlspecialchars($edit['translations']['fr']['answer']??'') ?></textarea>
			<label>Mots-clés FR (un par ligne)</label>
			<textarea name="keywords_fr" rows="4"><?= htmlspecialchars(implode("\n",$edit['translations']['fr']['keywords']??[])) ?></textarea>
		</div>
		<div class="lang-block">
			<h3>DE</h3>
			<label>Catégorie</label>
			<input name="category_de" value="<?= htmlspecialchars($edit['translations']['de']['category']??'') ?>">
			<label>Question</label>
			<input name="question_de" value="<?= htmlspecialchars($edit['translations']['de']['question']??'') ?>">
			<label>Réponse</label>
			<textarea name="answer_de" rows="4"><?= htmlspecialchars($edit['translations']['de']['answer']??'') ?></textarea>
			<label>Mots-clés DE (un par ligne)</label>
			<textarea name="keywords_de" rows="4"><?= htmlspecialchars(implode("\n",$edit['translations']['de']['keywords']??[])) ?></textarea>
		</div>
		<div class="lang-block">
			<h3>EN</h3>
			<label>Catégorie</label>
			<input name="category_en" value="<?= htmlspecialchars($edit['translations']['en']['category']??'') ?>">
			<label>Question</label>
			<input name="question_en" value="<?= htmlspecialchars($edit['translations']['en']['question']??'') ?>">
			<label>Réponse</label>
			<textarea name="answer_en" rows="4"><?= htmlspecialchars($edit['translations']['en']['answer']??'') ?></textarea>
			<label>Mots-clés EN (un par ligne)</label>
			<textarea name="keywords_en" rows="4"><?= htmlspecialchars(implode("\n",$edit['translations']['en']['keywords']??[])) ?></textarea>
		</div>
		<button type="submit">Enregistrer</button>
		<button type="button" onclick="window.location.href='<?= BASE_URL ?>/?page=faq'">⬅️ Retour</button>
		<?php if(!empty($edit['id'])){ ?>
			<a href="<?= BASE_URL ?>/admin/edit-faq.php">Annuler</a>
		<?php } ?>
	</form>
	<h2>Liste</h2>
	<?php if(empty($faqItems)){ ?>
		<p>Aucune entrée.</p>
	<?php }else{ ?>
		<ul>
			<?php foreach($faqItems as $faq){ $faqFr=tr($faq,'fr'); ?>
				<li>
					<strong><?= htmlspecialchars($faqFr['question']??'') ?></strong>
					[<?= htmlspecialchars($faqFr['category']??'') ?>]
					<a href="?edit=<?= (int)($faq['id']??0) ?>">éditer</a>
					<a href="?delete=<?= (int)($faq['id']??0) ?>" onclick="return confirm('Supprimer ?')">supprimer</a>
				</li>
			<?php } ?>
		</ul>
	<?php } ?>
	<p><a href="<?= BASE_URL ?>/admin/admin.php">← Admin</a></p>
</body>
</html>