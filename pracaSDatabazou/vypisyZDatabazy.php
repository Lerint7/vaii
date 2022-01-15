<?php
include_once "ajax.php";
class vypisyZDatabazy
{
    private int $pocetRiadkov = 0;
    private string $idPrihlaseneho = "";
    private string $posty = "";
    private string $menoUzivatel = "";
    private string $nazovPostu = "";
    private string $popisPostu = "";
    private int $idUzivatelaPostu = 0;
    private int $idTopicu = 0;
    private int $idkategorie = 0;


    function ziskanieID($pripojenie, $uzivatel) {
        $insert = $pripojenie->prepare('SELECT id from users where meno = ?');
        $insert->bind_param('s', $uzivatel);
        $insert->execute();
        $insert->store_result();
        $insert->bind_result($this->idPrihlaseneho);
        $insert->fetch();
    }

    function mojeClanky($pripojenie) {
        $insert = $pripojenie->prepare("SELECT idPost,nazovPostu,obsah FROM post 
                                  where idPouzivatel = '$this->idPrihlaseneho' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $this->pocetRiadkov = $insert->num_rows();
        $this->posty = "";
        if ($this->pocetRiadkov > 0) {
            for ($i = 1;$i <= $this->pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $this->posty .= "<div id = $id>
                <a href='/post.php?id=" . $id . "' class = 'posty_odkazy'>".$nazov." </a>
                </div>";
            }
            echo $this->posty;
        } else {
            echo "<p style='font-weight: bold;text-align: center;font-size: 25pt;color: var(--biela);'> V tomto topicu nie sú žiadne posty </p>";
        }
    }

    function posty ($pripojenie,$idPomocna){
        $insert = $pripojenie->prepare("SELECT idCategories,idTopics,idPouzivatel,nazovPostu,obsah FROM post 
                                       where idPost = '$idPomocna' ORDER BY nazovPostu ASC");
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

    /**
     * @return string
     */
    public function getMenoUzivatel(): string
    {
        return $this->menoUzivatel;
    }
    /**
     * @return string
     */
    public function getPopisPostu(): string
    {
        return $this->popisPostu;
    }

    /**
     * @return string
     */
    public function getNazovPostu(): string
    {
        return $this->nazovPostu;
    }




    function kategorieForum($pripojenie) {
        ?> <script src="javaScript/funkcie.js"></script> <?php

        $insert = $pripojenie->prepare("SELECT idCategories,nazovKategorie,popisKategorie FROM categories ORDER BY nazovKategorie ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        $kategorie = "";
        if ($pocetRiadkov > 0) {
            for ($i = 1;$i <= $pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $kategorie .= "<div id = $id>
                                <a href='/forum.php?id=" . $id . "' class = 'kategorie_odkazy'>".$nazov."</a> 
                                </div>";
            }
            $kategorie .= "<a href='/forum.php' class = 'topicy_odkazy'>" . "Všetky topicy" . " </a>";
            echo $kategorie;
        } else {
            echo "<p> Nie sú žiadne kategórie </p>";
        }
    }

    function topikyForum($pripojenie,$id) {
        if($id) {
            $insertTopic = $pripojenie->prepare("SELECT idTopics,nazovTopicu,popisTopicu
                                        FROM topics where idCategories = '$id'  ORDER BY nazovTopicu");
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

    public function updatePostu($pripojenie,$co, $cozmena,$podmienka)
    {
        $update = $pripojenie->prepare("UPDATE post SET $co = ? where idPost = ?");
        $update->bind_param('si',$cozmena,$podmienka);
        $update->execute();
    }


}