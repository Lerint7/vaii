<?php
session_start();
require "pripojenie.php";

if (isset($_POST['submit'])) {
    $kategoria = $_POST['nazovKategoria'];
    $nazovTopic = $_POST['nazovTopic'];
    $nazovPostu = $_POST['nazovLCanku'];
    $obsahPostu = $_POST ['obsah'];
    $menoLogin = $_SESSION['menoLogin'];

    $insert = $pripojenie->prepare("SELECT idCategories  from categories where nazovKategorie = ? ");
    $insert->bind_param('s', $kategoria);
    $insert->execute();
    $insert->store_result();
    $insert->bind_result($idKategorie);
    $insert->fetch();

    $insert = $pripojenie->prepare("SELECT idTopics from topics where nazovTopicu = ? ");
    $insert->bind_param('s', $nazovTopic);
    $insert->execute();
    $insert->store_result();
    $insert->bind_result($idTopicu);
    $insert->fetch();

    $insert = $pripojenie->prepare("SELECT id from users where  meno = ?");
    $insert->bind_param('s',$menoLogin);
    $insert->execute();
    $insert->store_result();
    $insert->bind_result($idUzivatel);
    $insert->fetch();

    $insert = $pripojenie->prepare("INSERT INTO post (idCategories, idTopics, idPouzivatel, nazovPostu, obsah ) VALUES (?,?,?,?,?)");
    $insert->bind_param('iiiss', $idKategorie, $idTopicu,$idUzivatel,$nazovPostu, $obsahPostu);
    $insert->execute();
}