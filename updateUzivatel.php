<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
class updateUzivatel
{
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

        function zmenaMailu($pripojenie){
            $znaky = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
            if (!preg_match ($znaky, $_POST['zmenaMailu'])) {
                $message = "Email nie je platný";
                echo "<script type='text/javascript'>alert('$message');</script>";
            } else {
                $insert = $pripojenie->prepare("UPDATE users set email = ? where meno = ?");
                $insert->bind_param('ss', $_POST['zmenaMailu'] , $_SESSION['menoLogin']);
                $insert->execute();
                header("Refresh:0");
            }
        }

        function zmazanieUctu($pripojenie){
            $insert = $pripojenie->prepare("DELETE from users where meno = ?");
            $insert->bind_param('s',$menoLogin );
            $insert->execute();
            unset($_SESSION);
            session_destroy();
            header('Location: index.php');
        }

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