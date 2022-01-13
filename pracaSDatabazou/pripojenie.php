<?php
$servername = "vaii_webserver-DB_1";
$username = "root";
$password = "password";
$database = "myDB";
// pripojenie do databázy
global $pripojenie;
$pripojenie = new mysqli($servername, $username, $password, $database);
//kontrola pripojenia
if ($pripojenie->connect_error) {
    die("Connection failed: " . $pripojenie->connect_error);
}