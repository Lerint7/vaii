<?php
if(isset($_GET['id'])) {
    $idPomocna = $_GET['id'];
}
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}

require_once "pripojenie.php";
require_once "head.php";
require_once "postZakladnaStranka.php"
?>

    <div id = "postyTelo">
        <?php
        $insert = $pripojenie->prepare("SELECT idPost,nazovPostu,obsah FROM post 
                                       where idTopics = '$idPomocna' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $posty = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $posty .= "<a href='/post.php?id=" . $id . "' class = 'posty_odkazy'>".$nazov." </a>";
            }
            echo $posty;
        } else {
            echo "<p style='font-weight: bold;text-align: center;font-size: 25pt;color: var(--biela);'> V tomto topicu nie sú žiadne posty </p>";
        }
        ?>
    </div>
