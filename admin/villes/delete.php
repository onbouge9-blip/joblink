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
    exit('Ville invalide.');
}

$stmt = $pdo->prepare("
    SELECT COUNT(*)
    FROM candidat
    WHERE id_ville = :id
");
$stmt->execute(['id' => $id]);

if ((int)$stmt->fetchColumn() > 0) {
    exit('Impossible de supprimer cette ville car elle est utilisée par un candidat.');
}

$stmt = $pdo->prepare("
    SELECT COUNT(*)
    FROM entreprise
    WHERE id_ville = :id
");
$stmt->execute(['id' => $id]);

if ((int)$stmt->fetchColumn() > 0) {
    exit('Impossible de supprimer cette ville car elle est utilisée par une entreprise.');
}

$stmt = $pdo->prepare("
    SELECT COUNT(*)
    FROM offre
    WHERE id_ville = :id
");
$stmt->execute(['id' => $id]);

if ((int)$stmt->fetchColumn() > 0) {
    exit('Impossible de supprimer cette ville car elle est utilisée par une offre.');
}

$stmt = $pdo->prepare("
    DELETE FROM ville
    WHERE id = :id
");
$stmt->execute(['id' => $id]);

header('Location: index.php');
exit;