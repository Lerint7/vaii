<?php session_start();
require "pracaSDatabazou/pripojenie.php";
require_once "zakladneStranky/head.php";
require_once "pracaSDatabazou/prihlasovanie.php";

if (!isset($_SESSION['menoLogin'])) {
    header("Location:registraciaStranka.php");
    die;
}
$menoLogin = $_SESSION['menoLogin'];
$insert = $pripojenie->prepare("SELECT meno, email FROM users WHERE meno = ?");
$insert->bind_param('s', $_SESSION['menoLogin']);
$insert->execute();
$insert->store_result();
$insert->bind_result($meno, $email);
$insert->fetch();


if (isset($_POST['zmenaMena'])) {
    if(strlen($_POST['zmenaMena']) > 6) {
        $insert = $pripojenie->prepare("UPDATE users set meno = ? where meno = ?");
        $insert->bind_param('ss', $_POST['zmenaMena'], $_SESSION['menoLogin']);
        $insert->execute();
        $_SESSION['menoLogin'] = $_POST['zmenaMena'];
        header("Refresh:0");
    } else {
        $message = "Meno je príliš krátke. Minimálne dĺžka je 6 znakov";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

if (isset($_POST['zmenaMailu'])) {
    $znaky = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if (!preg_match ($znaky, $_POST['zmenaMailu'])) {
        $message = "Email nie je platný";
        echo "<script type='text/javascript'>alert('$message');</script>";
    } else {
        $insert = $pripojenie->prepare("UPDATE users set email = ? where meno = ?");
        $insert->bind_param('ss', $_POST['zmenaMailu'] , $_SESSION['menoLogin']);
        $insert->execute();
        header("Refresh:0");
    }
}

if (isset($_POST['zmazanieUctu'])) {
    $insert = $pripojenie->prepare("DELETE from users where meno = ?");
    $insert->bind_param('s',$menoLogin );
    $insert->execute();
    unset($_SESSION);
    session_destroy();
    header('Location: index.php');
}

if ( (!empty($_POST['zmenaHesla'])) && (!empty($_POST['zmenaHeslaOpakovanie'])) ) {
    if(strlen($_POST['zmenaHesla']) > 6 ) {
        if (($_POST['zmenaHesla']) == ($_POST['zmenaHeslaOpakovanie'])) {
            $heslo = $_POST['zmenaHesla'];
            $heslo = password_hash($heslo, PASSWORD_BCRYPT);
            $insert = $pripojenie->prepare("UPDATE users set heslo = ? where meno = ?");
            $insert->bind_param('ss',$heslo ,$menoLogin );
            $insert->execute();
        } else {
            $message = "Heslá sa nezhodujú.";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        $message = "Heslo je príliš krátke. Minimálne dĺžka je 6 znakov";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}

if ($_REQUEST['odhlasenie']) {
        $databaza = new prihlasovanie();
        $databaza->odhlasenie();
}

?>

<!DOCTYPE html>
<html lang="en">
<body style="background-color:var(--tmavoModra) ">

<div id = "profil" >
    <div id = "profiloveOkno">
        <div id = "profilFoto"></div>
        <div id = "menoLogin">
            <p> Meno </p>
        </div>
        <a href="mojeClanky.php">
            <input type="submit" value="Moje články" style="top: 18%;font-size: 15pt;left: 10%;width: 80%;height: 8%;position: relative" >
        </a>
    </div>


    <div id = "odhlasenie">
        <form method="post" enctype="application/x-www-form-urlencoded" action="">
            <input type="submit" value="Odhlásenie" name="odhlasenie" style="position: absolute;top: 0;right: 0;">
        </form>
    </div>


    <div id = "profiloveUdaje" style="list-style: none">
        <form method="post" enctype="application/x-www-form-urlencoded" >
        <div id="main-div">
            <div id = "menoUdaje" >
                <label for="input">Meno</label>
                <input type="text" id="input" name = "zmenaMena" value = "<?php echo $meno ?>">
            </div>
            <div id = "emailUdaje" >
                <label for="input">Emailová adresa</label>
                <input type="text" id="input" name = "zmenaMailu" value = "<?php echo $email ?>">
            </div>
            <div id = "hesloUdaje" >
                <label for="input">Heslo</label>
                <input type="password" id="input" name = "zmenaHesla" >
            </div>
            <div id = "hesloPotvrdeneUdaje">
                <label for="input">Heslo znova</label>
                <input type="password" id="input" name = "zmenaHeslaOpakovanie">
            </div>
        </div>
            <input type="submit" value="Zmena údajov" name = "zmenaUdajov" style="width: 100%; height: 10%; font-size: 16pt; margin: auto" onclick="return confirm('Chcete určite zmeniť údaje?')">
            <input type="submit" value="Zmazanie účtu" name = "zmazanieUctu" style="width: 100%; height: 10%; font-size: 16pt; margin-top: 10px" onclick="return confirm('Chcete určite vymazať účet?')">
        </form>

    </div>
</div>

<footer style="position: fixed">
    <p> ©2021 Author: Andrea Meleková</p>
    <p><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
</body>
</html>