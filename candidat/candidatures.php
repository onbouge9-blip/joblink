<?php
require_once __DIR__.'/../classes/Database.php';
require_once __DIR__.'/../classes/Session.php';

Session::start();

if (!Session::get('candidat_connecte')) {
    header('Location: login.php');
    exit;
}

$pdo = (new Database())->getConnection();
$cid = (int) Session::get('candidat_id');
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Session::verifyCsrf($_POST['csrf_token'] ?? null)) {
        http_response_code(403);
        exit('Requête invalide.');
    }

    $idCandidature = (int) ($_POST['id_candidature'] ?? 0);

    $q = $pdo->prepare(
        "UPDATE candidature
         SET statut = 'refusee'
         WHERE id = :id
         AND id_candidat = :c
         AND statut = 'en_attente'"
    );

    $q->execute([
        'id' => $idCandidature,
        'c' => $cid
    ]);

    $msg = $q->rowCount()
        ? 'Candidature retirée.'
        : 'Candidature non modifiable.';
}

$q = $pdo->prepare(
    'SELECT
        c.id,
        c.statut,
        c.date_candidature,
        o.titre,
        e.nom entreprise
     FROM candidature c
     JOIN offre o ON c.id_offre = o.id
     JOIN entreprise e ON o.id_entreprise = e.id
     WHERE c.id_candidat = :c
     ORDER BY c.date_candidature DESC'
);

$q->execute(['c' => $cid]);

$rows = $q->fetchAll();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes candidatures</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<h1>Mes candidatures</h1>

<?php if ($msg): ?>
    <p class="alert alert-success"><?= htmlspecialchars($msg) ?></p>
<?php endif; ?>

<?php foreach ($rows as $r): ?>

    <article>
        <h2><?= htmlspecialchars($r['titre']) ?></h2>

        <p>
            <?= htmlspecialchars($r['entreprise']) ?>
            —
            <?= htmlspecialchars($r['statut']) ?>
        </p>

        <?php if ($r['statut'] === 'en_attente'): ?>

            <form method="post">
                <input
                    type="hidden"
                    name="id_candidature"
                    value="<?= (int) $r['id'] ?>"
                >

                <input
                    type="hidden"
                    name="csrf_token"
                    value="<?= htmlspecialchars(Session::csrfToken()) ?>"
                >

                <button type="submit">Retirer</button>
            </form>

        <?php endif; ?>

    </article>

<?php endforeach; ?>

<a href="dashboard.php">Retour</a>

</body>
</html>
