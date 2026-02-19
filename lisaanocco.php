<?php

function tarkistaJson($json) {
    if ($json == "") return false;

    $obj = json_decode($json);
    if (!$obj) return false;

    if (
        !isset($obj->maku) || $obj->maku == "" ||
        !isset($obj->kuvaus) || $obj->kuvaus == "" ||
        !isset($obj->kuva) || $obj->kuva == "" ||
        !isset($obj->taulu) || $obj->taulu == ""
    ) return false;

    return $obj;
}
//Tarkistaa, että kaikissa kohdissa on tekstiä, jos ei niin false.

$json = $_POST["nocco"] ?? "";
$nocco = tarkistaJson($json);

if (!$nocco) {
    print "Täytä kaikki kentät";
    exit;
}
//Haetaan nocco ja ei löydy niin virhe.
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$yhteys = mysqli_connect("db", "root", "password", "nocco"); //Tietokanta

$taulu = $nocco->taulu; // bcaa tai focus

$sql = "INSERT INTO $taulu (maku, kuvaus, kuva) VALUES (?, ?, ?)";
$stmt = mysqli_prepare($yhteys, $sql);

mysqli_stmt_bind_param($stmt, 'sss', $nocco->maku, $nocco->kuvaus, $nocco->kuva);
mysqli_stmt_execute($stmt);

mysqli_close($yhteys);

print "Lisätty tauluun: $taulu";
// Lisätään oikeisiin tauluihin oikeat arvot.
?>
