<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "nocco");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}
$tulos=mysqli_query($yhteys, "select * from bcaa");

print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr>
        <td>$rivi->id</td>
        <td>$rivi->maku</td>
        <td>$rivi->kuvaus</td>
        <td><img src='Images/$rivi->kuva' width='80'></td>
      </tr>";

}

$tulos=mysqli_query($yhteys, "select * from focus");

print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)){
    print "<tr>
        <td>$rivi->id</td>
        <td>$rivi->maku</td>
        <td>$rivi->kuvaus</td>
        <td><img src='Images/$rivi->kuva' width='80'></td>
      </tr>";

}

print "</table>";
mysqli_close($yhteys);
?>