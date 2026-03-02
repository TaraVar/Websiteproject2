<?php
session_start();

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$env = parse_ini_file(__DIR__ . "/.hti-env");

$yhteys = mysqli_connect(
    $env["DB_HOST"],
    $env["DB_USER"],
    $env["DB_PASS"],
    $env["DB_NAME"],
);

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

