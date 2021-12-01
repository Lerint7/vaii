<?php
if(isset($_GET['id'])) {
    $idPomocna = $_GET['id'];
}
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}

require_once "pripojenie.php";
require_once "head.php";
require_once "postZakladnaStranka.php";

?>

    <div id = post>
        <button onclick="history.back();" style = "position: fixed;z-index: 10;top: 0;right: 0;">Previous</button>

        <?php
        $insert = $pripojenie->prepare("SELECT idPouzivatel,idPost,nazovPostu,obsah FROM post 
                                       where idPost = '$idPomocna' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $insert->bind_result($pouzivatel,$id, $nazov, $popis);
        $insert->fetch();

        $pouzivatelMeno = $pripojenie->prepare("SELECT meno FROM users where id = ? ");
        $pouzivatelMeno->bind_param('i' ,$pouzivatel);
        $pouzivatelMeno->execute();
        $pouzivatelMeno->bind_result($menoUzivatel);
        $pouzivatelMeno->fetch();

        echo "<span style='position: fixed; font-size: 24pt;font-weight: bold; color: var(--biela); top: 20%; text-align: center; width: inherit;left: 15%;right: 15%'> $nazov </span>";
        echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 30%; text-align: center; width: inherit;left: 15%;right: 15%'> $popis </span>";
        echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 15%;left: 13%; width: inherit'> $menoUzivatel </span>";
        ?>
    </div>
