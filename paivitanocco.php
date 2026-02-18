<?php

$json = isset($_POST["nocco"]) ? $_POST["nocco"] : "";

if (!($nocco = tarkistaJson($json))){
    print "Täytä kaikki kentät";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try{
    $yhteys = mysqli_connect("db", "root", "password", "nocco");
}
catch(Exception $e){
    print "Yhteysvirhe";
    exit;
}

$tulos = mysqli_query($yhteys, "SELECT * FROM bcaa");

while ($rivi = mysqli_fetch_object($tulos)) {
    $Nocco = new class{};
    $Nocco->id = $rivi->id;
    $Nocco->maku = $rivi->maku;
    $Nocco->kuvaus = $rivi->kuvaus;
    $Nocco->kuva = $rivi->kuva;

    $bcaa[] = $Nocco;
}

$tulos = mysqli_query($yhteys, "SELECT * FROM focus");

while ($rivi = mysqli_fetch_object($tulos)) {
    $Nocco = new class{};
    $Nocco->id = $rivi->id;
    $Nocco->maku = $rivi->maku;
    $Nocco->kuvaus = $rivi->kuvaus;
    $Nocco->kuva = $rivi->kuva;

    $focus[] = $Nocco;
}

mysqli_close($yhteys)
print json_encode([
    "bcaa" => $bcaa,
    "focus" => $focus
]);

?>

<?php
function tarkistaJson($json){
    if (empty($json)){
        return false;
    }

    $nocco = json_decode($json, false);

    if (empty($nocco->id)||empty($nocco->maku)||empty($nocco->kuvaus)||empty($nocco->kuva)) {
        return false;
    }

    return $nocco;
}
?>
