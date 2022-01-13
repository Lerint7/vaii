<?php

class vkladaniePostu
{
    private string $nazovKategoria = "";
    private string $nazovTopic = "";
    private string $nazovPostu = "";
    private string $obsahPostu = "";
    private string $menoLogin = "";


    public function __construct($nazovKategoria, $nazovTopic, $nazovPostu, $obsahPostu, $menoLogin)
    {
        $this->nazovKategoria = $nazovKategoria;
        $this->nazovTopic = $nazovTopic;
        $this->nazovPostu = $nazovPostu;
        $this->obsahPostu = $obsahPostu;
        $this->menoLogin = $menoLogin;
    }

    public function pripravenieNaVlozenie($pripojenie, $coVyberam, $odkialVyberam, $podmienka, $bind):int
    {
        $insert = $pripojenie->prepare("SELECT $coVyberam from $odkialVyberam where $podmienka = ? ");
        $insert->bind_param('s',$bind );
        echo $nazovKategoria;
        $insert->execute();
        $insert->store_result();
        $insert->bind_result($vysledok);
        $insert->fetch();
        return $vysledok;
    }

    /**
     * @return string
     */
    public function getNazovKategoria(): string
    {
        return $this->nazovKategoria;
    }

    /**
     * @return string
     */
    public function getMenoLogin(): string
    {
        return $this->menoLogin;
    }

    /**
     * @return string
     */
    public function getNazovTopic(): string
    {
        return $this->nazovTopic;
    }

    public function vlozeniePostu($pripojenie,$idKategorie,$idTopicu,$idUzivatel){
        $insert = $pripojenie->prepare("INSERT INTO post (idCategories, idTopics, idPouzivatel, nazovPostu, obsah ) VALUES (?,?,?,?,?)");
        $insert->bind_param('iiiss', $idKategorie, $idTopicu,$idUzivatel,$this->nazovPostu, $this->obsahPostu);
        $insert->execute();
    }

}