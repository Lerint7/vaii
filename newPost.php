<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
if (!isset($_SESSION['menoLogin'])) {
    header("Location:registraciaStranka.php");
    die;
}
require_once "pracaSDatabazou/pripojenie.php";
require_once "pracaSDatabazou/vkladaniePostu.php";
require_once "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
require_once "pracaSDatabazou/vypisyZDatabazy.php";

if ($_REQUEST['submit']) {
    $novyPost =  new vkladaniePostu($_POST['nazovKategoria'],$_POST['nazovTopic'],$_POST['nazovLCanku'],$_POST ['obsah'],$_SESSION['menoLogin']);
    $idKategorie = $novyPost->pripravenieNaVlozenie($pripojenie, "idCategories", "categories", "nazovKategorie",$novyPost->getNazovKategoria());
    $idTopicu = $novyPost->pripravenieNaVlozenie($pripojenie, "idTopics", "topics", "nazovTopicu", $novyPost->getNazovTopic());
    $idUzivatel= $novyPost->pripravenieNaVlozenie($pripojenie, "id", "users", "meno",$novyPost->getMenoLogin());
    $novyPost->vlozeniePostu($pripojenie,$idKategorie,$idTopicu,$idUzivatel);
}
?>

<form method="post" enctype="application/x-www-form-urlencoded" action="">
    <div id="myDropdown">
        <select name = "nazovKategoria">
            <option value="Select">Select</option>
            <?php
            $vypis = new vypisyZDatabazy();
            $vypis->vypisDropDowMenu($pripojenie,"nazovKategorie","categories",$nazovKatgorie);
            ?>
        </select>
        <select name = "nazovTopic">
            <option value="Select">Select</option>
            <?php
            $vypis = new vypisyZDatabazy();
            $vypis->vypisDropDowMenu($pripojenie,"nazovTopicu","topics",$nazovTopic);
            ?>
        </select>
        <input type="text" name="nazovLCanku" placeholder="Názov článku" required style="width: 60%;">
    </div>

    <textarea required name="obsah" rows="5" style="position: absolute;top: 40%;width: 60%;height: 40%;left: 20%;"> </textarea>
    <br><br>
    <input type="submit" name = "submit"  style=" position:absolute;height: 30px; font-size: 14pt;top: 85%;width: 60%;left: 20%;">

</form>

