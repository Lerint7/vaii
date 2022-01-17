<?php require_once "zakladneStranky/head.php";
require_once "pracaSDatabazou/pripojenie.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";
require_once "pracaSDatabazou/vkladaniePostu.php";
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
if (!isset($_SESSION['menoLogin'])) {
    header("Location:registraciaStranka.php");
    die;
}
$id = $_GET['id'];
$obsah = $_REQUEST ['obsah'];

if ($_REQUEST['submit']) {
    $pridaniePostu = new vkladaniePostu(0,0,0,0,0);
    $idKategorie = $pridaniePostu->pripravenieNaVlozenie($pripojenie, "idCategories", "categories", "nazovKategorie",$_POST['nazovKategoria']);
    $idTopicu = $pridaniePostu->pripravenieNaVlozenie($pripojenie, "idTopics", "topics", "nazovTopicu", $_POST['nazovTopic']);
    $idUzivatel = $pridaniePostu->pripravenieNaVlozenie($pripojenie, "id", "users", "meno",$_SESSION['menoLogin']);

    $updatePostu = new vypisyZDatabazy();

    $nazovKategoria = $_REQUEST['nazovKategoria'];
    if(!empty($nazovKategoria)){
        $updatePostu->updatePostu($pripojenie,"idCategories",$idKategorie,$id);
    }

    $nazovTopic = $_REQUEST['nazovTopic'];
    if(!empty($nazovTopic)){
        $updatePostu->updatePostu($pripojenie,"idTopics",$idTopicu,$id);
    }

    $nazovClanku = $_REQUEST['nazovClanku'];
    if (!empty($nazovClanku)) {
         $kontrola = new vypisyZDatabazy();
         echo($nazovClanku);
            if($kontrola->nachadzaSa($pripojenie,'post','nazovPostu', $nazovClanku) < 1) {
                $updatePostu->updatePostu($pripojenie,"nazovPostu",$nazovClanku,$id);
            } else {
                echo "<script type='text/javascript'>alert('Post s týmto menom už existuje');</script>";
            }
    }

    $obsahClanku = $_REQUEST['obsah'];
    if (!empty($obsahClanku)) {
        $updatePostu->updatePostu($pripojenie,"obsah",$obsah,$id);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body style="background-color : var(--tmava)">
<div style="background-color: var(--tmavoModra);position: absolute;width: 10px;height:100vh;left: 50%"></div>
<div style="background-color: var(--tmavoModra);position: absolute;width: 100%;height: 80px"></div>

<?php
$vypis = new vypisyZDatabazy();
$vypis->posty($pripojenie,$id);
$nazov = $vypis->getNazovPostu();
$popis = $vypis->getPopisPostu();
$menoUzivatel = $vypis->getMenoUzivatel();

echo "<div id ='povodnyClanok' style='position: relative;width: 50%;height: 94vh;'>";
echo "<span class='postTexty' style='top: 20%;left: 14%;font-size: 20pt'> $nazov </span>";
echo "<span class='postTexty' style='top: 30%;left: 5%;inline-size: min-content;width: 85%;overflow-wrap: anywhere;'> $popis </span>";
echo "<span class='postTexty' style='top: 15%;left: 3%'> $menoUzivatel </span>";
echo "</div>";
?>
<form method="post" enctype="application/x-www-form-urlencoded">
    <div id="myPomocna">
        <select name = "nazovKategoria">
            <?php
                $vypis->vypisDropDowMenu($pripojenie,"nazovKategorie","categories","$nazovKatgorie");
            ?>
        </select>
        <select name = "nazovTopic">
            <?php
            $vypis->vypisDropDowMenu($pripojenie,"nazovTopicu","topics","$nazovTopic");
            ?>
        </select>
        <input type="text" name="nazovClanku" placeholder="Názov článku" style="width: 100%;margin-top: 1%">
        <textarea name="obsah" maxlength="1000" minlength="50" style="position: absolute;top: 100%;width: 100%;height: 240px;left: 0; resize: none"></textarea>
        <input type="submit" name = "submit"  style=" position: relative;height: 30px;font-size: 14pt;width: 60%;left: 20%;top: 300px;">
    </div>
</form>

<footer>
        <p style="text-align: right; color: var(--biela)"> ©2021 Author: Andrea Meleková</p>
        <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
    </footer>
</body>
</html>