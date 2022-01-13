<?php

class vypisyZDatabazy
{
    private int $pocetRiadkov = 0;
    private string $idPrihlaseneho = "";
    private string $posty = "";
    private string $menoUzivatel = "";
    private string $nazovTopicu = "";
    private string $popisTopicu = "";
    private string $menoUzivatelTopicu = "";

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
                $this->posty .= "<a href='/post.php?id=" . $id . "' class = 'posty_odkazy'>".$nazov." </a>";
            }
            echo $this->posty;
        } else {
            echo "<p style='font-weight: bold;text-align: center;font-size: 25pt;color: var(--biela);'> V tomto topicu nie sú žiadne posty </p>";
        }
    }

    function posty ($pripojenie,$idPomocna){
        $insert = $pripojenie->prepare("SELECT idPouzivatel,nazovPostu,obsah FROM post 
                                       where idPost = '$idPomocna' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $this->pocetRiadkov = $insert->num_rows();
        $insert->bind_result($this->menoUzivatelTopicu, $this->nazovTopicu,$this->popisTopicu);
        $insert->fetch();

        $pouzivatelMeno = $pripojenie->prepare("SELECT meno FROM users where id = ? ");
        $pouzivatelMeno->bind_param('i' ,$pouzivatel);
        $pouzivatelMeno->execute();
        $pouzivatelMeno->bind_result($this->menoUzivatel);
        $pouzivatelMeno->fetch();
    }


    /**
     * @return string
     */
    public function getMenoUzivatelTopicu(): string
    {
        return $this->menoUzivatelTopicu;
    }

    /**
     * @return string
     */
    public function getPopisTopicu(): string
    {
        return $this->popisTopicu;
    }

    /**
     * @return string
     */
    public function getNazovTopicu(): string
    {
        return $this->nazovTopicu;
    }

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
                $kategorie .= "<a href='/forum.php?id=" . $id . "' class = 'kategorie_odkazy'>".$nazov." </a>";
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
                $topicy .= "<a href='/topic.php?id=" . $idT . "' class = 'topicy_odkazy'>" . $nazovT . " </a>";
            }
            echo $topicy;
        }
    }

    function topiky($pripojenie,$idPomocna){
        $insert = $pripojenie->prepare("SELECT idPost,nazovPostu,obsah FROM post 
                                       where idTopics = '$idPomocna' ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $this->pocetRiadkov = $insert->num_rows();
        $posty = "";
        if ($this->pocetRiadkov > 0) {
            for ($i = 1;$i <= $this->pocetRiadkov; $i++) {
                $insert->bind_result($id, $nazov, $popis);
                $insert->fetch();
                $posty .= "<a href='/post.php?id=" . $id . "' class = 'posty_odkazy'>".$nazov." </a>";
            }
            echo $posty;
        } else {
            echo "<p style='font-weight: bold;text-align: center;font-size: 25pt;color: var(--biela);'> V tomto topicu nie sú žiadne posty </p>";
        }
    }
}