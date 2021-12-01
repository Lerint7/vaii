<?php
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
require "head.php"
?>
<body>
    <div id="citat">
        <!-- span krátky text-->
        <p>“War is always an adventure to those who've never seen it.”</p>
        <span>Anthony Ryan, Blood Song</span>
    </div>
<div id="pozadieHome"> </div>
<div id = knihyPozadie style="width: 100% ; height: 100%">

    <div style="position: relative; min-height: 10px">
    <div id="uvodnytext">
        <p>“Explore.”</p>
        <span>orem ipsum dolor sit amet, consectetur adipiscing elit. Aenean efficitur, mauris molestie eleifend lobortis, justo erat suscipit leo, a varius purus lorem in massa. </span>
    </div>

    <svg viewBox="0 0 500 300"
         preserveAspectRatio="xMinYMin meet">
        <path d="M0, 40 C75, 150 350,
                0 500, 100 L500, 0 L0, 0 Z"
              style="stroke:none; fill:var(--tmavoModra) ">
        </path>
    </svg>
    </div>

<div id = "ObrazkyKnih">
    <a onmouseenter="showText1()" onmouseleave="hideText1()" href="kralovnaOhna.php" class="obrazkyKnihOdkaz">
     <img src="https://pbs.twimg.com/media/D2GPQMDWoAAe8G6.jpg" alt="prebal knihy Kráľovna ohňa" class="obrazok">
        <span class= "text">"Aenean efficitur"</span>
    </a>
<!--niečo je zle-->
    <a onmouseenter="showText2()" onmouseleave="hideText2()" class="obrazkyKnihOdkaz" href="panVeze.php">
        <img src="https://pbs.twimg.com/media/D2GPR0oXcAUAqnD?format=jpg&name=medium" alt="prebal knihy Pán veže" class="obrazok">
        <em class= "text">"Iny text"</em>
    </a>

    <a onmouseenter="showText3()" onmouseleave="hideText3()" class="obrazkyKnihOdkaz" href="piesenKrvy.php">
        <img src="https://cdnb.artstation.com/p/assets/images/images/001/464/415/large/navar-n-1.jpg?1446885755" alt="prebal knihy Píseň krve" class="obrazok">
        <p class= "text">"treti text"</p>
    </a>
</div>

</div> <img src="https://karenmyersauthor.com/wp-content/uploads/2017/06/Fleuron-SectionDivider-1800x239-1024x136.jpg" alt="oddelovač" style="width: 100%; height: 25px">

<footer>
    <p style="text-align: right"> ©2021 Author: Andrea Meleková</p>
    <p style="text-align: right"><a href="mailto:a.melekova@gmail.com">a.melekova@gmail.com</a></p>
</footer>
<!--treba dať dokopy-->
<script>
    function showText1() {
        var text = document.querySelector("span.text ");
        text.classList.add("active");
    }

    function hideText1() {
        var text = document.querySelector("span.text");
        text.classList.remove("active");
    }
    function showText2() {
        var text = document.querySelector("em.text ");
        text.classList.add("active");
    }

    function hideText2() {
        var text = document.querySelector("em.text ");
        text.classList.remove("active");
    }

    function showText3() {
        var text = document.querySelector("p.text ");
        text.classList.add("active");
    }

    function hideText3() {
        var text = document.querySelector("p.text ");
        text.classList.remove("active");
    }
</script>
</body>
</html>