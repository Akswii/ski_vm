README | SKI-VM

s188909 - Markus Bugge-Hundere
s232324 - Aksel Wiig
s236326 - Morten Wold

URL : FYLL INN

Login: admin
Passord: admin

Passord-kryptering:

Vi valgte en eldre metode for � salte/hashe innloggingsdelen av nettsiden fordi skoleserveren sin PHP
versjon ikke var oppdatert til PHP 7. 

Funksjonalitetsvalg:

Vi har valgt � designe siden med flere forskjellige m�ter � ta inn eller vise informasjon p�.
Dette er bevisst for � vise at vi kan bruke ulik kode, selvom det kunne v�rt bedre � bruke noe annet.
Vi bruker knapper, input-bokser, rullegardinmenyer og sjekk-bokser.
Generelt skriver vi ut informasjonen i form av tabeller. 

Side oppsett:

0. Meny
I menyen kan en bruker logge seg inn som admin. Er brukeren allerede logget inn vil ikke logginboksen vises. 

1. Publikum-side
En bruker kan her registrere seg for en eller flere �velser i ski-vm.
En bruker kan f� vist en oversikt over hvilke ut�vere som er p� en �velse. 
Man trenger ikke logge inn for � bruke funksjonene.

2. Admin-side
En admin har mulighet for � kunne s�ke opp hvilke publikum som skal p� en �velse. Personen gj�r dette ved � 
skrive inn navnet eller deler av navnet til en �velse. 
Admin-brukeren han mulighet for � registrere nye �velser eller nye ut�vere. Det er en tabell med informasjon om
hvilke �velser som allerede finnes, med mulighet for � slette eller oppdatere de. 
Det er en rullegardinmeny med alle �velser som hvis valgt viser hvilke ut�vere som er registrert til dem.

