<?php
if(isset($_GET['id'])) {
    $idPomocna = $_GET['id'];
}
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

<body style="background-color : var(--tmava)">
<div style="left: 12%;right: 12%;position: relative;background-color: var(--svetloModra);width: 76%;height: 100vh">
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

    <div id = post>
        <button onclick="history.back();" style = "position: fixed;z-index: 10;top: 0;right: 0;">Previous</button>

        <?php
        $insert = $pripojenie->prepare("SELECT idPouzivatel,idPost,nazovPostu,obsah FROM post 
                                       where idPost = '$idPomocna' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $insert->bind_result($pouzivatel,$id, $nazov, $popis);
        $insert->fetch();

        $pouzivatelMeno = $pripojenie->prepare("SELECT meno FROM users where id = ? ");
        $pouzivatelMeno->bind_param('i' ,$pouzivatel);
        $pouzivatelMeno->execute();
        $pouzivatelMeno->bind_result($menoUzivatel);
        $pouzivatelMeno->fetch();

        echo "<span style='position: fixed; font-size: 24pt;font-weight: bold; color: var(--biela); top: 20%; text-align: center; width: inherit'> $nazov </span>";
        echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 30%; text-align: center; width: inherit'> $popis </span>";
        echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 15%;left: 13%; width: inherit'> $menoUzivatel </span>";
        ?>
    </div>

    <footer style= "top: 94.5vh;">
        <p style="text-align: right; color: var(--biela)"> ©2021 Author: Andrea Meleková</p>
        <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
    </footer>

</div>
</body>
</html>