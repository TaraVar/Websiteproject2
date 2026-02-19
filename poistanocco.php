<?php
require "db.php";

// Sallitaan vain POST-pyynnöt
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die("Virhe: Vain POST-pyynnöt sallittu.");
}

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    http_response_code(403);
    die("Virhe: CSRF-tarkistus epäonnistui.");
}

// Tarkistetaan että id ja table on annettu
if (!isset($_POST['id']) || !isset($_POST['table'])) {
    http_response_code(400);
    die("Virhe: ID tai taulu puuttuu.");
}

$id = intval($_POST['id']);
$table = $_POST['table'];

// Sallitut taulut (whitelist)
$allowedTables = ["bcaa", "focus"];

if (!in_array($table, $allowedTables, true)) {
    http_response_code(400);
    die("Virhe: Taulu ei ole sallittu.");
}

// Valmisteltu poisto
$stmt = $pdo->prepare("DELETE FROM $table WHERE id = ?");
$stmt->execute([$id]);

// Palautetaan takaisin listaukseen
header("Location: listaus.php");
exit;
?>
