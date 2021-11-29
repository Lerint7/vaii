<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pripojenie.php";
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
<div id = "clankyTelo">
    <?php
        $insert = $pripojenie->prepare("SELECT id,nazovKategorie,popisKategorie FROM categories ORDER BY nazovKategorie ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $kategorie = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $kategorie .= "<a href = '#' class = 'kategorie_odkazy'>".$nazov." </a>";
            }
            echo $kategorie;
        } else {
            echo "<p> Nie sú žiadne kategórie </p>";
        }
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