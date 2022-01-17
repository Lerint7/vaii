<?php

/**
 *Trieda ktorá na starosti prihlasovanie sa na stránku.Prihlási uživateľa a kontroluje správnosť vstupných údajov.
 */
class prihlasovanie
{
    /**premená má v sebe aká chyba naposledny nastala
     * @var string
     */
    public string $error = "";
    /**obsahuje zacryptované heslo
     * @var string
     */
    private string $hesloCrypted = "";
    /**obsahuje meno, ktorým sa prihlasuje použivateľ
     * @var string
     */
    private string $menoLogin = "";
    /**obsahuje heslo, ktorým sa prihlasuje použivateľ
     * @var string
     */
    private string $hesloLogin = "";

    /**Odhlási uživateľa tým, že zničí session a presmeruje ho na hlavnú stránku
     *
     */
    function odhlasenie() {
        session_start();
        if (session_destroy()) {
            header("location:index.php");
            exit;
        }
    }

    /**Funkcia kontroluje, či je zadané meno a heslo pri logine
     * @param $menoLogin - meno,podľa ktorého sa snaží prihlásiť uživateľ
     * @param $hesloLogin - heslo, cez ktoré sa snaží prihlásiť použivateľ
     * @return string vracia aký error nastal
     */
    function prihlasenieKontrola($menoLogin, $hesloLogin): string
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

    /**funkcia ktorá vyberá heslo z databázy, aby som ho mohla neskôr kontrolovať
     * @param $pripojenie - pripojenie na databázu
     */
    function prihlasenie($pripojenie) {
        $select = $pripojenie->prepare("select heslo from users where meno = ?");
        $select->bind_param("s",$this->menoLogin);
        $select->execute();
        $select->store_result();
        $select->bind_result($this->hesloCrypted);
        $select->fetch();
    }

    /**funkcia ktorá kontroluje, či sa zadané heslo rovná heslu z databázy
     * @param $pripojenie - pripojenie na databázu
     * @return string - vracia aký chyba nastala
     */
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