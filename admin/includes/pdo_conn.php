<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "votesystem";

try {
    $db = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "dbection failed: " . $e->getMessage();
}
