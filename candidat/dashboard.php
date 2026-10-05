<?php

require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Session.php';

Session::start();

if (!Session::get('candidat_connecte')) {
    header('Location: login.php');
    exit;
}

$pdo = (new Database())->getConnection();

$candidatId = (int) Session::get('candidat_id');

$stmt = $pdo->prepare("
    SELECT
        SUM(statut = 'en_attente') AS en_attente,
        SUM(statut = 'retenue') AS retenues,
        SUM(statut = 'refusee') AS refusees
    FROM candidature
    WHERE id_candidat = :id_candidat
");

$stmt->execute([
    'id_candidat' => $candidatId
]);

$stats = $stmt->fetch(PDO::FETCH_ASSOC);

$enAttente = (int) ($stats['en_attente'] ?? 0);
$retenues = (int) ($stats['retenues'] ?? 0);
$refusees = (int) ($stats['refusees'] ?? 0);

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Tableau de bord candidat - JobLink Bénin</title>
</head>

<body>

<h1>Tableau de bord</h1>

<p>
    Bienvenue <?= htmlspecialchars(Session::get('candidat_nom')) ?>.
</p>

<h2>Mes candidatures</h2>

<p>
    🟠 En attente :
    <strong><?= $enAttente ?></strong>
</p>

<p>
    🟢 Retenues :
    <strong><?= $retenues ?></strong>
</p>

<p>
    🔴 Refusées :
    <strong><?= $refusees ?></strong>
</p>

<hr>

<a href="profil.php">Mon profil</a>
<br>

<a href="offres.php">Rechercher une offre</a>
<br>

<a href="candidatures.php">Mes candidatures</a>
<br>

<a href="logout.php">Déconnexion</a>

</body>

</html>