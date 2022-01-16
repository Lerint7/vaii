<?php
include_once "pracaSDatabazou/pripojenie.php";
class registracia
{
    public string $error = "";
    private string $meno =  "";
    private string $email =  "";
    private string $heslo =  "";
    private string $hesloOpakovanie =  "";
    private string $znaky =  "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    public function __construct($meno,$email,$heslo,$hesloOpakovanie) {
        $this->meno = $meno;
        $this->email = $email;
        $this->heslo = $heslo;
        $this->hesloOpakovanie = $hesloOpakovanie;
    }

    public function porovnanie():string {
        if (!preg_match ($this->znaky, $this->email)) {
            $this->error = "Email nie je platný";
        }

        if ($this->heslo != $this->hesloOpakovanie) {
            $this->error = "Heslá sa nezhodujú";
        }

        if (strlen($this->meno) < 6) {
            $this->error = "Meno je príliš krátke. Minimálne dĺžka je 6 znakov";
        }

        if (strlen($this->heslo) < 6) {
            $this->error = "Heslo je príliš krátke. Minimálne dĺžka je 6 znakov";
        }

        if(empty($this->meno)){
            $this->error = "Nezadali ste meno";
        }

        if(empty($this->email)){
            $this->error = "Nezadali ste email";
        }

        if(empty($this->heslo)){
            $this->error = "Nezadali ste heslo";
        }
        return $this->error;
    }

    public function nachadzaSa($pripojenie):string {
        $nachadzaSa = "SELECT * FROM users WHERE meno='$this->meno' OR email='$this->email'";
        $vysledok = $pripojenie->query($nachadzaSa);
        $user = mysqli_fetch_assoc($vysledok);
        if ($user) {
            if ($this->$user['meno'] === $this->meno) {
                $this->error = "Meno už existuje";
            }

            if ($user['email'] === $this->email) {
                $this->error = "Email sa už používa";
            }
        }
        return  $this->error;
    }

    public function vlozenieUzivatela($pripojenie):void {
            $this->heslo = password_hash($this->heslo, PASSWORD_BCRYPT);
            $insert = $pripojenie->prepare("INSERT INTO users (meno, email, heslo) VALUES (?,?,?)");
            $insert->bind_param('sss', $this->meno, $this->email, $this->heslo);
            $insert->execute();
            $_SESSION['meno'] = $this->meno;
            $insert->close();
            $pripojenie->close();
    }
}