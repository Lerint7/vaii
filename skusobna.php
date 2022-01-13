<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pracaSDatabazou/pripojenie.php";
require "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";
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
    $vypis = new vypisyZDatabazy();
    $vypis->kategorieForum($pripojenie);
    ?>
</div>
<div id = "topicyTelo">
    <?php
    $id = ($_GET['id']);
    $vypis->topikyForum($pripojenie, $id);
    ?>
</div>
