function ukazat(pomocna){
    document.getElementById(pomocna).style.display = "block";
}

function schovat(pomocna){
    document.getElementById(pomocna).style.display = "none";
}

function deleteZDatabazy(id) {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById(id).innerHTML = this.responseText;
    }
    xhttp.open("GET", "ajaxDelete.php?id="+id, true);
    xhttp.send();
}


function showText1() {
    var text = document.getElementById("prvyText");
    text.classList.add("active");
}

function hideText1() {
    var text = document.getElementById("prvyText");
    text.classList.remove("active");
}
function showText2() {
    var text = document.getElementById("druhyText");
    text.classList.add("active");
}

function hideText2() {
    var text = document.getElementById("druhyText");
    text.classList.remove("active");
}

function showText3() {
    var text = document.getElementById("tretiText");
    text.classList.add("active");
}

function hideText3() {
    var text = document.getElementById("tretiText");
    text.classList.remove("active");
}

function showPost(nazov) {

    if (nazov == "") {
        document.getElementById("informacie").innerHTML = "";
        return;
    }
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        document.getElementById("informacie").innerHTML = this.responseText;
    }
    xhttp.open("GET", "selectAjax.php?q="+nazov,true);
    xhttp.send();
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
document.getElementById("myDropdown").classList.toggle("show");

function kontrolaSilyHesla () {
    let parametre = {
        pocet : false,
        pismena :false,
        cisla : false,
        specialne : false
    }
    let barSila = document.getElementById("barSila");
    let sprava = document.getElementById("sprava");

    let password = document.getElementById("passwd").value;
    parametre.pismena = (/[A-Za-z]+/.test(password)) ? true : false;
    parametre.cisla = (/[0-9]+/.test(password)) ? true : false;
    parametre.specialne = (/[!\"$%&/()=?@~\\.\\;:+*_-]+/.test(password)) ? true : false;
    parametre.pocet = (password.length > 6) ? true : false;
    console.log(Object.values(parametre));

    let dlzkaBaru = Object.values(parametre).filter(value => value);
    console.log(Object.values(parametre), dlzkaBaru);

    barSila.innerHTML = "";
    for (let i of dlzkaBaru) {
        let span = document.createElement("span");
        span.classList.add("strenght");
        barSila.appendChild(span);
    }

    let pomocna = document.getElementsByClassName("strenght");
    for (let i = 0; i < pomocna.length; i++) {
        switch (pomocna.length - 1) {
            case 0:
                pomocna[i].style.background = "#FF0000";
                sprava.textContent = "Veľmi slabé heslo";
                break;
            case 1:
                pomocna[i].style.background = "#ffa500";
                sprava.textContent = "Slabé heslo";
                break;
            case 2:
                pomocna[i].style.background = "#ffff00";
                sprava.textContent = "Silné heslo";
                break;
            case 3:
                pomocna[i].style.background = "#006400";
                sprava.textContent = "Veľmi silné heslo";
                break;
        }
    }
}