<?php
$json = isset($_POST["nocco"]) ? $_POST["nocco"] : "";

if (!($nocco = tarkistaJson($json))) {
    print "Täytä kaikki kentät";
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try {
    $yhteys = mysqli_connect("db", "root", "password", "nocco");
} catch (Exception $e) {
    print "Yhteysvirhe";
    exit;
}

$taulu = $nocco->taulu;

if ($taulu === "bcaa") {
    mysqli_query($yhteys,
        "UPDATE bcaa SET 
            maku='$nocco->maku',
            kuvaus='$nocco->kuvaus',
            kuva='$nocco->kuva'
         WHERE id=$nocco->id"
    );
}

if ($taulu === "focus") {
    mysqli_query($yhteys,
        "UPDATE focus SET 
            maku='$nocco->maku',
            kuvaus='$nocco->kuvaus',
            kuva='$nocco->kuva'
         WHERE id=$nocco->id"
    );
}


// BCAA
$bcaa = [];
$tulos = mysqli_query($yhteys, "SELECT * FROM bcaa");
while ($rivi = mysqli_fetch_object($tulos)) {
    $bcaa[] = $rivi;
}

// FOCUS
$focus = [];
$tulos = mysqli_query($yhteys, "SELECT * FROM focus");
while ($rivi = mysqli_fetch_object($tulos)) {
    $focus[] = $rivi;
}

mysqli_close($yhteys);

print json_encode([
    "bcaa" => $bcaa,
    "focus" => $focus
]);

function tarkistaJson($json) {
    if (empty($json)) {
        return false;
    }

    $nocco = json_decode($json, false);

    if (
        empty($nocco->id) ||
        empty($nocco->maku) ||
        empty($nocco->kuvaus) ||
        empty($nocco->kuva) ||
        empty($nocco->taulu)   
    ) {
        return false;
    }

    return $nocco;
}


?>
