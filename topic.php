<?php
if(isset($_GET['id'])) {
    $idPomocna = $_GET['id'];
}
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}

require_once "pracaSDatabazou/pripojenie.php";
require_once "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";
?>

    <div id = "postyTelo">
        <?php
        $id = $_GET['id'];
        $vypis = new vypisyZDatabazy();
        $vypis->topiky($pripojenie,$id);
        ?>
    </div>
