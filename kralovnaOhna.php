<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--veľkost stránky, aby sa šírka nastavila a aký je pomer-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <title>Title</title>
</head>

<body style="background-color: #a9927d ">
<header>
        <nav id="menu">
            <ul>
                <!-- a = odkaz na čokolvek,premenná-->
                <li><a href="clanok.php">Článok</a></li>
                <li><a href="index.php">Domov</a></li>
                <?php
                if(isset($_SESSION['menoLogin'])) {
                    echo  '<li><a href="userPage.php">Profil</a></li>';
                } else {
                    echo '<li><a href="registraciaStranka.php">Registracia</a></li>';
                }
                ?>
            </ul>
        </nav>
   <!-- <div id = "vyhladavac">
        <input type="text" class="searchTerm" placeholder="Čo chcete nájsť??">
    </div>-->
</header>
<main style="width: auto; min-height: 100px; overflow: hidden;" >
    <div style="background-image: url('https://i.ibb.co/6nV300V/pozadie1.png');
        width: 100%; height: 150vh ; position: absolute; opacity: 0.2" >
    </div>
    <div id="stredStranky">
        <div class="titulka">
            <img src="https://i.pinimg.com/564x/81/f2/f6/81f2f6c4e9b56f7307ba0830f7fc34aa.jpg" alt="výjav z knihy" style="width: 100%">
        </div>
        <div class="teloClanku">
            <div class="textClanku">
                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ultrices erat justo, et iaculis orci egestas id. Sed egestas tempus euismod. Vivamus sollicitudin porttitor ipsum at dictum. Pellentesque in congue erat, id varius tellus. Nulla eget nisi mollis, condimentum enim sodales, elementum nulla. Morbi pulvinar magna vitae erat ornare tempus. Nam fringilla lorem sit amet dui pulvinar dignissim. Duis nec imperdiet arcu, et tincidunt tellus. Sed et fermentum lacus. Maecenas enim odio, vulputate id ex sit amet, dapibus aliquet magna. Duis molestie sapien eu mi vulputate feugiat. Donec consequat velit nibh, non gravida enim accumsan sed. Nam maximus mi sed nunc rutrum, nec tincidunt odio pretium. Suspendisse at ligula convallis, bibendum massa porttitor, elementum libero.</p>
                <p>Mauris accumsan semper enim, ut pellentesque ex dignissim ac. Integer consectetur nibh a placerat laoreet. Sed ac tempus purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In egestas odio nunc, vitae hendrerit erat dictum eu. Mauris ultricies quis felis pretium tristique. Maecenas finibus sed lacus at semper. Nullam commodo, ex nec bibendum mollis, odio purus ultricies felis, quis consequat ipsum nibh at odio. Maecenas vestibulum imperdiet ipsum et lacinia. Mauris congue aliquet turpis, quis suscipit nisl eleifend ut. Maecenas quis tristique libero. Nullam hendrerit pulvinar dolor. Duis porta sodales dolor, eget porta felis consectetur id.</p>
                <p>Mauris scelerisque condimentum vehicula. Pellentesque tempus eu dolor a suscipit. Donec tempor nunc a eros convallis, eu rhoncus nisl rhoncus. Etiam sed est iaculis, tristique mauris ut, vestibulum nunc. Pellentesque in pulvinar erat, at laoreet orci. Fusce id magna est. Pellentesque eleifend ultricies massa, quis consequat lacus ullamcorper ac. Vestibulum vel erat ante. Mauris odio tortor, imperdiet sed magna in, sodales bibendum erat. Morbi diam sem, laoreet a gravida eu, suscipit vel quam. Ut dignissim dignissim massa ut commodo. Nullam erat ipsum, venenatis non quam condimentum, iaculis ultrices lectus. Suspendisse potenti. Etiam id laoreet elit.</p>
                <p> Proin in vehicula turpis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean quis velit arcu. Proin laoreet consectetur nisi vitae convallis. Nulla viverra facilisis ante, a placerat tellus vulputate eget. Quisque tincidunt libero diam, vel elementum lorem elementum vel. Praesent vel efficitur ipsum, ac condimentum sapien. Quisque sed gravida dolor. Aenean nec ligula eget tortor luctus facilisis ut vel dolor. Donec neque dolor, lacinia non ipsum at, fringilla aliquet purus.</p>
                <p> Nunc sem massa, ultricies et quam non, sagittis porttitor arcu. Nullam ut est condimentum, blandit lacus sit amet, aliquam leo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras malesuada ligula vel ligula ultrices, sit amet sagittis elit pellentesque. Quisque elementum porta porta. Phasellus aliquet facilisis nunc, in iaculis neque cursus ut. Cras placerat aliquet elit, non viverra tortor gravida at. Duis efficitur risus non placerat lobortis. Pellentesque gravida felis et massa volutpat, in accumsan tellus vulputate.</p>
            </div>
        </div>
    </div>

    <div class="vyhladavaciPanel">
        <iframe width="250" height="200"
            src="https://www.youtube.com/embed/tgbNymZ7vqY?&mute=1">
        </iframe>
        <img src="https://c4.wallpaperflare.com/wallpaper/47/972/904/fantasy-women-face-girl-stare-hd-wallpaper-preview.jpg" class="slideShow" alt="obrázok ženy">
        <img src="https://i1.sndcdn.com/artworks-000311006856-qu0jo3-t500x500.jpg" class="slideShow" alt="obrázok krajiny">
        <img src="https://mk0a2minutetabl7hq7i.kinstacdn.com/wp-content/uploads/2020/02/Arvyre-Continent-Map-23x16-Base-Map.jpg" class="slideShow" alt="obrázok mapy">
        <script src="slideShowScript.js"></script>

        <div class = "panelText">
            <p>“Explore.”</p>
                <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur, mauris molestie eleifend lobortis, justo erat suscipit leo, a varius purus lorem in massa.Lorem ipsum dolor sit amet. Aenean efficitur, mauris molestie eleifend lobortis, justo erat suscipit leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur, mauris molestie eleifend lobortis, justo erat suscipit leo.</span>
        </div>

    </div>

</main >
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("slideShow");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 5000);
    }
</script>

<footer style="top: 250px">
    <p style="text-align: right"> ©2021 Author: Andrea Meleková</p>
    <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
</body>
</html>