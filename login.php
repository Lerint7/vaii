<?php
require "pripojenie.php";
global $pripojenie, $meno, $error;
if (isset($_POST['menoLogin'])) {
    $menoLogin = ($_POST['menoLogin']);
    $hesloLogin = ($_POST['hesloLogin']);
    if (empty($menoLogin)) {
        $error = "Treba zadať meno";
    }
    if (empty($hesloLogin)) {
        $error = "Treba zadať heslo";
    }
    echo $error;
    if (empty($error)) {
        $query = $pripojenie->prepare("SELECT heslo FROM users WHERE meno = ?");
        $query->bind_param('s', $menoLogin);
        $query->execute();
        $query->store_result();
        $query->bind_result($hesloCrypted);
        $query->fetch();
        if (password_verify($hesloLogin, $hesloCrypted)) {
            session_start();
            $_SESSION['menoLogin'] = $menoLogin;
            header('location:index.php');
        } else {
            $error = "Zlé meno alebo heslo";
            $message = "Zlé meno alebo heslo";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script> window.location.href ='registraciaStranka.php'; ;</script>";
        }
    }
}