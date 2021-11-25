<?php session_start();
require "pripojenie.php";
if (!isset($_SESSION['menoLogin'])) {
    header("Location:diskusia.php");
    die;
}
$insert = $pripojenie->prepare("SELECT meno, email FROM users WHERE meno = ?");
$insert->bind_param('s', $_SESSION['menoLogin']);
$insert->execute();
$insert->store_result();
$insert->bind_result($meno, $email);
$insert->fetch();

if (isset($_POST['zmenaMena'])) {
    $insert = $pripojenie->prepare("UPDATE users set meno = ? where meno = ?");
    $insert->bind_param('ss', $_POST['zmenaMena'] , $_SESSION['menoLogin']);
    $insert->execute();
    $_SESSION['menoLogin'] = $_POST['zmenaMena'];
    header("Refresh:0");
}

if (isset($_POST['zmenaMailu'])) {
    $insert = $pripojenie->prepare("UPDATE users set email = ? where meno = ?");
    $insert->bind_param('ss', $_POST['zmenaMailu'] , $_SESSION['menoLogin']);
    $insert->execute();
    header("Refresh:0");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>
<body style="background-color: lightgrey ">
<header>
    <nav id="menu">
        <ul>
            <!-- a = odkaz na čokolvek,premenná-->
            <li><a href="clanok.php">Článok</a></li>
            <li><a href="index.php">Domov</a></li>
            <li><a href="diskusia.php">Diskusia</a></li>
        </ul>
    </nav>
</header>
<div id = "profil" >
    <div id = "profiloveOkno">
        <div id = "profilFoto"></div>
        <div id = "menoLogin">
            <p> Meno </p>
        </div>
    </div>

    <div form id = "odhlasenie">
        <form method="post" enctype="application/x-www-form-urlencoded" action="odhlasenie.php">
            <input type="submit" value="Odhlásenie" style="position: absolute;top: 0;right: 0;">
        </form>
    </div>

    <div id = "profiloveUdaje" style="list-style: none">
        <form method="post" enctype="application/x-www-form-urlencoded" >
        <div id="main-div">
            <div id = "menoUdaje" >
                <label for="input">Meno</label>
                <input type="text" id="input" name = "zmenaMena" value = "<?php echo $meno ?>">
            </div>
            <div id = "emailUdaje" >
                <label for="input">Emailová adresa</label>
                <input type="text" id="input" name = "zmenaMailu" value = "<?php echo $email ?>">
            </div>
            <div id = "hesloUdaje" >
                <label for="input">Heslo</label>
                <input type="password" id="input" >
            </div>
            <div id = "hesloPotvrdeneUdaje">
                <label for="input">Heslo znova</label>
                <input type="password" id="input" >
            </div>
        </div>
        <input type="submit" value="Zmena údajov" name = "zmenaUdajov" style="width: 100%; height: 10%; font-size: 16pt; margin: auto">
        </form>
    </div>
</div>

<footer style="position: fixed">
    <p> ©2021 Author: Andrea Meleková</p>
    <p><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
</body>
</html>