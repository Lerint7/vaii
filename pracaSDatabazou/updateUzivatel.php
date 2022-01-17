<?php
require_once "pracaSDatabazou/vypisyZDatabazy.php";

if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}

/**
 *Táto trieda má na starosti update informácií o uživateľovi a vymazanie účtu, čiže kontroluje či nové údaje
 * vyhovujú požiadavkám ako sú počet znakov a podobne. Následne vykonáva aj update.
 */
class updateUzivatel
{
    /**Táto funkcia vykonáva update mena, kontroluje jeho dĺžku a updatuje ho v databáze
     * @param $pripojenie - pripojenie na databázu
     */
    function zmenaMena($pripojenie) {
            if(strlen($_POST['zmenaMena']) > 6) {
                $insert = $pripojenie->prepare("UPDATE users set meno = ? where meno = ?");
                $insert->bind_param('ss', $_POST['zmenaMena'], $_SESSION['menoLogin']);
                $insert->execute();
                $_SESSION['menoLogin'] = $_POST['zmenaMena'];
            } else {
                $message = "Meno je príliš krátke. Minimálne dĺžka je 6 znakov";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }


    /**Táto funkcia vykonáva update emailu, kontroluje či má správny tvar ako email a updatuje ho v databáze
     * @param $pripojenie - pripojenie na databázu
     */
    function zmenaMailu($pripojenie){
            $znaky = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
                if (!preg_match ($znaky, $_POST['zmenaMailu'])) {
                    $message = "Email nie je platný";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                } else {
                    $insert = $pripojenie->prepare("UPDATE users set email = ? where meno = ?");
                    $insert->bind_param('ss', $_POST['zmenaMailu'], $_SESSION['menoLogin']);
                    $insert->execute();
                    header("Refresh:0");
                }
        }


    /**Táto funkcia vykonáva vymazanie účtu, a následne uživateľa presmeruje na hlavnú stránku
     * @param $pripojenie - pripojenie na databázu
     * @param $menoLogin - meno uživateľa čo sa má vymazať
     */
    function zmazanieUctu($pripojenie,$menoLogin){
            $insert = $pripojenie->prepare("DELETE from users where meno = ?");
            $insert->bind_param('s',$menoLogin );
            $insert->execute();
            unset($_SESSION);
            session_destroy();
            header('Location: index.php');
        }


    /**Táto funkcia vykonáva zmenu hesla, kontroluje jeho dĺžku, porovnáva ho s heslom zadaným znova a updatuje ho v databáze
     * @param $pripojenie - pripojenie na databázu
     */
    function zmenaHesla($pripojenie){
            if(strlen($_POST['zmenaHesla']) > 6 ) {
                if (($_POST['zmenaHesla']) == ($_POST['zmenaHeslaOpakovanie'])) {
                    $heslo = $_POST['zmenaHesla'];
                    $heslo = password_hash($heslo, PASSWORD_BCRYPT);
                    $insert = $pripojenie->prepare("UPDATE users set heslo = ? where meno = ?");
                    $insert->bind_param('ss',$heslo ,$menoLogin );
                    $insert->execute();
                } else {
                    $message = "Heslá sa nezhodujú.";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            } else {
                $message = "Heslo je príliš krátke. Minimálne dĺžka je 6 znakov";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
}