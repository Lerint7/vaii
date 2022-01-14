<?php
if(isset($_GET['id'])) {
    $idPomocna = $_GET['id'];
}
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}

require_once "pracaSDatabazou/pripojenie.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";
require_once "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";

?>
    <div id = post>
        <button onclick="history.back();" style = "position: fixed;z-index: 10;top: 0;right: 0;">Previous</button>
        <?php
        $id = $_GET['id'];
        $vypis = new vypisyZDatabazy();
        $vypis->posty($pripojenie,$id);
        $nazov = $vypis->getNazovTopicu();
        $popis = $vypis->getPopisTopicu();
        $menoUzivatel = $vypis->getMenoUzivatel();

        echo "<span style='position: fixed; font-size: 24pt;font-weight: bold; color: var(--biela); top: 20%; text-align: center; width: inherit;left: 15%;right: 15%'> $nazov </span>";
        echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 30%; text-align: center; width: inherit;left: 15%;right: 15%'> $popis </span>";
        echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 15%;left: 13%; width: inherit'> $menoUzivatel </span>";
        ?>
    </div>
