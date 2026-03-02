<?php
session_start();

$env = parse_ini_file(__DIR__ . "/.hti-env");

$ADMIN_USER = $env["ADMIN_USER"];
$ADMIN_PASS = $env["ADMIN_PASS"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? "";
    $pass = $_POST['password'] ?? "";

    if ($user === $ADMIN_USER && $pass === $ADMIN_PASS) {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $virhe = "Väärä käyttäjätunnus tai salasana.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin kirjautuminen</title>
</head>
<body>

<h2>Admin kirjautuminen</h2>

<?php if (isset($virhe)) echo "<p style='color:red;'>$virhe</p>"; ?>

<form method="POST">
    <label>Käyttäjätunnus:</label><br>
    <input type="text" name="username"><br><br>

    <label>Salasana:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Kirjaudu</button>
</form>

</body>
</html>

