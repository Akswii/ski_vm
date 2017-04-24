function regNavn()
{
    regEx = /^[a-zÃ¦Ã¸Ã¥A-ZÃ†Ã˜Ã… ]{2,20}$/;
    ok = regEx.test(document.registrer.navn.value);
    if(!ok)
    {
        document.getElementById("feilNavn").innerHTML="Oppgitt navn er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilNavn").innerHTML="";
        return true;
    }
}

function regTel()
{
    regEx = /^[0-9]{8}$/;
    ok = regEx.test(document.registrer.tlf.value);
    if(!ok)
    {
        document.getElementById("feilTel").innerHTML="Oppgitt telefonnr er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilTel").innerHTML="";
        return true;
    }
}

function regEp()
{
    regEx = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    ok = regEx.test(document.registrer.epost.value);
    if(!ok)
    {
        document.getElementById("feilEp").innerHTML="Oppgitt e-post er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilEp").innerHTML="";
        return true;
    }
}
function regOvelse()
{
    regEx = /^[a-zÃ¦Ã¸Ã¥A-ZÃ†Ã˜Ã…0-9 .\-]{2,20}$/;
    ok = regEx.test(document.registrer_o.onavn.value);
    if(!ok)
    {
        document.getElementById("feilOnavn").innerHTML="Oppgitt øvelse er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilOnavn").innerHTML="";
        return true;
    }
}
function regDato()
{
    regEx = /^[\d]{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][\d]|3[0-1])$/;
    ok = regEx.test(document.registrer_o.dato.value);
    if(!ok)
    {
        document.getElementById("feilDato").innerHTML="Oppgitt dato er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilDato").innerHTML="";
        return true;
    }
}
function regTidspunkt()
{
    regEx = /^(0[1-9]|1[\d]|2[0-3]):(0[1-9]|[1-5][\d])$/;
    ok = regEx.test(document.registrer_o.tidspunkt.value);
    if(!ok)
    {
        document.getElementById("feilTidspunkt").innerHTML="Oppgitt tidspunkt er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilTidspunkt").innerHTML="";
        return true;
    }
}
function regUnavn()
{
    regEx = /^[a-zÃ¦Ã¸Ã¥A-ZÃ†Ã˜Ã… ]{2,20}$/;
    ok = regEx.test(document.registrer.u_navn.value);
    if(!ok)
    {
        document.getElementById("feilUnavn").innerHTML="Oppgitt navn er ugyldig";
        return false;
    }
    else
    {
        document.getElementById("feilUnavn").innerHTML="";
        return true;
    }
}

function regAlt()
{
    if(regNavn() && regTel() && regEp())
    {
        return true;
    }
    else return false;
}