<?php

require_once __DIR__ . '/../../classes/Database.php';
require_once __DIR__ . '/../../classes/Session.php';
require_once __DIR__ . '/../../classes/AdminAuth.php';

Session::start();
AdminAuth::requireLogin();

$pdo = (new Database())->getConnection();

$stmt = $pdo->prepare("
    SELECT id, libelle
    FROM secteur
    ORDER BY libelle ASC
");

$stmt->execute();

$secteurs = $stmt->fetchAll();

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Secteurs - JobLink Bénin</title>
</head>

<body>

<h1>Gestion des secteurs</h1>

<p>
    <a href="create.php">➕ Ajouter un secteur</a>
</p>

<table border="1" cellpadding="8">
    <thead>
        <tr>
            <th>ID</th>
            <th>Libellé</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($secteurs as $secteur): ?>

        <tr>
            <td>
                <?= (int) $secteur['id'] ?>
            </td>

            <td>
                <?= htmlspecialchars($secteur['libelle']) ?>
            </td>

            <td>
                <a href="edit.php?id=<?= (int) $secteur['id'] ?>">
                    ✏️ Modifier
                </a>

                |

               <form method="post" action="delete.php" style="display:inline;" onsubmit="return confirm('Supprimer ce secteur ?');">
    <input type="hidden" name="id" value="<?= (int)$secteur['id'] ?>">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(Session::csrfToken()) ?>">

    <button type="submit">
        Supprimer
    </button>
</form>
                 
            </td>
        </tr>

    <?php endforeach; ?>

    </tbody>
</table>

<br>

<a href="../dashboard.php">← Retour au dashboard</a>

</body>
</html>