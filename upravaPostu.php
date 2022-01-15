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
$nazovClanku = $_REQUEST['nazovClanku'];
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
        $updatePostu->updatePostu($pripojenie,"nazovPostu",$nazovClanku,$id);
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

echo "<span class='postTexty' style='top: 20%;left: 14%;font-size: 20pt'> $nazov </span>";
echo "<span class='postTexty' style='top: 30%;left: 5%;width: 35% '> $popis </span>";
echo "<span class='postTexty' style='top: 15%;left: 3%'> $menoUzivatel </span>";

?>
<form method="post" enctype="application/x-www-form-urlencoded" action="">
    <div id="myPomocna">
        <select name = "nazovKategoria">
            <?php
            $insert = $pripojenie->prepare("SELECT nazovKategorie FROM categories ORDER BY nazovKategorie ASC");
            $insert->execute();
            $insert->store_result();
            $pocetRiadkov = $insert->num_rows();
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($nazovKategoria);
                $insert->fetch();
                echo "<option value='$nazovKategoria'>".$nazovKategoria."</option>";
            }
            ?>
        </select>
        <select name = "nazovTopic">
            <?php
            $nazovTopic= "";
            $insert1 = $pripojenie->prepare("SELECT nazovTopicu FROM topics ORDER BY nazovTopicu ASC");
            $insert1->execute();
            $insert1->store_result();
            $pocetRiadkov = $insert1->num_rows();
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert1->bind_result($nazovTopic);
                $insert1->fetch();
                echo "<option value='$nazovTopic'>".$nazovTopic."</option>";
            }
            ?>
        </select>
        <input type="text" name="nazovClanku" placeholder="Názov článku" style="width: 100%;margin-top: 1%">
        <textarea name="obsah" rows="5" style="position: absolute;top: 100%;width: 100%;height: 240px;left: 0%"> </textarea>
        <input type="submit" name = "submit"  style=" position: relative;height: 30px;font-size: 14pt;width: 60%;left: 20%;top: 300px;">
    </div>
</form>

<footer style= "top: 94.5vh;">
        <p style="text-align: right; color: var(--biela)"> ©2021 Author: Andrea Meleková</p>
        <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
    </footer>
</body>
</html>