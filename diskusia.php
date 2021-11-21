<!DOCTYPE html>
<html lang="en" >


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <!--veľkost stránky, aby sa šírka nastavila a aký je pomer-->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>

<body style="background-color:#5e503f ">

<header style="background: #a9927d">
    <div id="logo"><img src="https://key0.cc/images/small/105836_69e02ad11d1a888cd38319316b587bfd.png" alt = "logo stránky, čo je otvorená kniha" width="80" height="80">
        </div>
        <nav id="menu" style="background-color: #A5471B;">
            <ul>
                <!-- a = odkaz na čokolvek,premenná-->
                <li><a href="clanok.php">Článok</a></li>
                <li><a href="index.php">Domov</a></li>
                <li id = "diskusiaMenuTlacidlo"><a href="diskusia.php">Diskusia</a></li>
            </ul>
            <form method="post" enctype="application/x-www-form-urlencoded" action="pripojenie.php">
            <div class="login">
                <input type="text" name="username" placeholder="username" required>
                <input type="password" name="password" placeholder="password" required>
                <input type="submit" value="Prihlásenie">
            </div>
            </form>
    </nav>
    <!--
    <div id = "vyhladavac">
        <input type="text" class="searchTerm" placeholder="Čo chcete nájsť??">
    </div> -->
</header>
<div id="posunSirkaScreenu">
<div id = "registracia">
    <form method="post" enctype="application/x-www-form-urlencoded" action="pripojenie.php">
    <div id = "RegistraciaMojeUdaje">
        <p style="color: #f2f4f3; font-weight: bold; font-size: 16pt">Prihlasenie</p>
        <input type="text" name="meno" placeholder="Užívateľ" >
        <input type="text" name="email" placeholder="E-mailová adresa" >
        <input type="password" name="heslo" placeholder="Heslo" >
        <input type="password" name="hesloOpakovanie" placeholder="Zadajte heslo znova" >
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
    <span style="font-size: 20pt; color: #f2f4f3 ; background-color: #A5471B">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sapien arcu, ultrices et convallis nec, molestie id ante. Maecenas gravida, massa sit amet tristique scelerisque, dolor lorem mattis massa, non maximus felis enim eget magna. Nunc a rutrum neque. Ut sit amet bibendum arcu. Sed quis arcu nulla. Proin volutpat, nunc eu placerat lacinia, lectus mi maximus diam, ut malesuada mi enim eget dui. Donec ornare interdum lectus, sit amet eleifend sapien interdum non. Vestibulum sit amet mauris volutpat, fringilla nisi sed, interdum elit. Proin vehicula elementum felis, at dapibus leo ornare quis. Morbi sed magna eget elit porta hendrerit. Vestibulum ullamcorper iaculis iaculis. Quisque vel ipsum dapibus eros aliquet molestie. Mauris quis facilisis odio, vitae fermentum est. Proin volutpat metus ac est porttitor accumsan.
    </span>
</div>
</div>
<footer style="position: fixed">
    <p> ©2021 Author: Andrea Meleková</p>
    <p><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
</body>
</html>