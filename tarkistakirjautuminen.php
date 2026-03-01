<?php
session_start();

if (isset($_POST["tunnus"]) && isset($_POST["salasana"])) {
    $tunnus = $_POST["tunnus"];
    $salasana = $_POST["salasana"];
} else {
    header("Location: rekisteröityminen.html");
    exit;
}

$yhteys = mysqli_connect("db", "root", "password", "nocco");

$hash = md5($salasana);

$sql = "SELECT * FROM Users WHERE tunnus=? AND salasana=?";
$stmt = mysqli_prepare($yhteys, $sql);
mysqli_stmt_bind_param($stmt, "ss", $tunnus, $hash);
mysqli_stmt_execute($stmt);
$tulos = mysqli_stmt_get_result($stmt);

if ($rivi = mysqli_fetch_object($tulos)) {

    $_SESSION["user_ok"] = "ok";

    if (isset($_SESSION["paluuosoite"])) {
        header("Location: Tuotteet.php" . $_SESSION["paluuosoite"]);
    } else {
        header("Location: Tuotteet.php");
    }
    exit;
}
?>
