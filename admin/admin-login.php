<?php
// 🔐 LOGIN ADMIN SÉCURISÉ
require __DIR__ . '/../bootstrap.php';
// session_start();
// 🔹 Déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . BASE_URL . '/index.php'); // accueil à la racine
    exit;
}
// 🔹 Redirection si déjà connecté
if (isset($_SESSION['admin'])) {
    header('Location: ' . BASE_URL . '/admin/admin.php'); // admin.php dans public
    exit;
}
$error = '';
// 🔹 Chargement config admin
$config = load_json('config/config-admin.json');
if ($_POST) {
    if (
        ($_POST['user'] ?? '') === ($config['admin_user'] ?? '') &&
        password_verify($_POST['pass'] ?? '', $config['admin_pass'] ?? '')
    ) {
        $_SESSION['admin'] = true;
        header('Location: ' . BASE_URL . '/admin/admin.php');
        exit;
    }
    $error = '❌ Identifiants incorrects';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🔐 Admin Erliefnis Baggerweier</title>
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
<style>
body { font-family: Arial, sans-serif; background: #f8f9fa; }
.login {
    max-width: 400px; margin: 100px auto; padding: 40px;
    background: #fff; border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; }
button { width: 100%; padding: 15px; background: #007cba; color: #fff; border: none; border-radius: 5px; font-size: 16px; cursor: pointer; }
button:hover { background: #005a87; }
.error { color: #dc3545; font-size: 16px; margin: 10px 0; text-align: center; }
</style>
</head>
<body>
<div class="login">
    <h2>🔐 Administration</h2>
    <h3>Erliefnis Baggerweier</h3>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <input type="text" name="user" placeholder="Utilisateur" required>
        <input type="password" name="pass" placeholder="Mot de passe" required>
        <button type="submit">🚀 CONNEXION</button>
    </form>
    <p style="margin-top: 20px; font-size: 14px; text-align:center;">
        <a href="<?= BASE_URL ?>/index.php">← Retour à l'accueil</a>
    </p>
</div>
</body>
</html>
