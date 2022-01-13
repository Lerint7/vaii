<?php

class prihlasovanie
{
    public string $error = "";
    private string $hesloCrypted = "";
    private string $menoLogin = "";
    private string $hesloLogin = "";

    function odhlasenie() {
        session_start();
        if (session_destroy()) {
            header("location:index.php");
            exit;
        }
    }

    function prihlasenieKontrola($menoLogin,$hesloLogin): string
    {
        $this->menoLogin = $menoLogin;
        $this->hesloLogin = $hesloLogin;
            if (empty($this->menoLogin)) {
                $this->error = "Treba zadať meno";
            }
            if (empty($this->hesloLogin)) {
                $this->error = "Treba zadať heslo";
            }
            return $this->error;
        }

    function prihlasenie($pripojenie) {
        $select = $pripojenie->prepare("select heslo from users where meno = ?");
        $select->bind_param("s",$this->menoLogin);
        $select->execute();
        $select->store_result();
        $select->bind_result($this->hesloCrypted);
        $select->fetch();
    }

    function kontrolaHesla($pripojenie):string{
        echo strlen($this->hesloCrypted);
        $this->hesloCrypted = substr( $this->hesloCrypted, 0, 60 );
        echo strlen($this->hesloCrypted);
        if (password_verify($this->hesloLogin,$this->hesloCrypted)) {
            echo "je to fajn";
            session_start();
            $_SESSION['menoLogin'] = $this->menoLogin;
            header("location:../index.php");
        } else {
            $this->error = "Zlé meno alebo heslo";
            $message = "Zlé meno alebo heslo";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script> window.location.href ='/registraciaStranka.php' ;</script>";
        }
        return $this->error;
    }

}