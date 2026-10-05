<?php

require_once __DIR__ . '/../../classes/Database.php';
require_once __DIR__ . '/../../classes/Session.php';
require_once __DIR__ . '/../../classes/AdminAuth.php';

Session::start();
AdminAuth::requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Méthode non autorisée.');
}

if (!Session::verifyCsrf($_POST['csrf_token'] ?? null)) {
    exit('Jeton CSRF invalide.');
}

$pdo = (new Database())->getConnection();

$id = (int)($_POST['id'] ?? 0);

if ($id <= 0) {
    exit('Offre invalide.');
}

$q = $pdo->prepare("
    SELECT COUNT(*)
    FROM candidature
    WHERE id_offre = :id
");
$q->execute(['id' => $id]);

$nombreCandidatures = (int)$q->fetchColumn();

if ($nombreCandidatures > 0) {
    exit(
        'Impossible de supprimer cette offre car elle possède '
        . $nombreCandidatures
        . ' candidature(s).'
    );
}

$q = $pdo->prepare("
    DELETE FROM offre
    WHERE id = :id
");
$q->execute(['id' => $id]);

header('Location: index.php');
exit;