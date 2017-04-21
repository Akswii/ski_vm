<!DOCTYPE html>
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
        <script src="JS/validering.js"></script>
        <script>
            function showUser(str) {
                if (str == "") {
                    document.getElementById("txtHint").innerHTML = "";
                    return;
                } else {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("txtHint").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "getuser.php?q=" + str, true);
                    xmlhttp.send();
                }
            }
        </script>
    </head>

    <body>

        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Ski VM</a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Admin page</h1>
                <div id ="inputfelt">
                    <form action="" method ="post">
                        <table border="1">
                            <th>Legg til øvelse</th>
                            <th></th>
                            <tr>
                                <td>Øvelsesnavn: </td>
                                <td><input type="text" name="onavn" onchange="regNavn(this.value)" /></td>
                            </tr>
                            <tr>
                                <td>Dato: </td>
                                <td><input type="date" name="dato" onchange ="valider_dato()"/></td>
                            </tr>
                            <tr>
                                <td>Tidspunkt: </td>
                                <td><input type="time" name="tidspunkt" onchange ="valider_tidspunkt()"/></td>
                            </tr>

                        </table>
                        <input type="submit" name="registrer_ovelse" value="registrer"/>

                        <table id="tabell">
                            <col width=""/>
                            <col width=""/>
                            <col width="200"/>
                            <col width="40"/>
                            <tr>
                                <th>Øvelse</th>
                                <th>Dato</th>
                                <th>Tidspunkt</th>
                            </tr>

                            <?php
                            //tabellkode /slettknapper /dbqueries
                            include 'db_connect.php';
                            include 'php_funksjoner.php';

                            $ovelse_funksjoner = new Ovelse($db);

                            if (isset($_REQUEST['slett_knp'])) { //slette øvelse
                                $boks_id = $_REQUEST['valg_id'];
                                if ($ovelse_funksjoner->slett_o($boks_id)) {
                                    echo "Valg er slettet!";
                                }
                            }

                            if (isset($_REQUEST['oppdater_knp'])) { //oppdater øvelse
                                $navn = $_REQUEST['onavn'];
                                $datoen = $_REQUEST['dato'];
                                $tpunkt = $_REQUEST['tidspunkt'];
                                $boks_id = $_REQUEST['valg_id'];

                                if ($ovelse_funksjoner->oppdater_o($navn, $datoen, $tpunkt, $boks_id)) {
                                    echo "Øvelse oppdatert!";
                                }
                            }

                            if (isset($_REQUEST['registrer_ovelse'])) {//registrere ny øvelse
                                $navn = $_REQUEST['onavn'];
                                $dato = $_REQUEST['dato'];
                                $tpunkt = $_REQUEST['tidspunkt'];

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
                        <input type='submit' name='slett_knp' value='Slett'/>
                        <input type='submit' name='oppdater_knp' value='Oppdater'/>
                    </form>
                </div>

                <div id="utover_boks"> <!-- Div for utøverregistrering og funksjoner for det -->
                    <form action="" method ="post">
                        <table border="1">
                            <th>Utøvere</th>
                            <th></th><th></th>
                            <tr>
                                <td>Navn: </td>
                                <td><input type="text" name="u_navn" onchange ="valider_navn()" /></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Øvelser: </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            include 'db_connect.php';
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
                        <input type="submit" name="registrer_utover" value="registrer" />
                    </form>

                    <form action="" method ="post">
                        <table border="1">
                            <?php
                            include 'db_connect.php';
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
                                    foreach ($boks_id as $valgt) {
                                        $valgt_ovelser .= $valgt . ",";
                                    }echo $valgt_ovelser;

                                    $sql = "Insert INTO utovere(Navn,ovelser)Values('$navn','$valgt_ovelser')";
                                    $resultat = $db->query($sql);

                                    if (!$resultat) {
                                        echo "Error";
                                    } else {
                                        $antallRader = $db->affected_rows;
                                        if ($antallRader <= 0) {
                                            echo "kunne ikke sette inn dataene i databasen!";
                                        } else {
                                            echo "oppdatert";
                                        }
                                    }
                                }
                            }
                            ?></table>


                        <tr>
                            <?php
                            include 'db_connect.php';

                            $resultPrintu = $db->query("select * from ovelser");
                            echo "<select name='select' onchange='showUser(this.value)'>";
                            echo "<option value='' disabled selected>Velg en øvelse å vise</option>";

                            while ($row = $resultPrintu->fetch_assoc()) {
                                $o_name = $row['navn'];

                                echo "<option value='$o_name'> $o_name </option>";
                            }
                            echo '</select>';

                            echo '<div id="txtHint"><b></b></div>';
                            ?>
                        <br>                
                    </form>
                </div>
            </div>

            <div id="publikum_oversikt"> <!-- Div for utskrift av publikumdeltagelse -->

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
