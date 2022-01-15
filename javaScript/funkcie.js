
function pridanieKategorie() {
// Get the modal
    var modal = document.getElementById("myModal");
    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];
    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    }
    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    let parametre = {
        pocet : false,
        pismena :false,
        cisla : false,
        specialne : false
    }
    let barSila = document.getElementById("barSila");
    let sprava = document.getElementById("msg");
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
