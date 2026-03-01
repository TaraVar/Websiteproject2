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

    $yhteys=mysqli_connect("db", "root", "password", "nocco");
    $sql="insert into Users values(?, ?, ?, ?)";
    $stmt=mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $tunnus, $hash, $etunimi, $sukunimi);
    mysqli_stmt_execute($stmt);
    exit;
    ?>