<?php

require_once __DIR__ . '/../../classes/Database.php';
require_once __DIR__ . '/../../classes/Session.php';
require_once __DIR__ . '/../../classes/AdminAuth.php';

Session::start();
AdminAuth::requireLogin();

$pdo = (new Database())->getConnection();

$stmt = $pdo->prepare("
    SELECT id, libelle
    FROM ville
    ORDER BY libelle ASC
");

$stmt->execute();

$villes = $stmt->fetchAll();

?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Villes - JobLink Bénin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>

<h1>Gestion des villes</h1>

<p>
    <a href="create.php">➕ Ajouter une ville</a>
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

    <?php foreach ($villes as $ville): ?>

        <tr>

            <td>
                <?= (int) $ville['id'] ?>
            </td>

            <td>
                <?= htmlspecialchars($ville['libelle']) ?>
            </td>

            <td>

                <a href="edit.php?id=<?= (int) $ville['id'] ?>">
                    ✏️ Modifier
                </a>

                |

               <form method="post" action="delete.php" class="form-inline" onsubmit="return confirm('Supprimer cette ville ?');">
    <input type="hidden" name="id" value="<?= (int)$ville['id'] ?>">
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

<a href="../dashboard.php">
    ← Retour au dashboard
</a>

</body>

</html>