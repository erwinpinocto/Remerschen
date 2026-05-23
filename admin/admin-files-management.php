<?php
require __DIR__.'/../bootstrap.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.BASE_URL.'/admin/admin-login.php');
    exit;
}

$imgDir=BASE_PATH.'/assets/img/news_events/';
$jsonFiles=[
    BASE_PATH.'/data/news.json',
    BASE_PATH.'/data/public-events.json',
    BASE_PATH.'/data/carpo-events.json',
];

/* Suppression */
$successMsg='';
$error='';
if(isset($_GET['delete'])){
    $target=basename($_GET['delete']);
    $path=$imgDir.$target;
    if(file_exists($path)&&is_file($path)){
        unlink($path)?$successMsg='✅ Fichier supprimé : '.$target:$error='Impossible de supprimer '.$target;
    }else{
        $error='Fichier introuvable.';
    }
}

/* Collecte des images référencées dans les JSON */
$referenced=[];
foreach($jsonFiles as $jf){
    if(!file_exists($jf)) continue;
    $items=json_decode(file_get_contents($jf),true)??[];
    foreach($items as $item){
        $img=trim((string)($item['image']??''));
        if($img!=='') $referenced[basename($img)]=true;
    }
}

/* Liste des fichiers du dossier */
$files=[];
foreach(scandir($imgDir) as $f){
    if($f==='.'||$f==='..') continue;
    $fp=$imgDir.$f;
    if(!is_file($fp)) continue;
    $files[]=[
        'name'=>$f,
        'size'=>filesize($fp),
        'mtime'=>filemtime($fp),
        'referenced'=>isset($referenced[$f]),
    ];
}
usort($files,fn($a,$b)=>$b['mtime']<=>$a['mtime']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des fichiers</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        body{font-family:Arial;max-width:1000px;margin:40px auto;}
        table{width:100%;border-collapse:collapse;margin-top:20px;}
        th,td{padding:10px;border-bottom:1px solid #ddd;text-align:left;vertical-align:middle;}
        th{background:#f7f7f7;font-weight:700;}
        .badge-ok{background:#d4edda;color:#155724;padding:3px 8px;border-radius:999px;font-size:12px;}
        .badge-orphan{background:#f8d7da;color:#842029;padding:3px 8px;border-radius:999px;font-size:12px;}
        .thumb{max-width:80px;max-height:60px;border-radius:4px;}
        .error{background:#f8d7da;color:#842029;padding:12px;border:1px solid #f5c2c7;margin-bottom:15px;}
        .success{background:#d4edda;color:#155724;padding:12px;border:1px solid #c3e6cb;margin-bottom:15px;}
        .btn-del{background:#dc3545;color:#fff;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;font-size:13px;}
    </style>
</head>
<body>
    <h1>🗂️ Gestion des fichiers</h1>
    <p><a href="<?= BASE_URL ?>/admin/admin.php">← Admin</a></p>
    <?php if($error!==''): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if($successMsg!==''): ?>
        <div class="success"><?= $successMsg ?></div>
    <?php endif; ?>
    <?php if(empty($files)): ?>
        <p>Aucun fichier dans le dossier.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Aperçu</th>
                    <th>Fichier</th>
                    <th>Taille</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($files as $f): ?>
                    <tr>
                        <td><img class="thumb" src="<?= BASE_URL ?>/assets/img/news_events/<?= urlencode($f['name']) ?>" alt=""></td>
                        <td><?= htmlspecialchars($f['name']) ?></td>
                        <td><?= round($f['size']/1024) ?> Ko</td>
                        <td><?= date('d/m/Y',$f['mtime']) ?></td>
                        <td>
                            <?php if($f['referenced']): ?>
                                <span class="badge-ok">✅ utilisé</span>
                            <?php else: ?>
                                <span class="badge-orphan">⚠️ orphelin</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(!$f['referenced']): ?>
                                <a href="?delete=<?= urlencode($f['name']) ?>" onclick="return confirm('Supprimer ce fichier ?')">
                                    <button class="btn-del">🗑️ Supprimer</button>
                                </a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>