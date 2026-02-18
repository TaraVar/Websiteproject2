<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "nocco");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

# BCAA
$tulos=mysqli_query($yhteys, "select * from bcaa");

print "<h2 class='tuoteotsikko'>BCAA-SARJA</h2>";
print "<div class='tuoterivi'>";

while ($rivi = mysqli_fetch_object($tulos)) {
    print '
        <div class="tuotekortti">
            <img src="Images/'.$rivi->kuva.'" width="200" onclick="naytaTuote('.$rivi->id.', \'bcaa\')">
        </div>
    ';
}

print "</div>";

# FOCUS
$tulos=mysqli_query($yhteys, "select * from focus");

print "<h2 class='tuoteotsikko'>FOCUS-SARJA</h2>";
print "<div class='tuoterivi'>";

while ($rivi = mysqli_fetch_object($tulos)) {
    print '
        <div class="tuotekortti">
            <img src="Images/'.$rivi->kuva.'" width="200" onclick="naytaTuote('.$rivi->id.', \'focus\')">
        </div>
    ';
}

print "</div>";

mysqli_close($yhteys);
?>
