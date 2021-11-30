<?php include('registracia.php') ?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!--veľkost stránky, aby sa šírka nastavila a aký je pomer-->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>

<body style="background-color:var(--tmavoModra) ">

<header style="background: var(--modra)">
    <div id="logo"><img src="https://key0.cc/images/small/105836_69e02ad11d1a888cd38319316b587bfd.png" alt = "logo stránky, čo je otvorená kniha" width="80" height="80">
        </div>
        <nav id="menu" style="background-color: var(--modra);">
            <ul>
                <!-- a = odkaz na čokolvek,premenná-->
                <li><a style="color: var(--biela)" href="forum.php">Fórum</a></li>
                <li><a style="color: var(--biela)"href="index.php">Domov</a></li>
                <?php
                if(isset($_SESSION['menoLogin'])) {
                    echo  '<li><a style="color: var(--biela)" href="userPage.php">Profil</a></li>';
                } else {
                    echo '<li><a style="color: var(--biela)" href="registraciaStranka.php">Registracia</a></li>';
                }
                ?>
            </ul>
            <form method="post" enctype="application/x-www-form-urlencoded" action="login.php">
            <div class="login">
                <input type="text" name="menoLogin" placeholder="meno" required>
                <input type="password" name="hesloLogin" placeholder="heslo" required>
                <input type="submit" value="Prihlásenie" name = "login">
            </div>
            </form>
    </nav>
</header>
<div id="posunSirkaScreenu">
<div id = "registracia">
    <form method="post" enctype="application/x-www-form-urlencoded" action="registraciaStranka.php">
    <div id = "RegistraciaMojeUdaje">
        <p style="color: var(--biela); font-weight: bold; font-size: 16pt">Prihlasenie</p>
         <?php echo $error; ?>
        <input type="text" name="meno" placeholder="Užívateľ" required minlength="6">
        <input type="text" name="email" placeholder="E-mailová adresa" required >
        <input type="password" name="heslo" placeholder="Heslo" required minlength="6">
        <input type="password" name="hesloOpakovanie" placeholder="Zadajte heslo znova" required>
        <input type="submit" value="REGISTRÁCIA">
    </div>
    <div id ="RegistraciaSocialne">
        <button class="RegistraciaS" style="background: #32508E">Registrácia cez facebook</button>
        <button class="RegistraciaS" style="background: #55ACEE">Registrácia cez Twitter</button>
        <button class="RegistraciaS" style="background: #DD4B39">Registrácia cez Google+</button>
    </div>
        </form>
</div>

<div id = "diskusiaText">
    <span style="font-size: 20pt; color:var(--biela) ; background-color: var(--svetloModra)">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien arcu, ultrices et convallis nec, molestie id ante. Maecenas gravida, massa sit amet tristique scelerisque, dolor lorem mattis massa, non maximus felis enim eget magna. Nunc a rutrum neque. Ut sit amet bibendum arcu. Sed quis arcu nulla. Proin volutpat, nunc eu placerat lacinia, lectus mi maximus diam, ut malesuada mi enim eget dui. Donec ornare interdum lectus, sit amet eleifend sapien interdum non. Vestibulum sit amet mauris volutpat, fringilla nisi sed, interdum elit. Proin vehicula elementum felis, at dapibus leo ornare quis. Morbi sed magna eget elit porta hendrerit. Vestibulum ullamcorper iaculis iaculis. Quisque vel ipsum dapibus eros aliquet molestie. Mauris quis facilisis odio, vitae fermentum est. Proin volutpat metus ac est porttitor accumsan.
    </span>
</div>
</div>
<footer style="position: fixed;color: var(--biela)">
    <p> ©2021 Author: Andrea Meleková</p>
    <p><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
</body>
</html>