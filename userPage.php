<?php session_start();
require "pracaSDatabazou/pripojenie.php";
require_once "zakladneStranky/head.php";
require_once "pracaSDatabazou/prihlasovanie.php";
require_once "updateUzivatel.php";

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
    $update = new updateUzivatel();
    $update->zmenaMena($pripojenie);

}

if (isset($_POST['zmenaMailu'])) {
    $update->zmenaMailu($pripojenie);
}

if (isset($_POST['zmazanieUctu'])) {
    $update->zmazanieUctu($pripojenie);
}

if ( (!empty($_POST['zmenaHesla'])) && (!empty($_POST['zmenaHeslaOpakovanie'])) ) {
    $update->zmenaHesla($pripojenie);
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
        <form id="idZmenaUdajov" method="post" enctype="application/x-www-form-urlencoded" >
            <div id="main-div">
                <div id = "menoUdaje" >
                    <label for="inputMeno">Meno</label>
                    <input type="text" id="inputMeno" name = "zmenaMena" value = "<?php echo $meno ?>">
                </div>
                <div id = "emailUdaje" >
                    <label for="inputMail">Emailová adresa</label>
                    <input type="text" id="inputMail" name = "zmenaMailu" value = "<?php echo $email ?>">
                </div>
                <div id = "hesloUdaje" >
                    <label for="inputHeslo">Heslo</label>
                    <input type="password" id="inputHeslo" name = "zmenaHesla" >
                </div>
                <div id = "hesloPotvrdeneUdaje">
                    <label for="inputHesloZnova">Heslo znova</label>
                    <input type="password" id="inputHesloZnova" name = "zmenaHeslaOpakovanie">
                </div>
            </div>
            //možno refresh po zrušení
            <input onclick="return confirm('Chcete určite zmeniť údaje?')" type="submit" value="Zmena údajov" name = "zmenaUdajov" style="width: 100%; height: 10%; font-size: 16pt; margin: auto">
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