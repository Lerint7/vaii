<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pracaSDatabazou/pripojenie.php";
require "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
?>
<!DOCTYPE html>
<div id = myDropdown>
<form action="">
    <select name="post" onchange="showPost(this.value)">
            <option value="Select">Select</option>
            <?php
            $id = $_GET['id'];
            echo $id;
            $insert = $pripojenie->prepare("SELECT nazovPostu FROM post ORDER BY nazovPostu ASC");
            $insert->execute();
            $insert->store_result();
            $pocetRiadkov = $insert->num_rows();
            echo $pocetRiadkov;
            if ($pocetRiadkov > 0) {
                for ($i = 1; $i <= $pocetRiadkov; $i++) {
                    $insert->bind_result($nazov);
                    $idPomocna = $_GET['id'];
                    $insert->fetch();
                    echo "<option value='$nazov'>" . $nazov . "</option>";
                }
            }else {
                echo "<p style='font-weight: bold;text-align: center;font-size: 25pt;color: var(--biela);'> V tomto topicu nie sú žiadne posty </p>";
            }

            ?>
        </select>
</form>
</div>

<div id="informacie">INFORMÁCIE O POSTE SA ZOBRAZIA TU </div>

<script>
    function showPost(str) {
        if (str == "") {
            document.getElementById("informacie").innerHTML = "";
            return;
        }
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("informacie").innerHTML = this.responseText;
        }
        xhttp.open("GET", "ajax.php?q="+str);
        xhttp.send();
    }
</script>
</body>
</html>
