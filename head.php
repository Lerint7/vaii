<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--veľkost stránky, aby sa šírka nastavila a aký je pomer-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>

<header>
    <div id="logo"><img src="https://key0.cc/images/small/105836_69e02ad11d1a888cd38319316b587bfd.png" alt = "logo stránky, čo je otvorená kniha" width="80" height="80"></div>
    <nav id="menu" >
        <ul>
            <!-- a = odkaz na čokolvek,premenná-->
            <li><a href="forum.php">Fórum</a></li>
            <li><a href="index.php">Domov</a></li>
            <?php
            if (isset($_SESSION['menoLogin'])) {
                echo  '<li><a href="userPage.php">Profil</a></li>';
            } else {
                echo '<li><a href="registraciaStranka.php">Registracia</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>