<?php
session_start();
require "pripojenie.php";
global $pripojenie,$error;

if (isset($_POST['meno'])){
    $meno = $_POST['meno'];
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];
    $hesloOpakovanie = $_POST['hesloOpakovanie'];
    $znaky = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    if (!preg_match ($znaky, $email)) {
        $error = "Email nie je platný";
    }

    if ($heslo != $hesloOpakovanie) {
        $error ="Heslá sa nezhodujú";
    }
}

$nachadzaSa = "SELECT * FROM users WHERE meno='$meno' OR email='$email' LIMIT 1";
$vysledok = $pripojenie->query($nachadzaSa);
$user = mysqli_fetch_assoc($vysledok);

if ($user) {
    if ($user['meno'] === $meno) {
        $error = "Meno už existuje";
    }

    if ($user['email'] === $email) {
        $error = "Email sa už používa";
    }
}

if (empty($error)) {
    $heslo = md5($heslo);
    $insert = $pripojenie->prepare("INSERT INTO users (meno, email, heslo) VALUES (?,?,?)");
    $insert->bind_param('sss', $meno, $email, $heslo);
    $insert->execute();
    $_SESSION['meno'] = $meno;
    $_SESSION['prihlasenie'] = "Ste prihlásený";
    $insert->close();
    $pripojenie->close();
}?>