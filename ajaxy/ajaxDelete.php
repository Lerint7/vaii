<?php
require_once "../pracaSDatabazou/pripojenie.php";
$sql = $pripojenie->prepare("DELETE FROM post WHERE idPost = ?");
$sql->bind_param("i", $_GET['id']);
$sql->execute();
$sql->fetch();
$sql->close();
