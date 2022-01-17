<?php

/**
 *Táto trieda má na starosti vloženie nového postu do databázy
 */
class vkladaniePostu
{
    /**Názov kategórie v ktorej ej post
     * @var string
     */
    private string $nazovKategoria = "";
    /**Názov topicu v ktorom je post
     * @var string
     */
    private string $nazovTopic = "";
    /**Názov postu samotného
     * @var string
     */
    private string $nazovPostu = "";
    /**Obsah postu
     * @var string
     */
    private string $obsahPostu = "";
    /**Meno uživateľa, ktorý vkladá post
     * @var string
     */
    private string $menoLogin = "";


    /**Tento konštuktor inicializuje túto triedu a priraďuje jednotlivé parametre.
     * @param $nazovKategoria - názov kategórie v ktorej je post
     * @param $nazovTopic - názov topicu v ktorom je post
     * @param $nazovPostu - názov postu
     * @param $obsahPostu - obsah postu
     * @param $menoLogin - Meno uživateľa, ktorý vkladá post
     */
    public function __construct($nazovKategoria, $nazovTopic, $nazovPostu, $obsahPostu, $menoLogin)
    {
        $this->nazovKategoria = $nazovKategoria;
        $this->nazovTopic = $nazovTopic;
        $this->nazovPostu = $nazovPostu;
        $this->obsahPostu = $obsahPostu;
        $this->menoLogin = $menoLogin;
    }

    /**Táto funkcia má na starosti prípravu na vloženie, čiže vracia id postu/kategorie/topic pre ďalšie použitie na základne mena
     * @param $pripojenie - pripojenie do databázy
     * @param $coVyberam - stĺpec v tabulke, ktorý chcem vrátiť(typu int)
     * @param $odkialVyberam - názov tabuľky
     * @param $podmienka - string, ktorý je názvom
     * @param $bind - parameter ktorý nahrádza otázniček,s čím sa podmienka pri selecte z databázy porovná
     * @return int - vracia id postu/kategorie/topicu
     */
    public function pripravenieNaVlozenie($pripojenie, $coVyberam, $odkialVyberam, $podmienka, $bind):int
    {
        $insert = $pripojenie->prepare("SELECT $coVyberam from $odkialVyberam where $podmienka = ? ");
        $insert->bind_param('s',$bind);
        $insert->execute();
        $insert->store_result();
        $insert->bind_result($vysledok);
        $insert->fetch();
        return $vysledok;
    }

    /**Vracia názov kategórie
     * @return string - názov kategórie
     */
    public function getNazovKategoria(): string
    {
        return $this->nazovKategoria;
    }

    /**Vracia názov uživateľa, ktorý vkladá post
     * @return string - meno uživteľa
     */
    public function getMenoLogin(): string
    {
        return $this->menoLogin;
    }

    /**Vracia názov topivu, v ktorom je post
     * @return string - názov topicu
     */
    public function getNazovTopic(): string
    {
        return $this->nazovTopic;
    }

    /**Funkcia na základe získaných informácií z pripravy vloží do databázy nový topic.
     * @param $pripojenie - pripojenie na databázu
     * @param $idKategorie - id kategórie v ktorej je post
     * @param $idTopicu - id topicu, v ktorom je post
     * @param $idUzivatel - id uživateľa, ktorý post vložil
     */
    public function vlozeniePostu($pripojenie, $idKategorie, $idTopicu, $idUzivatel){
        $insert = $pripojenie->prepare("INSERT INTO post (idCategories, idTopics, idPouzivatel, nazovPostu, obsah ) VALUES (?,?,?,?,?)");
        $insert->bind_param('iiiss', $idKategorie, $idTopicu,$idUzivatel,$this->nazovPostu, $this->obsahPostu);
        $insert->execute();
    }

}