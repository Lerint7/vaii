<?php
include_once "pracaSDatabazou/pripojenie.php";

/**
 *Trieda ma na starosti registráciu na stránku, kontrola správnosti údajov a následné vloženie do databázy.
 */
class registracia
{
    /**premená má v sebe aká chyba naposledny nastala
     * @var string
     */
    public string $error = "";
    /**premená má v sebe meno uživateľa, ktorý sa registruje
     * @var string
     */
    private string $meno =  "";
    /**premená má v sebe email uživateľa, ktorý sa registruje
     * @var string
     */
    private string $email =  "";
    /**premená má v sebe heslo uživateľa, ktorý sa registruje
     * @var string
     */
    private string $heslo =  "";
    /**premená má v sebe heslo uživateľa, ktorý sa registruje keď ho zadáva druhýkrát
     * @var string
     */
    private string $hesloOpakovanie =  "";
    /**premená má v sebe znaky pre kontorlu emailu
     * @var string
     */
    private string $znaky =  "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";

    /**Konštruktor pre registráciu
     * @param $meno -parameter má v sebe meno uživateľa, ktorý sa registruje
     * @param $email -parameter má v sebe email uživateľa, ktorý sa registruje
     * @param $heslo -parameter má v sebe heslo uživateľa, ktorý sa registruje
     * @param $hesloOpakovanie -parameter má v sebe heslo uživateľa, ktorý sa registruje, keď ho zadá druhýkrát
     */
    public function __construct($meno, $email, $heslo, $hesloOpakovanie) {
        $this->meno = $meno;
        $this->email = $email;
        $this->heslo = $heslo;
        $this->hesloOpakovanie = $hesloOpakovanie;
    }

    /**Funckia kontroluje, či sú vstupy v správnych tvaroch
     * @return string - vracia chybu, ktorá nastala
     */
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

    /**Funkcia kontroluje, čis a v databáze nenachádza uživateľ s rovnakým menom alebo emailom
     * @param $pripojenie - pripojenie do databázy
     * @return string - vracia aká chyba nastala
     */
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

    /**funkcia vloží do databázy nového uživateľa
     * @param $pripojenie - pripojenie do databázy
     */
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