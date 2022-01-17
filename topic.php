<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require_once "pracaSDatabazou/pripojenie.php";
require "zakladneStranky/head.php";
require_once "zakladneStranky/postZakladnaStranka.php";
?>
<script src="javaScript/funkcie.js"></script>
<!DOCTYPE html>
<div id = myDropdown>
    <form>
        <select name="post" onchange="ukazPost(this.value)">
            <option value="Select">Select</option>
            <?php
            $id = $_GET['id'];
            $insert = $pripojenie->prepare("SELECT nazovPostu FROM post where idTopics = $id ORDER BY nazovPostu ASC");
            $insert->execute();
            $insert->store_result();
            $pocetRiadkov = $insert->num_rows();
            if ($pocetRiadkov > 0) {
                for ($i = 1; $i <= $pocetRiadkov; $i++) {
                    $insert->bind_result($nazov);
                    $idPomocna = $_GET['id'];
                    $insert->fetch();
                    echo "<option value='$nazov'>" . $nazov . "</option>";
                }
            } else {
                echo "<option value='post'>Nie su tu žiadne posty</option>";;
            }
            ?>
        </select>
    </form>
</div>
<div id="informacie"></div>
</body>
</html>
