<?php
echo '<script src="javaScript/funkcie.js"></script>';

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

    function posty ($pripojenie,$idPomocna){
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

    function topikyForum($pripojenie,$id) {
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

    public function updatePostu($pripojenie,$co, $cozmena,$podmienka)
    {
        $update = $pripojenie->prepare("UPDATE post SET $co = ? where idPost = ?");
        $update->bind_param('si',$cozmena,$podmienka);
        $update->execute();
    }

    public function vypisDropDowMenu ($pripojenie,$nazov,$odkial,$bind) {
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

    public function vypisDropDownPosty($pripojenie,$id){
        $insert = $pripojenie->prepare("SELECT nazovPostu FROM post where idTopics = $id ORDER BY nazovPostu ASC");
        $insert->execute();
        $insert->store_result();
        $pocetRiadkov = $insert->num_rows();
        if ($pocetRiadkov > 0) {
            for ($i = 1; $i <= $pocetRiadkov; $i++) {
                $insert->bind_result($nazov);
                $insert->fetch();
                echo "<option value='$nazov'>" . $nazov . "</option>";
            }
        } else {
            echo "<option value='post'>Nie su tu žiadne posty</option>";
        }
    }

    public function nachadzaSa($pripojenie,$tabulka,$co,$comu):int {
        $insert = $pripojenie->prepare("SELECT * from $tabulka where $co = ?");
        $insert->bind_param('s', $comu);
        $insert->execute();
        $insert->store_result();
        echo $insert->num_rows();;
        return $insert->num_rows();
    }

    public function getMenoUzivatel(): string
    {
        return $this->menoUzivatel;
    }

    public function getPopisPostu(): string
    {
        return $this->popisPostu;
    }


    public function getNazovPostu(): string
    {
        return $this->nazovPostu;
    }

}