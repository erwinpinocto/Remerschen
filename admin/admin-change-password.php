<?php
require __DIR__.'/../bootstrap.php';
if(!isset($_SESSION['admin'])){
    header('Location: '.BASE_URL.'/admin/admin-login.php');
    exit;
}
$error='';
$successMsg='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $current=trim((string)($_POST['pass_current']??''));
    $new=trim((string)($_POST['pass_new']??''));
    $confirm=trim((string)($_POST['pass_confirm']??''));
    if(!password_verify($current,$ADMIN_CONFIG['admin_pass'])){
        $error='Mot de passe actuel incorrect.';
    }elseif($new===''){
        $error='Le nouveau mot de passe est vide.';
    }elseif($new!==$confirm){
        $error='Les mots de passe ne correspondent pas.';
    }else{
        $ADMIN_CONFIG['admin_pass']=password_hash($new,PASSWORD_DEFAULT);
        save_json('config/config-admin.json',$ADMIN_CONFIG);
        $successMsg='✅ Mot de passe modifié.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer le mot de passe</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        body{font-family:Arial;max-width:500px;margin:50px auto;}
        form{background:#f8f9fa;padding:20px;border-radius:8px;}
        input{padding:10px;font-size:16px;width:100%;margin-top:10px;box-sizing:border-box;}
        button{background:#007cba;color:#fff;padding:12px 24px;border:none;margin-top:20px;cursor:pointer;}
        .error{background:#f8d7da;color:#842029;padding:12px;border:1px solid #f5c2c7;margin-bottom:15px;}
        .success{background:#d4edda;color:#155724;padding:12px;border:1px solid #c3e6cb;margin-bottom:15px;}
    </style>
</head>
<body>
    <h1>🔑 Changer le mot de passe</h1>
    <?php if($error!==''): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <?php if($successMsg!==''): ?><div class="success"><?= $successMsg ?></div><?php endif; ?>
    <form method="POST">
        <label>Mot de passe actuel</label>
        <input type="password" name="pass_current">
        <label>Nouveau mot de passe</label>
        <input type="password" name="pass_new">
        <label>Confirmation</label>
        <input type="password" name="pass_confirm">
        <button type="submit">💾 Enregistrer</button>
    </form>
    <p><a href="<?= BASE_URL ?>/admin/admin.php">← Admin</a></p>
</body>
</html>