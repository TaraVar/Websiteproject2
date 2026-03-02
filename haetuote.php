<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$env = parse_ini_file(__DIR__ . "/.hti-env");

$yhteys = mysqli_connect(
    $env["DB_HOST"],
    $env["DB_USER"],
    $env["DB_PASS"],
    $env["DB_NAME"]
);
$id = $_GET["id"];
$taulu = $_GET["taulu"]; // bcaa tai focus


$sql = "SELECT * FROM $taulu WHERE id=$id";
$tulos = mysqli_query($yhteys, $sql);
$rivi = mysqli_fetch_object($tulos);

echo "<h2>$rivi->maku</h2>";
echo "<p>$rivi->kuvaus</p>";
echo "<img src='Images/$rivi->kuva' width='200'><br><br>";
echo "<button onclick=\"poistaNocco($rivi->id, '$taulu')\">Poista tuote</button>";
//Nää neljä echoa lisätty nocon poisto ominaisuuteen. 

//Haetaan arvot ja avaa vain tietyn tuotteen.
?>
