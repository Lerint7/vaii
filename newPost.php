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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--veľkost stránky, aby sa šírka nastavila a aký je pomer-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>

<body style="background-color : var(--tmava)">
<div style="left: 12%;right: 12%;position: relative;background-color: var(--svetloModra);width: 76%;height: 95vh">
    <header style="background-color: var(--tmavoModra)">
        <nav id="menu">
            <ul>
                <!-- a = odkaz na čokolvek,premenná-->
                <li><a style="color: var(--modra)" href="forum.php">Fórum</a></li>
                <li><a style="color: var(--modra)" href="index.php">Domov</a></li>
                <?php
                if(isset($_SESSION['menoLogin'])) {
                    echo  '<li><a style="color: var(--modra)"href="userPage.php">Profil</a></li>';
                } else {
                    echo '<li><a style="color: var(--modra)" href="registraciaStranka.php">Registracia</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>

    <form method="post" enctype="application/x-www-form-urlencoded" action="">
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

    <div id = "teloClanku">
        <textarea required name="obsah" rows="5" style="position: fixed;top: 35%;margin-left: -1%;width: 60%;height: 40%;"> </textarea>
            <br><br>
        <input type="submit" name = "submit"  style=" position:fixed;height: 30px; font-size: 14pt;top: 80%;width: 57%;">
    </div>

    </form>

    <footer style= "top: 84.7vh;">
        <p style="text-align: right; color: var(--biela)"> ©2021 Author: Andrea Meleková</p>
        <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
    </footer>

</div>
</body>
</html>