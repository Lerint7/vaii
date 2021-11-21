<?php
$servername = "vaii-webserver-DB-1";
$username = "root";
$password = "password";
$database = "myDB";
$error = array();
// pripojenie do databázy
$pripojenie = new mysqli($servername, $username, $password, $database);
//kontrola pripojenia
if ($pripojenie->connect_error) {
    echo "Ahoj";
    die("Connection failed: " . $pripojenie->connect_error);
}