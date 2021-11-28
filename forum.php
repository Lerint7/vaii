<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require "pripojenie.php";
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

<body style="background-color: #a9927d">
<div style="background-color: maroon; width: 80% ;height: 100vh; margin-right: 10%;margin-left: 10%; margin-top: 25px; border-radius: 10%">
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
<div id = obrazokForum>
    <div id = newForum>
        <button id = button type=“funkciaNewForum”>New Forum</button>
        <div id = textForum>
            <a style="font-size: 20pt"> General discussion </a>
            <a style="font-size: 14pt"> Post your general discussion topics here</a>
        </div>
    </div>
</div>
<div id = "kategoria" style="width: auto">
        <button>Všetky</button>
        <button>Kniha prvá</button>
        <button>Kniha druhá</button>
        <button>Kniha tretia</button>
        <button>Ostatné</button>
</div>
<div id = "clankyTelo">
    <?php

    ?>
</script>
</div>


<!--<footer>
    <p style="text-align: right"> ©2021 Author: Andrea Meleková</p>
    <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
-->
</div>
</body>
</html>