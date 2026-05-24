<?php
/* Protection admin */
require __DIR__.'/../bootstrap.php';
if(!isset($_SESSION['admin'])){
	header('Location: '.BASE_URL.'/admin/admin-login.php');
	exit;
}

/* Déconnexion */
if(isset($_GET['logout'])){
	session_destroy();
	header('Location: '.BASE_URL.'/index.php');
	exit;
}
/* Fichiers */
$configJsonFile=BASE_PATH.'/config/config.json';
$configPhpFile=BASE_PATH.'/config/config.php';
/* Config par défaut */
$currentConfig=[
	'carpodrome'=>[
		'statut'=>'ferme',
		'message'=>['fr'=>'','de'=>'','en'=>'']
	],
	'loisirs'=>[
		'statut'=>'ferme',
		'message'=>['fr'=>'','de'=>'','en'=>'']
	],
	'info_du_jour'=>['fr'=>'','de'=>'','en'=>''],
	'temperature'=>''
];
/* Chargement config existante */
if(file_exists($configJsonFile)){
	$currentConfig=array_replace_recursive(
		$currentConfig,
		json_decode(file_get_contents($configJsonFile),true)??[]
	);
}
/* Sauvegarde */
if($_POST){
	/* Statuts */
	$currentConfig['carpodrome']['statut']=$_POST['carpodrome_statut']??'ferme';
	$currentConfig['loisirs']['statut']=$_POST['loisirs_statut']??'ferme';
	/* Messages carpodrome */
	$currentConfig['carpodrome']['message']['fr']=trim($_POST['carpodrome_message_fr']??'');
	$currentConfig['carpodrome']['message']['de']=trim($_POST['carpodrome_message_de']??'');
	$currentConfig['carpodrome']['message']['en']=trim($_POST['carpodrome_message_en']??'');
	/* Messages loisirs */
	$currentConfig['loisirs']['message']['fr']=trim($_POST['loisirs_message_fr']??'');
	$currentConfig['loisirs']['message']['de']=trim($_POST['loisirs_message_de']??'');
	$currentConfig['loisirs']['message']['en']=trim($_POST['loisirs_message_en']??'');
	/* Info du jour */
	$currentConfig['info_du_jour']['fr']=trim($_POST['info_du_jour_fr']??'');
	$currentConfig['info_du_jour']['de']=trim($_POST['info_du_jour_de']??'');
	$currentConfig['info_du_jour']['en']=trim($_POST['info_du_jour_en']??'');
	/* Température */
	$currentConfig['temperature']=trim($_POST['temperature']??'');
	/* Écriture JSON */
	file_put_contents(
		$configJsonFile,
		json_encode($currentConfig,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)
	);
	/* Génération config.php (compatibilité) */
	$carpoOpen=$currentConfig['carpodrome']['statut']==='ouvert'?'true':'false';
	$loisirsOpen=$currentConfig['loisirs']['statut']==='ouvert'?'true':'false';
	$phpConfig=<<<PHP
<?php
define('CARPODROME_OPEN',$carpoOpen);
define('LOISIRS_OPEN',$loisirsOpen);
PHP;
	file_put_contents($configPhpFile,$phpConfig);
	$successMessage='✅ SAUVEGARDÉ !';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8"><!-- Encodage UTF-8 -->
	<title>Admin Remerschen</title><!-- Titre -->
	<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css"><!-- CSS principal -->
	<style>
		body{font-family:Arial;max-width:900px;margin:50px auto;}
		form{background:#f8f9fa;padding:20px;border-radius:8px;}
		select,input,textarea{padding:10px;font-size:16px;width:100%;margin-top:10px;}
		button{background:#007cba;color:#fff;padding:12px 24px;border:none;margin-top:20px;cursor:pointer;}
		.success{background:#d4edda;color:#155724;padding:15px;border:1px solid #c3e6cb;margin-bottom:20px;}
		.bloc{margin-bottom:30px;}
		.lang-grid{display:grid;grid-template-columns:1fr;gap:10px;margin-top:10px;}
		.lang-label{display:block;font-weight:bold;margin-top:10px;}
	</style>
</head>
<body>
	<h1>⚙️ Administration du site</h1>
	<h2>📝 Gestion du contenu</h2>
	<ul>
		<li><a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=news">Actualités</a></li>
		<li><a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=events">Événements publics</a></li>
		<li><a href="<?= BASE_URL ?>/admin/edit-news-events.php?type=carpo-events">Événements carpodrome</a></li>
		<li><a href="<?= BASE_URL ?>/admin/edit-faq.php">FAQ</a></li>
		<li><a href="<?= BASE_URL ?>/admin/admin-change-password.php">🔑 Changer le mot de passe</a></li>
		<li><a href="<?= BASE_URL ?>/admin/admin-files-management.php">🗂️ Gestion des fichiers</a></li>
	</ul>
	<?php if(!empty($successMessage)) echo "<div class='success'>$successMessage</div>"; ?>
	<form method="POST">
		<div class="bloc">
			<h2>🐟 Carpodrome</h2>
			<select name="carpodrome_statut">
				<option value="ouvert" <?= ($currentConfig['carpodrome']['statut']??'ferme')==='ouvert'?'selected':'' ?>>✅ OUVERT</option>
				<option value="ferme" <?= ($currentConfig['carpodrome']['statut']??'ferme')==='ferme'?'selected':'' ?>>❌ FERMÉ</option>
			</select>
			<div class="lang-grid">
				<label class="lang-label" for="carpodrome_message_fr">Message FR</label>
				<textarea id="carpodrome_message_fr" name="carpodrome_message_fr" rows="3" placeholder="Message FR" style="resize:vertical;"><?= htmlspecialchars($currentConfig['carpodrome']['message']['fr']??'') ?></textarea>
				<label class="lang-label" for="carpodrome_message_de">Message DE</label>
				<textarea id="carpodrome_message_de" name="carpodrome_message_de" rows="3" placeholder="Message DE" style="resize:vertical;"><?= htmlspecialchars($currentConfig['carpodrome']['message']['de']??'') ?></textarea>
				<label class="lang-label" for="carpodrome_message_en">Message EN</label>
				<textarea id="carpodrome_message_en" name="carpodrome_message_en" rows="3" placeholder="Message EN" style="resize:vertical;"><?= htmlspecialchars($currentConfig['carpodrome']['message']['en']??'') ?></textarea>
			</div>
		</div>
		<div class="bloc">
			<h2>🚣 Baggerweier</h2>
			<select name="loisirs_statut">
				<option value="ouvert" <?= ($currentConfig['loisirs']['statut']??'ferme')==='ouvert'?'selected':'' ?>>✅ OUVERT</option>
				<option value="ferme" <?= ($currentConfig['loisirs']['statut']??'ferme')==='ferme'?'selected':'' ?>>❌ FERMÉ</option>
			</select>
			<div class="lang-grid">
				<label class="lang-label" for="loisirs_message_fr">Message FR</label>
				<textarea id="loisirs_message_fr" name="loisirs_message_fr" rows="3" placeholder="Message FR" style="resize:vertical;"><?= htmlspecialchars($currentConfig['loisirs']['message']['fr']??'') ?></textarea>
				<label class="lang-label" for="loisirs_message_de">Message DE</label>
				<textarea id="loisirs_message_de" name="loisirs_message_de" rows="3" placeholder="Message DE" style="resize:vertical;"><?= htmlspecialchars($currentConfig['loisirs']['message']['de']??'') ?></textarea>
				<label class="lang-label" for="loisirs_message_en">Message EN</label>
				<textarea id="loisirs_message_en" name="loisirs_message_en" rows="3" placeholder="Message EN" style="resize:vertical;"><?= htmlspecialchars($currentConfig['loisirs']['message']['en']??'') ?></textarea>
			</div>
		</div>
		<div class="bloc">
			<h2>🌡️ Température de l’eau</h2>
			<input name="temperature" placeholder="Ex. : 22°C" value="<?= htmlspecialchars($currentConfig['temperature']??'') ?>">
		</div>
		<div class="bloc">
			<h2>📢 Informations utiles</h2>
			<div class="lang-grid">
				<label class="lang-label" for="info_du_jour_fr">Info FR</label>
				<textarea id="info_du_jour_fr" name="info_du_jour_fr" rows="3" placeholder="Texte FR affiché sur la page d'accueil" style="resize:vertical;"><?= htmlspecialchars($currentConfig['info_du_jour']['fr']??'') ?></textarea>
				<label class="lang-label" for="info_du_jour_de">Info DE</label>
				<textarea id="info_du_jour_de" name="info_du_jour_de" rows="3" placeholder="Texte DE affiché sur la page d'accueil" style="resize:vertical;"><?= htmlspecialchars($currentConfig['info_du_jour']['de']??'') ?></textarea>
				<label class="lang-label" for="info_du_jour_en">Info EN</label>
				<textarea id="info_du_jour_en" name="info_du_jour_en" rows="3" placeholder="Texte EN affiché sur la page d'accueil" style="resize:vertical;"><?= htmlspecialchars($currentConfig['info_du_jour']['en']??'') ?></textarea>
			</div>
		</div>
		<button type="submit">💾 SAUVEGARDER</button>
	</form>
	<p>
		<a href="<?= BASE_URL ?>/index.php">← Accueil</a>
		<a href="<?= BASE_URL ?>/admin.php?logout=1" onclick="return confirm('Déconnexion ?')">🚪 Déconnexion</a>
	</p>
</body>
</html>