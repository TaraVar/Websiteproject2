<?php
session_start();

if (!isset($_SESSION["user_ok"])){
	$_SESSION["paluuosoite"]="Tuotteet.html";
	header("Location:Tuotteet.html");
	exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$env = parse_ini_file(__DIR__ . "/.hti-env");

$yhteys = mysqli_connect(
    $env["DB_HOST"],
    $env["DB_USER"],
    $env["DB_PASS"],
    $env["DB_NAME"]
);


function tarkistaJson($json) {
    if (empty($json)) {
        return false;
    }

    $obj = json_decode($json);

    if (
        !isset($obj->id) || !is_numeric($obj->id) ||
        !isset($obj->taulu) || !in_array($obj->taulu, ["bcaa", "focus"])
    ) {
        return false;
    }

    $obj->id = (int)$obj->id;
    return $obj;
}

$json = $_POST["nocco"] ?? "";
$nocco = tarkistaJson($json);

if (!$nocco) {
    echo "Virheellinen data";
    exit;
}


$taulu = $nocco->taulu;
$id = $nocco->id;

$sql = "DELETE FROM $taulu WHERE id = ?";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Tuote poistettu onnistuneesti.";
} else {
    echo "Tuotetta ei löytynyt tai sitä ei voitu poistaa.";
}

mysqli_close($yhteys);
?>
