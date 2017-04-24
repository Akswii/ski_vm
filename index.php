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

        <title>Jumbotron Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="CSS/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="CSS/index.css" rel="stylesheet">

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
        <script type="text/javascript" src="JS/validering.js"></script>
    </head>

    <body>

        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Ski VM</a>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">

                </ul>
                <form class="form-inline my-2 my-lg-0" action="" method="post">
                    <!--Oppdater passord: <br/>
                    Brukernavn : <input type="text" name="lagreBrukernavn"/><br/>
                    Passord : <input type="password" name="lagrePassord"/><br/>
                    Navn : <input type="text" name="lagreNavn"/><br/>
                    <input type="submit" name="lagre" value="Oppdater passord"/><br/>-->
                    <?php
                    session_start();
                    /* if(isset($_POST["lagre"]))
                      {
                      $lagreBrukernavn = $_POST["lagreBrukernavn"];
                      $lagrePassord = $_POST["lagrePassord"];
                      $lagreNavn = $_REQUEST["lagreNavn"];

                      $sql = "Update innlogging Set passord = Password('$lagrePassord'), navn = '$lagreNavn' where brukernavn='$lagreBrukernavn'";
                      $res = $db->query($sql);
                      if($db->affected_rows>0)
                      {
                      echo "Oppdatering OK";
                      }
                      else
                      {
                      echo "Oppdatering ikke OK";
                      }
                      } */
                    if (isset($_POST["sjekk"])) {
                        $sjekkBrukernavn = $db->escape_string($_POST["sjekkBrukernavn"]);
                        $sjekkPassord = $db->escape_string($_POST["sjekkPassord"]);

                        $sql = "Select * from innlogging where brukernavn='$sjekkBrukernavn' AND Passord=Password('$sjekkPassord')";
                        echo "$sql<br/>";
                        $res = $db->query($sql);
                        if ($db->affected_rows > 0) {

                            $_SESSION["login"] = true;
                            Header("location: admin.php");
                        } else {
                            echo "Feil passord";
                            $_SESSION["login"] = false;
                        }
                    }
                    ?>
                    <input type="text" name="sjekkBrukernavn" placeholder="Brukernavn"/><br/>
                    <input type="password" name="sjekkPassord" placeholder="Passord"/><br/>
                    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="login" name="sjekk">
                </form>
            </div>
        </nav>
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">


                <div id="tabell1">
                    <form action="" method ="post" name="registrer">
                        <table border="1">
                            <th>Publikum</th>
                            <th></th>
                            <tr>
                                <td>Navn: </td>
                                <td id="td1"><input type="text" name="navn" onchange ="regNavn()" /><div id="feilNavn"></div></td>
                            </tr>
                            <tr>
                                <td>Tlf: </td>
                                <td id="td2"><input type="text" name="tlf" onchange ="regTel()"/><div id="feilTel"></div></td>
                            </tr>
                            <tr>
                                <td>Adresse: </td>
                                <td><input type="text" name="adresse" onchange ="valider_adresse()"/></td>
                            </tr>
                            <tr>
                                <td>Epost: </td>
                                <td id="td3"><input type="text" name="epost" onchange ="regEp()"/><div id="feilEp"></div></td>
                            </tr>
                            <tr>
                                <td>Øvelser: </td>
                                <td></td>
                            </tr>
                            <?php
                            include 'php_funksjoner.php';
                            $registrer_funksjoner = new Registrer($db);
                            if (isset($_REQUEST["registrer"])) {


                                $navn = $_REQUEST["navn"];
                                $tlf = $_REQUEST["tlf"];
                                $adresse = $_REQUEST["adresse"];
                                $epost = $_REQUEST["epost"];
                                $test = $_REQUEST["ovelser"];
                                $ovelser = "";

                                if (!preg_match("/^[a-zæøåA-ZÆØÅ ]{2,20}$/", $navn)) {
                                    echo "Feil i navnet, må være mellom 2 og 20 tegn!<br/>";
                                    $OK = false;
                                } else if (!preg_match("/^[0-9]{8}$/", $tlf)) {
                                    echo "Feil i nummeret, du må ha 8 tegn!<br/>";
                                    $OK = false;
                                } else if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $epost)) {
                                    echo "Feil i epost, du må ha @ og ha nok tegn i eposten!<br/>";
                                    $OK = false;
                                } else if ($test == "") {
                                    echo "Du må velge minst en øvelse!<br/>";
                                } else {
                                    if ($registrer_funksjoner->registrer_p($navn, $tlf, $epost, $adresse, $ovelser)) {
                                        echo 'Publikum registrert';
                                    }
                                }
                            }
                            $registrer_funksjoner->skrivut_p();
                            ?>

                        </table>
                        <br>
                        <input class="btn btn-secondary" type="submit" name="registrer" value="Registrer" />

                    </form>
                </div>
                <br>

                <div id="tabell2">
                    <?php
                    include 'db_connect.php';
                    $utover_funksjoner = new Utover($db);
                    $utover_funksjoner->skriv_utover();

                    echo '<div id="txtHint"><b></b></div>';
                    ?>
                    <br>

                    </form>
                </div>
            </div>

        </div>
        <div id="feilmelding">
            <?php
            ?>
        </div>  
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
            </div>
            <hr>
            <footer>
                <p>&copy; MMA 2017</p>
            </footer>
        </div> <!-- /container -->


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
