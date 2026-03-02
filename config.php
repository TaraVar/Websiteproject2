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

try {
    $yhteys = mysqli_connect(
        $env["DB_HOST"],
        $env["DB_USER"],
        $env["DB_PASS"],
        $env["DB_NAME"],
        $env["DB_PORT"]
    );
} catch (Exception $e) {
    print "Yhteysvirhe";
    exit;
}
?>

