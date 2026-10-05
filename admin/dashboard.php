<?php require_once __DIR__.'/../classes/Database.php';require_once __DIR__.'/../classes/Session.php';require_once __DIR__.'/../classes/AdminAuth.php';Session::start();AdminAuth::requireLogin();$pdo=(new Database())->getConnection();$stmtEntreprises = $pdo->prepare(
    'SELECT COUNT(*) FROM entreprise'
);
$stmtEntreprises->execute();

$stmtOffres = $pdo->prepare(
    'SELECT COUNT(*) FROM offre'
);
$stmtOffres->execute();

$stmtCandidats = $pdo->prepare(
    'SELECT COUNT(*) FROM candidat'
);
$stmtCandidats->execute();

$stmtCandidatures = $pdo->prepare(
    'SELECT COUNT(*) FROM candidature'
);
$stmtCandidatures->execute();

$stats = [
    'entreprises' => $stmtEntreprises->fetchColumn(),
    'offres' => $stmtOffres->fetchColumn(),
    'candidats' => $stmtCandidats->fetchColumn(),
    'candidatures' => $stmtCandidatures->fetchColumn()
];$stmtDernieres = $pdo->prepare("
    SELECT
        ca.id,
        ca.date_candidature,
        ca.statut,
        CONCAT(c.prenom, ' ', c.nom) AS candidat,
        o.titre AS offre
    FROM candidature ca
    INNER JOIN candidat c ON c.id = ca.id_candidat
    INNER JOIN offre o ON o.id = ca.id_offre
    ORDER BY ca.date_candidature DESC
    LIMIT 5
");

$stmtDernieres->execute();

$dernieresCandidatures = $stmtDernieres->fetchAll(PDO::FETCH_ASSOC); ?><!doctype html><html lang="fr"><head><meta charset="UTF-8"><title>Dashboard admin</title></head><body><h1>Dashboard administrateur</h1><p>Bonjour <?=htmlspecialchars(Session::get('admin_nom'))?></p><ul><li>Entreprises: <?= (int)$stats['entreprises'] ?></li>
<li>Offres: <?= (int)$stats['offres'] ?></li>
<li>Candidats: <?= (int)$stats['candidats'] ?></li>
<li>Candidatures: <?= (int)$stats['candidatures'] ?></li></ul> <h2>Les 5 dernières candidatures</h2>

<?php if (empty($dernieresCandidatures)): ?>

    <p>Aucune candidature pour le moment.</p>

<?php else: ?>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Candidat</th>
                <th>Offre</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($dernieresCandidatures as $candidature): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($candidature['candidat']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($candidature['offre']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($candidature['date_candidature']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($candidature['statut']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?><a href="entreprises/index.php">Entreprises</a> | <a href="offres/index.php">Offres</a> | <a href="candidats/index.php">Candidats</a> | <a href="candidatures/index.php">Candidatures</a> | <a href="logout.php">Déconnexion</a></body></html>