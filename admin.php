<?php
session_start();

if (!isset($_SESSION['admin'])) {
    die("Pääsy estetty.");
}
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$env = parse_ini_file(__DIR__ . "/.hti-env");

$yhteys = mysqli_connect(
    $env["DB_HOST"],
    $env["DB_USER"],
    $env["DB_PASS"],
    $env["DB_NAME"],
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin paneeli</title>
</head>
<body>

<h1>Admin paneeli</h1>

<p><a href="logout.php">Kirjaudu ulos</a></p>

<h2>Tietokanta-asetukset</h2>

<table border="1" cellpadding="6">
<tr><th>Asetus</th><th>Arvo</th></tr>
<tr><td>DB_HOST</td><td><?= htmlspecialchars($env["DB_HOST"]) ?></td></tr>
<tr><td>DB_USER</td><td><?= htmlspecialchars($env["DB_USER"]) ?></td></tr>
<tr><td>DB_NAME</td><td><?= htmlspecialchars($env["DB_NAME"]) ?></td></tr>
<tr><td>DB_PORT</td><td><?= htmlspecialchars($env["DB_PORT"]) ?></td></tr>
<tr><td>DB_PASS</td><td>********</td></tr>
</table>

</body>
</html>

