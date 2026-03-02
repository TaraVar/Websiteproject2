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

$env = parse_ini_file(__DIR__ . "/.hti-env");

$yhteys = mysqli_connect(
    $env["DB_HOST"],
    $env["DB_USER"],
    $env["DB_PASS"],
    $env["DB_NAME"]
);


$hash = md5($salasana); 
$sql = "INSERT INTO Users (tunnus, salasana, etunimi, sukunimi) VALUES (?, ?, ?, ?)";
$stmt=mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $hash, $etunimi, $sukunimi);
mysqli_stmt_execute($stmt);
exit;
?>
