<?php
session_start();
if (empty($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: Tuotteet.html");
    exit;
}
?>
