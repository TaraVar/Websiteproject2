<?php
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

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try {
    $yhteys = mysqli_connect("db", "root", "password", "nocco");
} catch (Exception $e) {
    echo "Tietokantavirhe";
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
