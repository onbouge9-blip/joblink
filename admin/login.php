<?php require_once __DIR__.'/../classes/Database.php';require_once __DIR__.'/../classes/Auth.php';require_once __DIR__.'/../classes/Session.php';Session::start();$err='';if($_SERVER['REQUEST_METHOD']==='POST'){ if (!Session::verifyCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Requête invalide.');
} $q=(new Database())->getConnection()->prepare('SELECT * FROM administrateur WHERE email=:e LIMIT 1');$q->execute(['e'=>trim($_POST['email']??'')]);$a=$q->fetch();if($a&&Auth::verifyPassword($_POST['mot_de_passe']??'',$a['mot_de_passe'])){
    Session::regenerate();
Session::set('admin_id', (int)$a['id']);
Session::set('admin_connecte', true);
Session::set('admin_nom', $a['prenom'] . ' ' . $a['nom']);
header('Location: dashboard.php');
exit;}$err='Identifiants incorrects.';}?><!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Admin</title>    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head><body><h1>Connexion administrateur</h1><?php if($err):?><p class="alert alert-error"><?=htmlspecialchars($err)?></p><?php endif;?><form method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::csrfToken()) ?>"><input type="email" name="email" required><input type="password" name="mot_de_passe" required><button>Se connecter</button></form></body></html>