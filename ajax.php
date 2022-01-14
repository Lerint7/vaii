<?php
require_once "pracaSDatabazou/pripojenie.php";
$sql = $pripojenie->prepare("SELECT idPost, nazovPostu, obsah FROM post
                            WHERE nazovPostu = ?");
$sql->bind_param("s", $_GET['q']);
$sql->execute();
$sql->store_result();
$sql->bind_result($id, $name, $popis);
$sql->fetch();
$sql->close();

echo "<span style='position: fixed; font-size: 24pt;font-weight: bold; color: var(--biela); top: 20%; text-align: center; width: inherit;left: 15%;right: 15%'> $name </span>";
echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 30%; text-align: center; width: inherit;left: 15%;right: 15%'> $popis </span>";
//echo "<span style='position: fixed; font-size: 16pt; color: var(--biela); top: 15%;left: 13%; width: inherit'> $menoUzivatela </span>";