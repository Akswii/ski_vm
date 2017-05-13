<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <!--<link rel="icon" href="../../favicon.ico">-->

        <title>Admin</title>

        <!-- Bootstrap core CSS -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="CSS/admin.css" rel="stylesheet">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <script src="JS/validering.js" type="text/javascript"></script>
        <script src="JS/d_valg.js" type="text/javascript"></script>
    </head>

    <body>
        <?php
        session_start();
        if (!$_SESSION["login"]) {
            Header("location: index.php");
        }
        ?>
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Ski VM</a>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <?php
                    if ($_SESSION["admin"]) {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h2>Administrative alternativer</h2>
                <div id ="inputfelt">
                    <form action="" method ="post" name='registrer_o'>
                        <table border="1">
                            <th >Legg til øvelse</th>
                            <th></th>
                            <tr>
                                <td>Øvelsesnavn: </td>
                                <td><input type="text" name="onavn" onchange="regOvelse()" /><div id="feilOnavn"></div></td>
                            </tr>
                            <tr>
                                <td>Dato: </td>
                                <td><input type="date" name="dato" onchange ="regDato()"/><div id="feilDato"></div></td>
                            </tr>
                            <tr>
                                <td>Tidspunkt: </td>
                                <td><input type="time" name="tidspunkt" onchange ="regTidspunkt()"/><div id="feilTid"></div></td>
                            </tr>

                        </table>
                        <input class="btn btn-secondary" type="submit" name="registrer_ovelse" value="Registrer øvelse"/>

                        <br><br><br><br>

                        <table class="tablesa">
                            <col width=""/>
                            <col width=""/>
                            <col width="200"/>
                            <col width="40"/>
                            <col width="40"/>
                            <tr>
                                <th>Øvelse</th>
                                <th>Dato</th>
                                <th>Tidspunkt</th>
                                <th></th>
                                <th></th>
                            </tr>

                            <?php
                            include 'db_connect.php'; //koble opp til databasen
                            include 'php_funksjoner.php'; //alle php funksjoner

                            $ovelse_funksjoner = new Ovelse($db); //lage et objekt av ovelse klassen

                            if (isset($_REQUEST['slett_knapp'])) { //slette øvelse
                                $slett_id = $_REQUEST['slett_knapp'];
                                if ($ovelse_funksjoner->slett_o($slett_id)) {
                                    echo "Valg er slettet!";
                                }
                            }

                            if (isset($_REQUEST['oppdater_knapp'])) { //oppdater øvelse
                                $navn = $_REQUEST['oppdater_navn'];
                                $datoen = $_REQUEST['oppdater_dato'];
                                $tpunkt = $_REQUEST['oppdater_tid'];
                                $oppdater_id = $_REQUEST['oppdater_knapp'];

                                if ($ovelse_funksjoner->oppdater_o($navn, $datoen, $tpunkt, $oppdater_id)) {
                                    echo "Øvelse oppdatert!";
                                }
                            }

                            $idag = new DateTime();
                            if (isset($_REQUEST['registrer_ovelse'])) {//registrere ny øvelse
                                $navn = $_REQUEST['onavn'];
                                $dato = $_REQUEST['dato'];
                                $tpunkt = $_REQUEST['tidspunkt'];
                                $formatidag = $idag->format('Y-m-d');
                                if ($dato < $formatidag) {
                                    echo 'Datoen er utgått<br>';
                                }
                                if (!preg_match("/^[a-zæøåA-ZÆØÅ ]{2,20}$/", $navn)) {
                                    echo "Feil i navnet, må være mellom 2 og 20 tegn!<br/>";
                                    $OK = false;
                                } else if (!preg_match("/^[\d]{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][\d]|3[0-1])$/", $dato)) {
                                    echo "Feil i dato!<br/>";
                                    $OK = false;
                                } else if (!preg_match("/^(0[1-9]|1[\d]|2[0-3]):(0[1-9]|[1-5][\d])$/", $tpunkt)) {
                                    echo "Feil i tidspunkt!$tpunkt<br/>";
                                    $OK = false;
                                } else {
                                    if ($ovelse_funksjoner->registrer_o($navn, $dato, $tpunkt)) {
                                        echo "Øvelse registrert!";
                                    }
                                }
                            }

                            $ovelse_funksjoner->skrivut_o();
                            ?>
                        </table>
                    </form>
                </div>

                <div id="utover_boks"> <!-- Div for utøverregistrering og funksjoner for det -->
                    <form action="" method ="post" name='registrer'>
                        <table>
                            <th>Utøvere</th>
                            <th></th><th></th>
                            <tr>
                                <td>Navn: </td>
                                <td><input type="text" name="u_navn" onchange ="regUnavn()" /><div id="feilUnavn"></div></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Øvelser: </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            $resultUtover = $db->query("select * from ovelser");

                            while ($row = $resultUtover->fetch_assoc()) {
                                $u_name = $row['navn'];

                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td>' . $u_name . '</td>';
                                echo '<td><input type="checkbox" name="valg_id[]" value=' . $u_name . ' /></td>';
                                echo '</tr>';
                            }
                            ?>
                        </table>
                        <input class="btn btn-secondary" type="submit" name="registrer_utover" value="Registrer utøver" />
                    </form>

                    <br><br><br>

                    <form action="" method ="post">
                        <table border="1">
                            <?php
                            $utover_funksjoner = new Utover($db);

                            if (isset($_REQUEST['registrer_utover'])) {//registrere ny utøver
                                $navn = $_REQUEST['u_navn'];
                                $valgt_ovelser = "";
                                $boks_id = $_REQUEST['valg_id'];

                                if (!preg_match("/^[a-zæøåA-ZÆØÅ ]{2,20}$/", $navn)) {
                                    echo "Feil i navnet, må være mellom 2 og 20 tegn!<br/>";
                                    $OK = false;
                                } else if ($boks_id == "") {
                                    echo "Du må velge minst en øvelse!<br/>";
                                } else {
                                    if ($utover_funksjoner->reg_utover($navn, $boks_id)) {
                                        echo "Utøver registrert!";
                                    }
                                }
                            }
                            ?></table>

                        <?php
                        $utover_funksjoner->skriv_utover();

                        if (isset($_REQUEST['slett_u_knp'])) { //slette utover
                            $boks_id = $_REQUEST['velg_uid'];

                            foreach ($boks_id as $valgt) {
                                $db->query("DELETE FROM utovere where utover_id = '$valgt'");
                            }
                        }

                        echo '<div id="txtskrivUt"><b></b></div>';
                        ?>
                    </form>
                </div>
                <div id="publikum_oversikt"> <!-- Div for utskrift av publikumdeltagelse -->
                    </form>
                    <form name ="visPublikum" action ="" method="post">
                        <input type="text" name="publikum_valg" id="publikum_tekst" placeholder="Skriv inn øvelse...">
                        <input class="btn btn-secondary" type="submit" name="vis_publikum" value="Vis Publikum" />

                        <table class="tablesa">
                            <col width="75"/>
                            <col width="75"/>
                            <col width="75"/>
                            <col width="75"/>
                            <tr>
                                <th>Navn</th>
                                <th>Tlf</th>
                                <th>Epost</th>
                                <th>Adresse</th>
                            </tr>
                            <?php
                            $publikum_funksjoner = new Registrer($db);

                            if (isset($_REQUEST["vis_publikum"])) {
                                $publikum_ovelse = $_REQUEST["publikum_valg"];
                                if ($publikum_ovelse == "") {
                                    echo 'Feltet er tomt';
                                } else {
                                    $publikum_funksjoner->skrivut_publikum($publikum_ovelse);
                                }
                            }
                            ?>
                        </table>

                    </form>
                </div>
            </div>


        </div>

        <div class="container">
            <!-- Example row of columns -->
            <hr>

            <footer>
                <p>&copy; MMA 2017</p>
            </footer>
        </div>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="JS/jquery.min.js"><\/script>')</script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="JS/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="JS/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
