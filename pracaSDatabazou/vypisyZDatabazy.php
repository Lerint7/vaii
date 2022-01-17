<?php
echo '<script src="javaScript/funkcie.js"></script>';

/**
 * Táto trieda má na starosti vyberanie údajov z databázy, ktoré následne využívajú iné php stránky.
 */
class vypisyZDatabazy
{
    /**Počet riadkov, ktoré vyberiem
     * @var int
     */
    private int $pocetRiadkov = 0;
    /**Id priháseného použivateľa
     * @var string
     */
    private string $idPrihlaseneho = "";
    /**premenná ktorá obsahuje posty, ktoré vyberiem
     * @var string
     */
    private string $posty = "";
    /**Meno použivateľa
     * @var string
     */
    private string $menoUzivatel = "";
    /**Názov daného postu
     * @var string
     */
    private string $nazovPostu = "";
    /**Obsah daného postu
     * @var string
     */
    private string $popisPostu = "";
    /**id uživateľa, ktorý tento post napísal
     * @var int
     */
    private int $idUzivatelaPostu = 0;
    /**Id daného topicu
     * @var int
     */
    private int $idTopicu = 0;
    /**Id danej kategórie
     * @var int
     */
    private int $idkategorie = 0;

    /**Táto funkcia vracia id zadaného užívetľa na základe mena
     * @param $pripojenie - pripojenie do databázy
     * @param $uzivatel - meno uživateľa
     */
    function ziskanieID($pripojenie, $uzivatel) {
        $insert = $pripojenie->prepare('SELECT id from users where meno = ?');
        $insert->bind_param('s', $uzivatel);
        $insert->execute();
        $insert->store_result();
        $insert->bind_result($this->idPrihlaseneho);
        $insert->fetch();
    }

    /**Táto funkcia vyťahuje všetky články uživateľa a následne ich vypisuje ako odkazy
     * @param $pripojenie - pripojenie na databázu
     */
    function mojeClanky($pripojenie) {
        $insert = $pripojenie->prepare("SELECT idPost,nazovPostu,obsah FROM post where idPouzivatel = '$this->idPrihlaseneho' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $this->pocetRiadkov = $insert->num_rows();
        $this->posty = "";

        if ($this->pocetRiadkov > 0) {
            for ($i = 1;$i <= $this->pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $this->posty .= "<div id = $id> <button onclick='deleteZDatabazy($id)' style='width: fit-content;position: absolute'>Vymazanie</button>
                                <a href='/post.php?id=" . $id . "' class = 'posty_odkazy'>".$nazov." </a>
                                </div>";
            }
            echo $this->posty;
        } else {
            echo "<p style='font-weight: bold;text-align: center;font-size: 25pt;color: var(--biela);'> V tomto topicu nie sú žiadne posty </p>";
        }
    }

    /**Táto funkcia vyberá informácie o poste, na základe jeho idé, zadaného ako idPomocna. V tejto funkcii zisťujem ako meno uživateĺa
     * ktorý tento post napísal.
     * @param $pripojenie - pripojenie do databázy
     * @param $idPomocna - id postu
     */
    function posty ($pripojenie, $idPomocna){
        $insert = $pripojenie->prepare("SELECT idCategories,idTopics,idPouzivatel,nazovPostu,obsah FROM post where idPost = '$idPomocna' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $this->pocetRiadkov = $insert->num_rows();
        $insert->bind_result($this->idkategorie,$this->idTopicu,$this->idUzivatelaPostu, $this->nazovPostu,$this->popisPostu);
        $insert->fetch();

        $pouzivatelMeno = $pripojenie->prepare("SELECT meno FROM users where id = ? ");
        $pouzivatelMeno->bind_param('i' ,$this->idUzivatelaPostu);
        $pouzivatelMeno->execute();
        $pouzivatelMeno->bind_result($this->menoUzivatel);
        $pouzivatelMeno->fetch();
    }

    /**Táto funkcia vypisuje všetky kategórie a ukladá ich ako odkazy.
     * @param $pripojenie - pripojenie do databázy
     */
    function kategorieForum($pripojenie) {
        $insert = $pripojenie->prepare("SELECT idCategories,nazovKategorie,popisKategorie FROM categories ORDER BY nazovKategorie ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $kategorie = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $kategorie .= "<div id = $id><a href='/forum.php?id=" . $id . "' class = 'kategorie_odkazy'>".$nazov."</a></div>";
            }
            $kategorie .= "<a href='/forum.php' class = 'topicy_odkazy'>" . "Všetky topicy" . " </a>";
            echo $kategorie;
        } else {
            echo "<p> Nie sú žiadne kategórie </p>";
        }
    }

    /**Táto funkcia vypisuje všetky topicy, na základe toho aká kategória bola zvolená a ukladá ich ako odkazy.
     * @param $pripojenie - do databázy
     * @param $id - IDkategórie
     */
    function topikyForum($pripojenie, $id) {
        if($id) {
            $insertTopic = $pripojenie->prepare("SELECT idTopics,nazovTopicu,popisTopicu FROM topics where idCategories = '$id'  ORDER BY nazovTopicu");
        } else {
            $insertTopic = $pripojenie->prepare("SELECT idTopics,nazovTopicu,popisTopicu FROM topics ORDER BY nazovTopicu");
        }
        $insertTopic->execute();
        $insertTopic->store_result();
        $pocetRiadkov = $insertTopic->num_rows();
        $topicy = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1; $i <= $pocetRiadkov; $i++) {
                $insertTopic->bind_result($idT, $nazovT, $popisT);
                $insertTopic->fetch();
                $topicy .= "<div><a href='/topic.php?id=" . $idT . "' class = 'topicy_odkazy'>" . $nazovT . " </a></div>";
            }
            echo $topicy;
        }
    }

    /**Funkcia ktorá updatuje post
     * @param $pripojenie - pripojenie do databázy
     * @param $co - ktorý stĺpec nastavujem
     * @param $cozmena - prvý bindovací paramater
     * @param $podmienka - druhý bindovací parameter
     */
    public function updatePostu($pripojenie, $co, $cozmena, $podmienka)
    {
        $update = $pripojenie->prepare("UPDATE post SET $co = ? where idPost = ?");
        $update->bind_param('si',$cozmena,$podmienka);
        $update->execute();
    }

    /**Výpis dropdownMenu na základe zadaných parameterov
     * @param $pripojenie - pripojenie na dazabázu
     * @param $nazov - názov stĺpca, ktorý vyberám
     * @param $odkial - názov tabuľky, z ktorej vyberám
     * @param $bind - parameter do ktorého bindujem
     */
    public function vypisDropDowMenu ($pripojenie, $nazov, $odkial, $bind) {
        $insert1 = $pripojenie->prepare("SELECT $nazov FROM $odkial ORDER BY $nazov ASC");
        $insert1->execute();
        $insert1->store_result();
        $pocetRiadkov = $insert1->num_rows();
        for ($i = 1;$i <= $pocetRiadkov; $i++) {
            $insert1->bind_result($bind);
            $insert1->fetch();
            echo "<option value='$bind'>".$bind."</option>";
        }
    }

    /**Táto funkcia zistuje či sa v tabulke nachádza niečo s rovnakým názvom už
     * @param $pripojenie - pripojenie do databázy
     * @param $tabulka - názov tabuĺky, v ktorej hľadám
     * @param $co - stĺpec, v ktorom hľadám hodnotu
     * @param $comu - hladaná hodnota
     * @return int - vracia počet riadkov, kde sa meno rovná tomu zadanému
     */
    public function nachadzaSa($pripojenie, $tabulka, $co, $comu):int {
        $insert = $pripojenie->prepare("SELECT * from $tabulka where $co = ?");
        $insert->bind_param('s', $comu);
        $insert->execute();
        $insert->store_result();
        echo $insert->num_rows();
        return $insert->num_rows();
    }

    /**Vracia meni uživateľa
     * @return string -meno uživateľa
     */
    public function getMenoUzivatel(): string
    {
        return $this->menoUzivatel;
    }

    /**Vracia obsah postu
     * @return string -obsah postu
     */
    public function getPopisPostu(): string
    {
        return $this->popisPostu;
    }


    /**Vracia názov postu
     * @return string - názov postu
     */
    public function getNazovPostu(): string
    {
        return $this->nazovPostu;
    }

}