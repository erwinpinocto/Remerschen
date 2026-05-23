<?php
// Chemin disque
define('BASE_PATH', __DIR__);
// Détection simple de l’URL racine du projet
$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
// En local, le projet est servi depuis /baggerweier
if (strpos($scriptName, '/baggerweier/') === 0 || $scriptName === '/baggerweier') {
    define('BASE_URL', '/baggerweier');
} else {
    // En production, le site est à la racine du domaine
    define('BASE_URL', '');
}
// Gestion des erreurs (dev uniquement)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Encodage
header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
// Session
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

$headerPages = [
	'home'=>['title'=>'home.title','nav'=>'nav.home','show_in_nav'=>true],
	'loisirs'=>['title'=>'loisirs.title','nav'=>'nav.loisirs','show_in_nav'=>true],
	'carpodrome'=>['title'=>'carpodrome.title','nav'=>'nav.carpodrome','show_in_nav'=>true],
	'about'=>['title'=>'about.title','nav'=>'nav.about','show_in_nav'=>true],
	'news'=>['title'=>'news.title','nav'=>'nav.news','show_in_nav'=>true],
	'events'=>['title'=>'events.title','nav'=>'nav.events','show_in_nav'=>true],
	'contact'=>['title'=>'contact.title','nav'=>'nav.contact','show_in_nav'=>true],
	'faq'=>['title'=>'faq.title','nav'=>'nav.faq','show_in_nav'=>true],
	'partners'=>['title'=>'partners.title','nav'=>'nav.partners','show_in_nav'=>true],
	'jobs'=>['title'=>'jobs.title','nav'=>'nav.jobs','show_in_nav'=>true],
	'ateliers'=>['title'=>'ateliers.title','nav'=>'nav.ateliers','show_in_nav'=>false],
	'teambuilding'=>['title'=>'teambuilding.title','nav'=>'nav.teambuilding','show_in_nav'=>false],
	'zones'=>['title'=>'zones.title','nav'=>'nav.zones','show_in_nav'=>false],
	'visitmosel'=>['title'=>'visitmosel.title','nav'=>'nav.visitmosel','show_in_nav'=>false],
];

// Multilingue : paramètres de base
$LANG_ALLOWED = ['fr', 'en', 'de'];
$LANG_DEFAULT = 'fr';
$currentPage = $_GET['page'] ?? 'home';
// Multilingue : langue active
if (isset($_GET['lang']) && in_array($_GET['lang'], $LANG_ALLOWED, true)) $_SESSION['lang'] = $_GET['lang'];
$lang = $_SESSION['lang'] ?? $LANG_DEFAULT;
if (!in_array($lang, $LANG_ALLOWED, true)) $lang = $LANG_DEFAULT;
$_SESSION['lang'] = $lang;
// Mode debug persistant (?debug=1 / ?nodebug=1)
if (isset($_GET['debug'])) $_SESSION['debug'] = true;
if (isset($_GET['nodebug'])) unset($_SESSION['debug']);
// Fonction de chargement JSON sécurisé
function load_json(string $file, array $default = []): array {
    $path = BASE_PATH . '/' . ltrim($file, '/');
    if (!file_exists($path)) return $default;
    $json = file_get_contents($path);
    if ($json === false) return $default;
    // Suppression BOM UTF-8 éventuel
    if (substr($json, 0, 3) === "\xEF\xBB\xBF") $json = substr($json, 3);
    $data = json_decode($json, true);
    return is_array($data) ? $data : $default;
}
// Fonction de sauvegarde JSON
function save_json(string $file, array $data): bool {
    $path = BASE_PATH . '/' . ltrim($file, '/');
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    return $json !== false && file_put_contents($path, $json) !== false;
}
// Chargement d’un fichier langue PHP
function load_lang_file(string $lang, string $file): array {
	$path = BASE_PATH . '/lang/' . $lang . '/' . ltrim($file, '/');
	if (!file_exists($path)) return [];
	$data = require $path;
	return is_array($data) ? $data : [];
}
// Fusion récursive des tableaux de langue
function merge_lang_arrays(array $base, array $override): array {
	foreach ($override as $key => $value) {
		if (is_array($value) && isset($base[$key]) && is_array($base[$key])) {
			$base[$key] = merge_lang_arrays($base[$key], $value);
		} else {
			$base[$key] = $value;
		}
	}
	return $base;
}
// Lecture d’une clé pointée : home.title
function array_get_dot(array $array, string $key, $default = null) {
	$parts = explode('.', $key);
	$value = $array;
	foreach ($parts as $part) {
		if (!is_array($value) || !array_key_exists($part, $value)) return $default;
		$value = $value[$part];
	}
	return $value;
}
// Traduction simple
function t(string $key): string {
	global $TRAD;
	$value = array_get_dot($TRAD, $key, null);
	return (is_string($value) && $value !== '') ? $value : $key;
}
// Fallback JSON multilingue
function tr(array $item, string $lang, string $fallback = 'fr'): array {
	$translations = $item['translations'] ?? [];
	$base = (isset($translations[$fallback]) && is_array($translations[$fallback])) ? $translations[$fallback] : [];
	$current = (isset($translations[$lang]) && is_array($translations[$lang])) ? $translations[$lang] : [];
	foreach ($current as $key => $value) {
		if (is_array($value)) {
			if (!empty($value)) $base[$key] = $value;
		} else {
			if ($value !== null && $value !== '') $base[$key] = $value;
		}
	}
	return $base;
}
// Fichiers langue à charger
$langFiles=['commons.php','pages.php','documents.php','rates.php'];
// Chargement des traductions avec fallback FR
$TRAD=[];
foreach($langFiles as $file){
	$TRAD=merge_lang_arrays($TRAD,load_lang_file($LANG_DEFAULT,$file));
}
if($lang!==$LANG_DEFAULT){
	foreach($langFiles as $file){
		$TRAD=merge_lang_arrays($TRAD,load_lang_file($lang,$file));
	}
}
// Chargement des configs PHP
require BASE_PATH . '/config/config.php';
// Chargement des configs JSON
$CONFIG       = load_json('config/config.json');
$ADMIN_CONFIG = load_json('config/config-admin.json');
$RATES        = load_json('data/rates.json');
// Flag pratique pour le debug
$DEBUG_LAYOUT = !empty($_SESSION['debug']);