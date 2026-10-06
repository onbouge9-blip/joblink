<?php require_once __DIR__.'/../classes/Database.php';require_once __DIR__.'/../classes/Auth.php';require_once __DIR__.'/../classes/Session.php';Session::start();if(Session::get('candidat_connecte')){header('Location: dashboard.php');exit;}$err='';if($_SERVER['REQUEST_METHOD']==='POST'){ if (!Session::verifyCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Requête invalide.');
}try{$pdo=(new Database())->getConnection();$q=$pdo->prepare("SELECT * FROM candidat WHERE email=:e AND statut='actif' LIMIT 1");$q->execute(['e'=>trim($_POST['email']??'')]);$c=$q->fetch();if ($c && Auth::verifyPassword($_POST['mot_de_passe'] ?? '', $c['mot_de_passe'])) {
    Session::regenerate();

    Session::set('candidat_id', (int)$c['id']);
    Session::set('candidat_connecte', true);
    Session::set('candidat_nom', $c['prenom'] . ' ' . $c['nom']);

    header('Location: dashboard.php');
    exit;
} $err='E-mail ou mot de passe incorrect.';}catch(PDOException $e){$err='Erreur de connexion.';}}?><!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Connexion candidat</title>    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head><body><h1>Connexion candidat</h1><?php if($err):?><p class="alert alert-error"><?=htmlspecialchars($err)?></p><?php endif;?><form method="post"><input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::csrfToken()) ?>"><input type="email" name="email" required><input type="password" name="mot_de_passe" required><button>Se connecter</button></form><a href="inscription.php">Créer un compte</a></body></html>