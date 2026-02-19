<?php
$id = $_GET["id"];
$taulu = $_GET["taulu"]; // bcaa tai focus

$yhteys = mysqli_connect("db", "root", "password", "nocco");

$sql = "SELECT * FROM $taulu WHERE id=$id";
$tulos = mysqli_query($yhteys, $sql);
$rivi = mysqli_fetch_object($tulos);

echo "<h2>$rivi->maku</h2>";
echo "<p>$rivi->kuvaus</p>";
echo "<img src='Images/$rivi->kuva' width='200'>";

//Haetaan arvot ja avaa vain tietyn tuotteen.
?>
