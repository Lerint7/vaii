<?php include('pracaSDatabazou/registracia.php');
require_once "zakladneStranky/head.php";
require_once "pracaSDatabazou/prihlasovanie.php";
require_once "pracaSDatabazou/pripojenie.php";

if ($_REQUEST['registracia']) {
    $registracia = new registracia($_POST['meno'], $_POST['email'], $_POST['heslo'], $_POST['hesloOpakovanie']);
    $error = $registracia->porovnanie();
    if (empty($error)) {
        $error = $registracia->nachadzaSa($pripojenie);
        if (empty($error)) {
            echo $error;
            $registracia->vlozenieUzivatela($pripojenie);
        }
    }
}

if ($_REQUEST['prihlasenie']) {
    $prihlasovanie =  new prihlasovanie();
    if (empty($error)) {
       $error =  $prihlasovanie->prihlasenieKontrola($_POST['menoLogin'],$_POST['hesloLogin']);
        if(empty($error)){
            $prihlasovanie->prihlasenie($pripojenie);
            $error = $prihlasovanie->kontrolaHesla($pripojenie);
            echo $error;
       }
    }
}
?>
<!DOCTYPE html>
<html lang="en" >

<body style="background-color:var(--tmavoModra) ">

            <form method="post" enctype="application/x-www-form-urlencoded" >
                <div class="login">
                    <input type="text" name="menoLogin" placeholder="meno" required>
                    <input type="password" name="hesloLogin" placeholder="heslo" required>
                    <input type="submit" value="Prihlásenie" name = "prihlasenie">
                </div>
            </form>

<div id="posunSirkaScreenu">
<div id = "registracia">
    <form method="post" enctype="application/x-www-form-urlencoded">

    <div id = "RegistraciaMojeUdaje">
        <p style="color: var(--biela); font-weight: bold; font-size: 16pt">Prihlasenie</p>
         <?php echo $error; ?>
        <input type="text" name="meno" placeholder="Užívateľ" required minlength="6">
        <input type="text" name="email" placeholder="E-mailová adresa" required >
        <input id ="passwd" onkeydown="kontrolaSilyHesla()" type="password" name="heslo" placeholder="Heslo" required minlength="6">
        <div id = "barSila" style="width: 80%; height: 30px "></div>
        <span id = "sprava" style="font-weight: bold;font-size: 14pt; color: var(--modra)">Sila hesla</span>
            <input type="password" name="hesloOpakovanie" placeholder="Zadajte heslo znova" required>
        <input type="submit" value="REGISTRÁCIA" name="registracia">
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