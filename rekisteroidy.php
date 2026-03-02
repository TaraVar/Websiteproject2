<?php
if (isset($_POST["tunnus"]) && isset($_POST["salasana"]) &&
    isset($_POST["etunimi"]) && isset($_POST["sukunimi"])) {
        $tunnus=$_POST["tunnus"];
        $salasana=$_POST["salasana"];
        $etunimi=$_POST["etunimi"];
        $sukunimi=$_POST["sukunimi"];
    }
    else{
        header("Location:rekisteröityminen.html");
        exit;
    }

$env = parse_ini_file(DIR . "/.hti-env");
$hash = md5($salasana); 
$sql = "INSERT INTO Users (tunnus, salasana, etunimi, sukunimi) VALUES (?, ?, ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $hash, $etunimi, $sukunimi);
mysqli_stmt_execute($stmt);
exit;
?>
