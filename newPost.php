<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
if (!isset($_SESSION['menoLogin'])) {
    header("Location:registraciaStranka.php");
    die;
}
require_once "pripojenie.php";
require_once "insertPost.php";
require_once "head.php";
require_once "postZakladnaStranka.php"
?>

    <form method="post" enctype="application/x-www-form-urlencoded" action="" style="width: 0;height: 0">
    <div id="myDropdown">
        <select name = "nazovKategoria">
            <option value="Select">Select</option>
            <?php
            $insert = $pripojenie->prepare("SELECT nazovKategorie FROM categories ORDER BY nazovKategorie ASC");
            $insert->execute();
            $insert->store_result();
            $pocetRiadkov = $insert->num_rows();
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($nazovKategoria);
                $idPomocna = $_GET['id'];
                $insert->fetch();
                echo "<option value='$nazovKategoria'>".$nazovKategoria."</option>";
            }
            ?>
        </select>
        <select name = "nazovTopic">
            <option value="Select">Select</option>
            <?php
            $insert1 = $pripojenie->prepare("SELECT nazovTopicu FROM topics ORDER BY nazovTopicu ASC");
            $insert1->execute();
            $insert1->store_result();
            $pocetRiadkov = $insert1->num_rows();
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert1->bind_result($nazovTopic);
                $idPomocna = $_GET['id'];
                $insert1->fetch();
                echo "<option value='$nazovTopic'>".$nazovTopic."</option>";
            }
            ?>
        </select>
        <input type="text" name="nazovLCanku" placeholder="Názov článku" required style="width: 60%;">
    </div>

        <textarea required name="obsah" rows="5" style="position: absolute;top: 40%;width: 60%;height: 40%;left: 20%;"> </textarea>
            <br><br>
        <input type="submit" name = "submit"  style=" position:absolute;height: 30px; font-size: 14pt;top: 85%;width: 60%;left: 20%;">

    </form>

