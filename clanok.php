<?php
require "reg.php";
$reg = null;
if(isset($_POST['UserName'])) {
    $reg = new reg();
    $reg->setMeno($_POST['UserName']);
    $reg->setEmail($_POST['Email']);
    $reg->setHeslo($_POST['Password']);
    $reg->setPotvrHeslo($_POST['ConfirmPassword']);

    $servername = "vaii-webserver-DB-1";
    $username = "root";
    $password = "password";
    $database = "myDB";
    $error = "";

// Create connection
    $pripojenie = new mysqli($servername, $username, $password, $database);
}
// Check connection
if ($pripojenie->connect_error) {
    die("Connection failed: " . $pripojenie->connect_error);
} else {
    echo "Databaza je pripojena";
}

$insert = $pripojenie->prepare("INSERT INTO users (id,username,password,email) VALUES (?,?,?,?)");
$insert->bind_param('isss', $id,$meno, $heslo, $email);
if ($insert->execute()) {
    echo "Bol pridaný záznam";
}else {
        echo "ee";
}