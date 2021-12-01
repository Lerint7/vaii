<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pripojenie.php";
require_once "head.php";
require_once "postZakladnaStranka.php"
?>
<script src="funkcie.js"></script>

    <div id = obrazokForum>
        <div id = newForum>
            <a href="newPost.php" id = button type=“funkciaNewForum” >New Topic</a>
            <div id = textForum>
                <a style="font-size: 20pt"> General discussion </a>
                <a style="font-size: 14pt"> Post your general discussion topics here</a>
            </div>
        </div>
    </div>

    <div id = "kategorieTelo">
        <?php
        $insert = $pripojenie->prepare("SELECT idCategories,nazovKategorie,popisKategorie FROM categories ORDER BY nazovKategorie ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $kategorie = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $idPomocna = $_GET['id'];
                $insert->fetch();
                $kategorie .= "<a href='/forum.php?id=" . $id . "' class = 'kategorie_odkazy'>".$nazov." </a>";
            }
            $kategorie .= "<a href='/forum.php' class = 'topicy_odkazy'>" . "Všetky topicy" . " </a>";
            echo $kategorie;
        } else {
            echo "<p> Nie sú žiadne kategórie </p>";
        }
        ?>
    </div>
    <div id = "topicyTelo">
        <?php
        if(isset($_GET['id'])) {
            $insertTopic = $pripojenie->prepare("SELECT idTopics,nazovTopicu,popisTopicu, datumPridania 
                                        FROM topics where idCategories = '$idPomocna'  ORDER BY datumPridania");
        } else {
            $insertTopic = $pripojenie->prepare("SELECT idTopics,nazovTopicu,popisTopicu, datumPridania FROM topics ORDER BY datumPridania");
        }
        $insertTopic->execute();
        $insertTopic->store_result();
        $pocetRiadkov = $insertTopic->num_rows();
        $topicy = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1; $i <= $pocetRiadkov; $i++) {
                $insertTopic->bind_result($idT, $nazovT, $popisT, $datum);
                $insertTopic->fetch();
                $topicy .= "<a href='/topic.php?id=" . $idT . "' class = 'topicy_odkazy'>" . $nazovT . " </a>";
            }

            echo $topicy;
        }
        ?>
    </div>
