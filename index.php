<!DOCTYPE html>
<?php
    //error_reporting(0);
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
    <link href="CSS/jumbotron.css" rel="stylesheet">
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
          <form class="form-inline my-2 my-lg-0" action="" method="post">
    <!--Oppdater passord: <br/>
    Brukernavn : <input type="text" name="lagreBrukernavn"/><br/>
    Passord : <input type="password" name="lagrePassord"/><br/>
    Navn : <input type="text" name="lagreNavn"/><br/>
    <input type="submit" name="lagre" value="Oppdater passord"/><br/>-->
        <?php
        session_start();
        $db= new mysqli("localhost","root","","ski-vm");
        if($db->connect_error)
        {
            die("Kunne ikke knytte til db!");
        }
        /*if(isset($_POST["lagre"]))
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
        }*/
        if(isset($_POST["sjekk"]))
        {
            $sjekkBrukernavn = $db->escape_string($_POST["sjekkBrukernavn"]);
            $sjekkPassord = $db->escape_string($_POST["sjekkPassord"]);
            
            $sql = "Select * from innlogging where brukernavn='$sjekkBrukernavn' AND Passord=Password('$sjekkPassord')";
            echo "$sql<br/>";
            $res = $db->query($sql);
            if($db->affected_rows>0)
            {
                
                $_SESSION["login"]=true;
                Header("location: admin.php");
            }
            else
            {
                echo "Feil passord";
                $_SESSION["login"]=false;
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
        
          
        Publikum
        <form action="" method ="post">
        <table border="1">
            <tr>
                <td>Navn: </td>
                <td><input type="text" name="navn" onchange ="valider_navn()" /></td>
                <td></td>
            </tr>
            <tr>
                <td>Tlf: </td>
                <td><input type="text" name="tlf" onchange ="valider_tlf()"/></td>
                <td></td>
            </tr>
            <tr>
                <td>Adresse: </td>
                <td><input type="text" name="adresse" onchange ="valider_adresse()"/></td>
                <td></td>
            </tr>
            <tr>
                <td>Epost: </td>
                <td><input type="text" name="epost" onchange ="valider_epost()"/></td>
                <td></td>
            </tr>
            <tr>
                <td>Øvelser: </td>
                <td></td>
                <td></td>
            </tr>
            <?php
                $db = mysqli_connect("localhost", "root", "", "ski-vm");
                $resultPublikum = $db->query("select * from ovelser");
            
                while ($row = $resultPublikum->fetch_assoc()) {
                      unset($name);
                      $name = $row['ovelse'];
                      
                      echo '<tr>';
                      echo '<td></td>';
                      echo '<td>'.$name.'</td>';
                      echo '<td><input type="checkbox" name="ovelser[]" id="ovelser" value='.$name.' /></td>';
                      echo '</tr>';
            }
                ?>
            
        </table>
                    <input type="submit" name="registrer" value="registrer" />
         </form>
    <br>
    <!--Utøvere
    <form action="" method ="post">
        <table border="1">
            <tr>
                <td>Navn: </td>
                <td><input type="text" name="navn" onchange ="valider_navn()" /></td>
                <td></td>
            </tr>
            <tr>
                <td>Øvelser: </td>
                <td></td>
                <td></td>
            </tr>
            <?php
                /*$db = mysqli_connect("localhost", "root", "", "ski-vm");
                $resultUtover = $db->query("select * from ovelser");
            
                while ($row = $resultUtover->fetch_assoc()) {
                      unset($name);
                      $name = $row['ovelse'];
                      
                      echo '<tr>';
                      echo '<td></td>';
                      echo '<td>'.$name.'</td>';
                      echo '<td><input type="checkbox" name='.$name.' value='.$name.' /></td>';
                      echo '</tr>';
            }*/
                ?>
        </table>
                    <input type="submit" name="registrer" value="registrer" />
         </form>-->
         <?php
         $db = mysqli_connect("localhost", "root", "", "ski-vm");
         if(isset($_REQUEST["registrer"])) {
         
         
         $navn = $_REQUEST["navn"];
         $tlf = $_REQUEST["tlf"];
         $adresse = $_REQUEST["adresse"];
         $epost = $_REQUEST["epost"];
         $test = $_REQUEST["ovelser"];
         $ovelser = "";
            
        if(!preg_match("/^[a-zæøåA-ZÆØÅ ]{2,20}$/", $navn)) {
                echo "Feil i navnet, må være mellom 2 og 20 tegn!<br/>";
                $OK=false; 
        }
        else if(!preg_match("/^[0-9]{8}$/", $tlf)) {
                echo "Feil i nummeret, du må ha 8 tegn!<br/>";
                $OK=false; 
        }
        else if(!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/", $epost)) {
                echo "Feil i epost, du må ha @ og ha nok tegn i eposten!<br/>";
                $OK=false; 
        }
        else if($test=="") {
            echo "Du må velge minst en øvelse!<br/>";
        }
        else {
        
        foreach ($test as $ovelse){
                echo $ovelse.", ";
                $ovelser.=$ovelse.", ";
        }
            
        $sql = "Insert INTO publikum(navn,tlf,epost,adresse,ovelser)";
                $sql .= "Values('$navn','$tlf','$epost','$adresse','$ovelser')";
                $resultat = mysqli_query($db, $sql);
                
                if(!$resultat){
                    echo "Error";
                }
                
        }
        }

         ?>
         <!--<form action="" method ="post">
             <table border="1">
         <?php
                /*$db = mysqli_connect("localhost", "root", "", "ski-vm");
                $resultPrintp = $db->query("select * from ovelser");
            
                while ($row = $resultPrintp->fetch_assoc()) {
                      unset($name);
                      $name = $row['ovelse'];
                      
                      echo "<tr>";
                      echo "<td>".$name."</td>";
                      echo "<td><input type='radio' name='ovelser[]' id='ovelser' value=$name /></td>";
                      echo "</tr>";
            }
            echo "</table>";
                if(isset($_REQUEST['registrer3'])) {
                $test = $_REQUEST['ovelser'];
                $print = "";

                echo "<br><br>";
                foreach ($test as $ovelse){
                    $print.=$ovelse;
                    echo "Øvelsen ".$print." har dette publikumet:<br><br>";
                }

                $resultUtskriftp = $db->query("SELECT navn FROM publikum WHERE ovelser LIKE '%$print%'");
                while ($row = $resultUtskriftp->fetch_assoc()) {
                          unset($name);
                          $name = $row['navn'];
                          echo $name.", ";
                }
            }
            */
        ?>
             <br>
            <input type="submit" name="registrer3" value="registrer" />
    </form>-->
    <form action="" method ="post">
             <table border="1">
                <?php
                       $db = mysqli_connect("localhost", "root", "", "ski-vm");
                       $resultPrintu = $db->query("select * from ovelser");

                       while ($row = $resultPrintu->fetch_assoc()) {
                             unset($name);
                             $name = $row['ovelse'];

                             echo '<tr>';
                             echo '<td>'.$name.'</td>';
                             echo '<td><input type="radio" name="ovelser[]" id="ovelser" value='.$name.' /></td>';
                             echo '</tr>';
                   }
                   echo '</table>';
                   if(isset($_REQUEST["registrer4"])) {
                       $test = $_REQUEST["ovelser"];
                       $print = "";

                       echo "<br><br>";
                       foreach ($test as $ovelse){
                           $print.=$ovelse;
                           echo "Øvelsen ".$print." har disse utøverene:<br><br>";
                   }

                   $resultUtskriftu = $db->query("SELECT Navn FROM utovere WHERE ovelser LIKE '%$print%'");
                   while ($row = $resultUtskriftu->fetch_assoc()) {
                             unset($name);
                             $name = $row['Navn'];
                             echo $name.", ";
                   }
                   }

               ?>
             <br>
            <input type="submit" name="registrer4" value="Vis utøvere" />
    </form>
    
        <h1 class="display-3">Hello, world!</h1>
        
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
        </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2017</p>
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
