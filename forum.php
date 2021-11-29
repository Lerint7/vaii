<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pripojenie.php";
?>
<script src="funkcie.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--veľkost stránky, aby sa šírka nastavila a aký je pomer-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>

<body style="background-color: #a9927d">
<div style="background-color: maroon; width: 80% ;height: 100vh; margin-right: 10%;margin-left: 10%; margin-top: 25px; border-radius: 10%">
<header>
    <nav id="menu">
        <ul>
            <!-- a = odkaz na čokolvek,premenná-->
            <li><a href="forum.php">Fórum</a></li>
            <li><a href="index.php">Domov</a></li>
            <?php
            if(isset($_SESSION['menoLogin'])) {
                echo  '<li><a href="userPage.php">Profil</a></li>';
            } else {
                echo '<li><a href="registraciaStranka.php">Registracia</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<div id = obrazokForum>
    <div id = newForum>
        <a href="newTopic.php" id = button type=“funkciaNewForum”>New Topic</a>
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
            $insertTopic->execute();
            $insertTopic->store_result();
            $pocetRiadkov = $insertTopic->num_rows();
            $topicy = "";
            if ($pocetRiadkov > 0) {
                for ($i = 1; $i <= $pocetRiadkov; $i++) {
                    $insertTopic->bind_result($idT, $nazovT, $popisT, $datum);
                    $insertTopic->fetch();
                    $topicy .= "<a href='#' class = 'topicy_odkazy'>" . $nazovT . " </a>";
                }

                echo $topicy;
            }
        } else {
            $insertTopic2 = $pripojenie->prepare("SELECT idTopics,nazovTopicu,popisTopicu, datumPridania FROM topics ORDER BY datumPridania");
            $insertTopic2->execute();
            $insertTopic2->store_result();
            $pocetRiadkov = $insertTopic2->num_rows();
            $topicy = "";
            if ($pocetRiadkov > 0) {
                for ($i = 1; $i <= $pocetRiadkov; $i++) {
                    $insertTopic2->bind_result($idT, $nazovT, $popisT, $datum);
                    $insertTopic2->fetch();
                    $topicy .= "<a href='#' class = 'topicy_odkazy'>" . $nazovT . " </a>";
                }

                echo $topicy;
            }
        }
        ?>
    </div>

<!--<footer>
    <p style="text-align: right"> ©2021 Author: Andrea Meleková</p>
    <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
-->
</div>
</body>
</html>