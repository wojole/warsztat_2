<?php

$host = "localhost";
$user = "root";
$pass = "coderslab";
$db = "tweeter";

$conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=UTF8", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //domyśly fetch
        ]
);