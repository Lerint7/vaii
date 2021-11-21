<?php

function login(){
    global $db, $meno, $error;

    $meno = e($_POST['username']);
    $heslo = e($_POST['$heslo']);

    // attempt login if no errors on form
    if (count($error) == 0) {
        $heslo = md5($heslo);

        $query = "SELECT * FROM users WHERE meno='$meno' AND heslo='$heslo' LIMIT 1";
        $vysledok = mysqli_query($db, $query);

        if (mysqli_num_rows($vysledok) == 1) {

            $prihlaseny = mysqli_fetch_assoc($vysledok);
            $_SESSION['meno'] = $prihlaseny;
            $_SESSION['success']  = "Prihlásený";

                header('location: index.php');
            }
        }else {
            array_push($error, "Zlé meno alebo heslo");
        }
}