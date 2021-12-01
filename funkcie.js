function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

let parametre = {
    pocet : false,
    pismena :false,
    cisla : false,
    specialne : false
}
let barSila = document.getElementById("barSila");
let sprava = document.getElementById("msg");

function kontrolaSilyHesla () {
    let password = document.getElementById("passwd").value;

    parametre.pismena = (/[A-Za-z]+/.test(password))?true:false;
    parametre.cisla = (/[0-9]+/.test(password))?true:false;
    parametre.specialne = (/[!\"$%&/()=?@~\\.\\;:+*_-]+/.test(password))?true:false;
    parametre.pocet = (password.length > 6)?true:false;
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
    for(let i = 0; i < pomocna.length; i++) {
        switch (pomocna.length -1){
            case 0:
                pomocna[i].style.background = "#FF0000";
                msg.textContent = "Veľmi slabé heslo";
                break;
            case 1:
                pomocna[i].style.background = "#ffa500";
                msg.textContent = "Slabé heslo";
                break;
            case 2:
                pomocna[i].style.background = "#ffff00";
                msg.textContent = "Silné heslo";
                break;
            case 3:
                pomocna[i].style.background = "#006400";
                msg.textContent = "Veľmi silné heslo";
                break;
        }
    }

}