<?php
require "pripojenie.php";
global $pripojenie, $meno, $error;

if (isset($_POST['login'])) {
    if (empty($username)) {
        $error = "Treba zadať meno";
    }
    if (empty($password)) {
        $error = "Treba zadať heslo";
    }

    $meno = e($_POST['username']);
    $heslo = e($_POST['$heslo']);

    if (empty($error)) {
        $heslo = md5($heslo);

        $query = "SELECT * FROM users WHERE meno='$meno' AND heslo='$heslo' LIMIT 1";
        $vysledok = mysqli_query($pripojenie, $query);

        if (mysqli_num_rows($vysledok) == 1) {
            $prihlaseny = mysqli_fetch_assoc($vysledok);
            $_SESSION['meno'] = $prihlaseny;
            $_SESSION['success']  = "Prihlásený";

                header('location: index.php');
            }
        } else {
        $error = "Zlé meno alebo heslo";
        }
}