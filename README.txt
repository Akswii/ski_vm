README | SKI-VM

s188909 - Markus Bugge-Hundere
s232324 - Aksel Wiig
s236326 - Morten Wold

URL : FYLL INN

Login: admin
Passord: admin

Passord-kryptering:

Vi valgte en eldre metode for å salte/hashe innloggingsdelen av nettsiden fordi skoleserveren sin PHP
versjon ikke var oppdatert til PHP 7. 

Funksjonalitetsvalg:

Vi har valgt å designe siden med flere forskjellige måter å ta inn eller vise informasjon på.
Dette er bevisst for å vise at vi kan bruke ulik kode, selvom det kunne vært bedre å bruke noe annet.
Vi bruker knapper, input-bokser, rullegardinmenyer og sjekk-bokser.
Generelt skriver vi ut informasjonen i form av tabeller. 

Side oppsett:

0. Meny
I menyen kan en bruker logge seg inn som admin. Er brukeren allerede logget inn vil ikke logginboksen vises. 

1. Publikum-side
En bruker kan her registrere seg for en eller flere øvelser i ski-vm.
En bruker kan få vist en oversikt over hvilke utøvere som er på en øvelse. 
Man trenger ikke logge inn for å bruke funksjonene.

2. Admin-side
En admin har mulighet for å kunne søke opp hvilke publikum som skal på en øvelse. Personen gjør dette ved å 
skrive inn navnet eller deler av navnet til en øvelse. 
Admin-brukeren han mulighet for å registrere nye øvelser eller nye utøvere. Det er en tabell med informasjon om
hvilke øvelser som allerede finnes, med mulighet for å slette eller oppdatere de. 
Det er en rullegardinmeny med alle øvelser som hvis valgt viser hvilke utøvere som er registrert til dem.

