
    
var ime = document.getElementById("registracija_ime");
var prezime = document.getElementById("registracija_prezime");
var registracija = document.getElementById("registracija");
var lozinkaPotvrda = document.getElementById("registracija_lozinkapotvrda");
var email = document.getElementById("registracija_email");
var lozinka = document.getElementById("registracija_lozinka");
function noviCSS(){
    input.style.color="#543455";
}

function stariCSS(){
    this.className = "dobarCSS";
}


function provjera(){
    
    var pod1 = this.value;
    var sadrzi = false;
    var imeS = false;
    if (pod1[0] !== pod1[0].toUpperCase()){
        
        if (this.name === ime.name){
        document.getElementById("greska_ime").innerHTML ="Mora sadrzavati veliko pocetno slovo";
        ime.style.background="#26C7BC";
        }
        if (this.name === prezime.name)
        {
        document.getElementById("greska_prezime").innerHTML ="Mora sadrzavati veliko pocetno slovo";
        prezime.style.background="#26C7BC";
        }
        imeS = true; 
        this.focus();
    }
    if(!imeS){
    for (var i = 0; i < pod1.length; i++){
         if (pod1[i] == 0 || pod1[i] == 1 || pod1[i] == 2 || pod1[i] == 3 || 
             pod1[i] == 4 || pod1[i] == 5 || pod1[i] == 6 || pod1[i] == 7
             || pod1[i] == 8 || pod1[i] == 9 )
             sadrzi = true;      
}
    }
    if (sadrzi){
        
        if (this.name === ime.name)
        document.getElementById("greska_ime").innerHTML ="nesmije sadržavati brojeve";
        if (this.name === prezime.name)
        document.getElementById("greska_prezime").innerHTML ="nesmije sadržavati brojeve";
        this.focus();
    }
    if(!sadrzi && !imeS){
        ime.style.background="#FFFFFF";
        prezime.style.background="#FFFFFF";
        document.getElementById("greska_ime").innerHTML ="";
        document.getElementById("greska_prezime").innerHTML ="";
        
    }
    
    sadrzi = false;
    imeS = false;
    
}

function provjeriLozinku(){
    var loz1 = document.getElementById("registracija_lozinka").value;
    var loz2 = document.getElementById("registracija_lozinkapotvrda").value;
    if (loz1 === loz2){
        document.getElementById("greska_potvrda").innerHTML ="";
        lozinkaPotvrda.style.background="#FFFFFF";
    }
    else{
        document.getElementById("greska_potvrda").innerHTML ="Lozinke se nepodudaraju";
        lozinkaPotvrda.style.background="#26C7BC";
    }
}
function provjeriEmail(){
    var emailProvjera=email.value;
    var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
    if(emailProvjera.match(pattern)){
        email.style.background="#FFFFFF";
        document.getElementById("greska_email").innerHTML="U redu";
    }
    else{
        email.style.background="#26C7BC";
        document.getElementById("greska_email").innerHTML="Email nije ispravan";
        this.focus();
    }
}

function provjeriDuljinuLozinke(){
    var loz = lozinka.value;
    if(loz.length < 6){
        lozinka.style.background="#26C7BC";
        document.getElementById("greska_lozinka").innerHTML="Lozinka mora imat 6 ili vise znakova";
        this.focus();
    }
    else{
        lozinka.style.background="#FFFFFF";
        document.getElementById("greska_lozinka").innerHTML="";
    }
}

ime.addEventListener("blur", provjera);
prezime.addEventListener("blur", provjera);
lozinkaPotvrda.addEventListener("blur", provjeriLozinku);
email.addEventListener("blur", provjeriEmail);
lozinka.addEventListener("blur", provjeriDuljinuLozinke);