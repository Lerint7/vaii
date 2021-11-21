<?php
require "pripojenie.php";

if (isset($_POST['meno'])){
    $meno = $_POST['meno'];
    $email = $_POST['email'];
    $heslo = $_POST['heslo'];
    $hesloOpakovanie = $_POST['hesloOpakovanie'];
    $znaky = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    if (!preg_match ($znaky, $email)) {array_push($error, "Email nie je platný");
        $message = "Email nie je platný";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if ($heslo != $hesloOpakovanie) {
        echo "rôzne";
        $message = "Heslá sa nezhodujú";
        echo "<script type='text/javascript'>alert('$message');</script>";
        array_push($errors, "Heslá sa nezhodujú");
    }
}

$nachadzaSa = "SELECT * FROM users WHERE meno='$meno' OR email='$email' LIMIT 1";
$vysledok = mysqli_query($pripojenie, $nachadzaSa);
$user = mysqli_fetch_assoc($vysledok);

if ($user) { // if user exists
    if ($user['meno'] === $meno) {
        array_push($error, "Meno už existuje");
        $message = "Meno už existuje";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }

    if ($user['email'] === $email) {
        array_push($error, "Email sa už používa");
        $message = "Email sa už používa";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}


if (count($error) != 1) {
    echo "sračka";
    $url = "localhost/diskusia.php";
    header("location: $url");
}
if (count($error) == 0) {
    $heslo = md5($heslo);
    $insert = $pripojenie->prepare("INSERT INTO users (meno, email, heslo) VALUES (?,?,?)");
    $insert->bind_param('sss', $meno, $email, $heslo);
    $insert->execute();
    $insert->close();
    $pripojenie->close();
}