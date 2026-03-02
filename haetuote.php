<?php
$id = $_GET["id"];
$taulu = $_GET["taulu"]; // bcaa tai focus

$env = parse_ini_file(DIR . "/.hti-env");

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
