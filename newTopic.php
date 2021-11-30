<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
if (!isset($_SESSION['menoLogin'])) {
    header("Location:registraciaStranka.php");
    die;
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
<div style="left: 12%;right: 12%;position: relative;background-color: maroon;width: 76%;height: 95vh;border-radius: 10%;">
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
    <div id="myDropdown">
        <select>
            <option value="Select">Select</option>
            <?php
            $insert = $pripojenie->prepare("SELECT nazovKategorie FROM categories ORDER BY nazovKategorie ASC");
            $insert->execute();
            $insert->store_result();
            $pocetRiadkov = $insert->num_rows();
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($nazov);
                $idPomocna = $_GET['id'];
                $insert->fetch();
                echo "<option value='Select'>".$nazov."</option>";
            }
            ?>
        </select>
        <select>
            <option value="Select">Select</option>
            <?php
            $insert = $pripojenie->prepare("SELECT nazovTopicu FROM topics ORDER BY nazovTopicu ASC");
            $insert->execute();
            $insert->store_result();
            $pocetRiadkov = $insert->num_rows();
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($nazov);
                $idPomocna = $_GET['id'];
                $insert->fetch();
                echo "<option value='Select'>".$nazov."</option>";
            }
            ?>
        </select>
        <input type="text" name="nazovLCanku" placeholder="Názov článku" required style="width: 60%;">
    </div>
    <div id = teloClanku>
        <textarea rows="5" style="margin-left: 8%; width: 60%; height: 40%;"> </textarea>
            <br><br>
        <input type="submit" value="Submit" style="width: 80%;height: 30px; font-size: 14pt;">
    </div>
    <footer style= "top: 21.7vh;">
        <p style="text-align: right"> ©2021 Author: Andrea Meleková</p>
        <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
    </footer>

</div>
</body>
</html>