<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pracaSDatabazou/pripojenie.php";
require_once "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";
$admin = "";
$idPomocna = "";
$insert = $pripojenie->prepare("SELECT rola FROM users WHERE meno = ?");
$insert->bind_param('s', $_SESSION['menoLogin']);
$insert->execute();
$insert->store_result();
$insert->bind_result($admin);
$insert->fetch();

if  ($_REQUEST['nazov']) {
    $insert = $pripojenie->prepare("INSERT INTO categories(nazovKategorie,popisKategorie) values (?,?)");
    $insert->bind_param('ss', $_POST['nazov'], $_POST['popis']);
    $insert->execute();
    $insert->close();
    unset($_REQUEST['nazov']);
}
if  ($_REQUEST['nazovK']) {
    $kontrola = $pripojenie->prepare("SELECT idCategories FROM categories where idCategories = ?");
    $kontrola->bind_param('i',$_POST['idK']);
    $kontrola->execute();
    $kontrola->store_result();
    $pocetRiadkov = $kontrola->num_rows();
    echo $pocetRiadkov;
    if($pocetRiadkov > 0){
        $insert = $pripojenie->prepare("INSERT INTO topics (idCategories,nazovTopicu,popisTopicu) values (?,?,?)");
        $insert->bind_param('iss',$_POST['idK'] ,$_POST['nazovK'], $_POST['popisK']);
        $insert->execute();
        $insert->close();
    }
}

?>
<script src="javaScript/funkcie.js"></script>
<div id = obrazokForum>
    <div id = newForum>
        <a href="newPost.php" id = "button" >Novy post</a>
        <div id = textForum>
            <a style="font-size: 20pt"> General discussion </a>
            <a style="font-size: 14pt"> Post your general discussion topics here</a>
        </div>
    </div>
</div>

<div id = "kategorieTelo">
    <div id="modalKategorie" class="modal">
        <form class="modalObsah" style="display: inline-grid" method="post" enctype="application/x-www-form-urlencoded" >
            <span onclick="schovat('modalKategorie')" class="close">X</span>
            <span style="text-align: center">Zadajte názov kategórie</span>
            <input style="left: 40%;position: relative" type="text" name="nazov">
            <span style="text-align: center">Zadajte popis kategórie</span>
            <input style="left: 40%;position: relative" type="text" name="popis">
            <input style="left: 40%; position: relative" type="submit" value="Pridať">
        </form>
    </div>

    <div id="modalTopicy" class="modal">
        <form class="modalObsah" style="display: inline-grid" method="post" enctype="application/x-www-form-urlencoded" >
            <span onclick="schovat('modalTopicy')" class="close">X</span>
            <span style="text-align: center">Zadajte id kategórie</span>
            <input style="left: 40%;position: relative" type="text" name="idK">
            <span style="text-align: center">Zadajte názov topicu</span>
            <input style="left: 40%;position: relative" type="text" name="nazovK">
            <span style="text-align: center">Zadajte popis topicu</span>
            <input style="left: 40%;position: relative" type="text" name="popisK">
            <input style="left: 40%; position: relative" type="submit" value="Pridať">
        </form>

    </div>

    <?php
    if ($admin == 1) {
        echo '<button onclick="ukazat(\''. "modalKategorie" .'\')" style="width: -webkit-fill-available; height: auto;"  id="myBtn" class="kategorie_odkazy">Pridanie kategorie</button>';
    }
    $vypis = new vypisyZDatabazy();
    $vypis->kategorieForum($pripojenie);
    ?>

</div>
<div id = "topicyTelo">
    <?php
    if ($admin == 1) {
        echo '<button onclick="ukazat(\''. "modalTopicy" .'\')" style="width: -webkit-fill-available; height: auto;"  id="myBtny" class="topicy_odkazy">Pridanie topicu</button>';
    }
    $id = ($_GET['id']);
    $vypis->topikyForum($pripojenie, $id);
    ?>
</div>
