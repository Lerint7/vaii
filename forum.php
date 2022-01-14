<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pracaSDatabazou/pripojenie.php";
require "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";

$admin = "";
$insert = $pripojenie->prepare("SELECT rola FROM users WHERE meno = ?");
$insert->bind_param('s', $_SESSION['menoLogin']);
$insert->execute();
$insert->store_result();
$insert->bind_result($admin);
$insert->fetch();
?>
<script src="javaScript/funkcie.js"></script>

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

    if ($admin == 1) {
        echo "<a class = 'kategorie_odkazy'>" . "Pridanie kategorie" . " </a>";
    }
    $vypis = new vypisyZDatabazy();
    $vypis->kategorieForum($pripojenie);
    ?>

</div>
<div id = "topicyTelo">
    <?php

    if ($admin == 1) {
        echo "<a class = 'topicy_odkazy'>" . "Pridanie Topicu" . " </a>";
    }

    $id = ($_GET['id']);
    $vypis->topikyForum($pripojenie, $id);
    ?>
</div>
