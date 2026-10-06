<?php

require_once __DIR__.'/../../classes/Database.php';
require_once __DIR__.'/../../classes/Session.php';
require_once __DIR__.'/../../classes/AdminAuth.php';

Session::start();
AdminAuth::requireLogin();

$pdo = (new Database())->getConnection();

$stmt = $pdo->prepare("
    SELECT
        o.id,
        o.titre,
        o.statut,
        o.date_limite,
        e.nom AS entreprise
    FROM offre o
    JOIN entreprise e ON o.id_entreprise = e.id
    ORDER BY o.id DESC
");

$stmt->execute();

$r = $stmt->fetchAll();

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Offres - Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Offres</h1>

<p>
    <a href="create.php">➕ Ajouter une offre</a>
</p>

<table border="1" cellpadding="8">

    <tr>
        <th>Titre</th>
        <th>Entreprise</th>
        <th>Statut</th>
        <th>Date limite</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($r as $x): ?>

        <tr>

            <td>
                <?= htmlspecialchars($x['titre']) ?>
            </td>

            <td>
                <?= htmlspecialchars($x['entreprise']) ?>
            </td>

            <td>
                <?= htmlspecialchars($x['statut']) ?>
            </td>

            <td>
                <?= htmlspecialchars($x['date_limite']) ?>
            </td>

            <td>

                <a href="edit.php?id=<?= (int)$x['id'] ?>">
                    ✏️ Modifier
                </a>

                |

                <form method="post" action="delete.php" class="form-inline" onsubmit="return confirm('Supprimer cette offre ?');">
    <input type="hidden" name="id" value="<?= (int)$x['id'] ?>">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::csrfToken()) ?>">

    <button type="submit" class="btn btn-danger btn-sm">
        Supprimer
    </button>
</form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<p>
    <a href="../dashboard.php">← Retour au dashboard</a>
</p>

</body>

</html>