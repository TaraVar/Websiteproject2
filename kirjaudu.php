<?php
session_start();
$yhteys = mysqli_connect("db", "root", "password", "nocco");

$username = $_POST["username"];
$password = $_POST["password"];

$tulos = mysqli_query($yhteys, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_object($tulos);

if ($user && password_verify($password, $user->password_hash)) {

    $_SESSION["user_id"] = $user->id;
    $_SESSION["username"] = $user->username;
    $_SESSION["role"] = $user->role;

    if ($user->role === "admin") {
        header("Location: admin.php");
    } else {
        header("Location: index.html");
    }
    exit;

} else {
    echo "Väärä tunnus tai salasana";
}
//Lukee käyttäjä nimen ja salasanan ja hakee ne tietokannasta ja tarkistaa ne . Jos on admin niin siirtyy admin.php ja jos jotain muuta noon siirtyy index.html
?>
