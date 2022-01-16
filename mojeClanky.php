<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
    $uzivatel = $_SESSION['menoLogin'];
}
echo '<script src="javaScript/funkcie.js"></script>';
require_once "pracaSDatabazou/pripojenie.php";
require_once "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";
?>

<div id = "postyTelo">
    <?php
        $vypis = new vypisyZDatabazy();
        $vypis->ziskanieID($pripojenie,$uzivatel);
        $vypis->mojeClanky($pripojenie);
    ?>
</div>