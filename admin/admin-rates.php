<?php
require __DIR__.'/../bootstrap.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.BASE_URL.'/admin/admin-login.php');
    exit;
}

$error='';
$successMsg='';

/* Chargement */
$rates=load_json('data/rates.json');

/* Sauvegarde */
if($_SERVER['REQUEST_METHOD']==='POST'){
    foreach($rates as $section=>&$sectionData){
        foreach($sectionData['sections'] as &$bloc){
            foreach($bloc['lignes'] as &$ligne){
                if($ligne['prix']==='') continue;
                $key=$section.'__'.$bloc['id'].'__'.$ligne['id'];
                if(isset($_POST[$key])){
                    $ligne['prix']=trim((string)$_POST[$key]);
                }
            }
        }
    }
    unset($sectionData,$bloc,$ligne);
    if(save_json('data/rates.json',$rates)){
        $successMsg='✅ Tarifs enregistrés.';
    }else{
        $error='Impossible d\'enregistrer le fichier JSON.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des tarifs</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        body{font-family:Arial;max-width:900px;margin:40px auto;}
        h2{margin-top:30px;}
        h3{margin-top:20px;color:#555;}
        table{width:100%;border-collapse:collapse;margin-top:10px;}
        th,td{padding:10px;border-bottom:1px solid #ddd;text-align:left;}
        th{background:#f7f7f7;font-weight:700;}
        input[type="text"]{padding:6px 10px;font-size:15px;width:100px;border:1px solid #ccc;border-radius:6px;}
        button{margin-top:20px;padding:10px 24px;background:#007cba;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:15px;}
        .error{background:#f8d7da;color:#842029;padding:12px;border:1px solid #f5c2c7;margin-bottom:15px;}
        .success{background:#d4edda;color:#155724;padding:12px;border:1px solid #c3e6cb;margin-bottom:15px;}
        .section-bloc{background:#f8f9fa;border:1px solid #ddd;border-radius:8px;padding:15px;margin-bottom:20px;}
        .cat-label{font-weight:700;color:#333;}
    </style>
</head>
<body>
    <h1>💶 Gestion des tarifs</h1>
    <p><a href="<?= BASE_URL ?>/admin/admin.php">← Admin</a></p>
    <?php if($error!==''): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if($successMsg!==''): ?><div class="success"><?= $successMsg ?></div><?php endif; ?>
    <form method="POST">
        <?php foreach($rates as $sectionKey=>$sectionData): ?>
            <h2><?= htmlspecialchars(t($sectionData['title_key'])) ?></h2>
            <?php foreach($sectionData['sections'] as $bloc): ?>
                <div class="section-bloc">
                    <h3><?= htmlspecialchars(t($bloc['title_key'])) ?></h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Prestation</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($bloc['lignes'] as $ligne): ?>
                                <tr>
                                    <td class="<?= $ligne['prix']===''?'cat-label':'' ?>">
                                        <?= htmlspecialchars(t($ligne['label_key'])) ?>
                                    </td>
                                    <td>
                                        <?php if($ligne['prix']!==''): ?>
                                            <input
                                                type="text"
                                                name="<?= htmlspecialchars($sectionKey.'__'.$bloc['id'].'__'.$ligne['id']) ?>"
                                                value="<?= htmlspecialchars($ligne['prix']) ?>"
                                            >
                                        <?php else: ?>
                                            —
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <button type="submit">💾 Enregistrer</button>
    </form>
</body>
</html>