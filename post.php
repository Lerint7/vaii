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
        $nazov = $vypis->getNazovPostu();
        $popis = $vypis->getPopisPostu();
        $menoUzivatel = $vypis->getMenoUzivatel();
        if($menoUzivatel =  $_SESSION['menoLogin']){
            echo "<a class='postTexty' style='left: 12%' onclick='' href='upravaPostu.php'> Vymazať  </a>";
            echo "<a class='postTexty' style='right: 12%' onclick='' href='upravaPostu.php?id=" . $id . "'> Upraviť  </a>";
        }

        echo "<span class='postTexty' style='text-align: center;left: 15%;right: 15%;font-size: 20pt'> $nazov </span>";
        echo "<span class='postTexty' style='top: 30%; text-align: center;left: 15%;right: 15%'> $popis </span>";
        echo "<span class='postTexty' style='top: 15%;left: 13%'> $menoUzivatel </span>";
        ?>
    </div>
