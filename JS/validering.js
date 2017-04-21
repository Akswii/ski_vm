function regNavn()
{
    regEx = /^[a-zÃ¦Ã¸Ã¥A-ZÃ†Ã˜Ã… ]{2,20}$/;
    ok = regEx.test(document.skjema.navn.value);
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
    ok = regEx.test(document.skjema.telefonnr.value);
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
    ok = regEx.test(document.skjema.epost.value);
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

function regAlt()
{
    if(regNavn() && regTel() && regEp())
    {
        return true;
    }
    else return false;
}