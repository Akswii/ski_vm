<!DOCTYPE html>
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
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <?php
            $db = mysqli_connect("localhost", "root", "", "ski-vm");
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
            // username and password sent from Form
            $username=mysqli_real_escape_string($db,$_POST['username']); 
            $password=mysqli_real_escape_string($db,$_POST['password']); 
            $password=md5($password); // Encrypted Password
            $sql="Insert into innlogging(brukernavn,passord) values('$username','$password');";
            $result=mysqli_query($db,$sql);
            echo "Registration Successfully";
            }
            ?>
            <form action="" method="post">
            <label>UserName :</label>
            <input type="text" name="username"/><br />


            <label>Password :</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value=" Registration "/><br />
            </form>
        <?php
            $db = mysqli_connect("localhost", "root", "", "ski-vm");
            session_start();
            if($_SERVER["REQUEST_METHOD"] == "POST")
            {
            // username and password sent from Form
            $username=mysqli_real_escape_string($db,$_POST['username']); 
            $password=mysqli_real_escape_string($db,$_POST['password']); 
            $password=md5($password); // Encrypted Password
            $sql="SELECT brukernavn FROM innlogging WHERE brukernavn='$username' and passord='$password'";
            $result=mysqli_query($db,$sql);
            $count=mysqli_num_rows($db,$result);

            // If result matched $username and $password, table row must be 1 row
            if($count==1)
            {
            header("location: admin.php");
            }
            else 
            {
            $error="Your Login Name or Password is invalid";
            }
            }
            ?>
            <form action="" method="post">
            <label>UserName :</label>
            <input type="text" name="username"/><br />
            <label>Password :</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value=" Login "/><br />
            </form>
          
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
    Utøvere
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
                $db = mysqli_connect("localhost", "root", "", "ski-vm");
                $resultUtover = $db->query("select * from ovelser");
            
                while ($row = $resultUtover->fetch_assoc()) {
                      unset($name);
                      $name = $row['ovelse'];
                      
                      echo '<tr>';
                      echo '<td></td>';
                      echo '<td>'.$name.'</td>';
                      echo '<td><input type="checkbox" name='.$name.' value='.$name.' /></td>';
                      echo '</tr>';
            }
                ?>
        </table>
                    <input type="submit" name="registrer" value="registrer" />
         </form>
         <?php
         $db = mysqli_connect("localhost", "root", "", "ski-vm");
         if(isset($_REQUEST["registrer"])) {
         
         
         $navn = $_REQUEST["navn"];
         $tlf = $_REQUEST["tlf"];
         $adresse = $_REQUEST["adresse"];
         $epost = $_REQUEST["epost"];
         $test = $_REQUEST["ovelser"];
         $ovelser = "";
         
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

         ?>
         <form action="" method ="post">
             <table border="1">
         <?php
                $db = mysqli_connect("localhost", "root", "", "ski-vm");
                $resultPrintp = $db->query("select * from ovelser");
            
                while ($row = $resultPrintp->fetch_assoc()) {
                      unset($name);
                      $name = $row['ovelse'];
                      
                      echo '<tr>';
                      echo '<td>'.$name.'</td>';
                      echo '<td><input type="radio" name="ovelser[]" id="ovelser" value='.$name.' /></td>';
                      echo '</tr>';
            }
            echo '</table>';
            if(isset($_REQUEST["registrer3"])) {
            $test = $_REQUEST["ovelser"];
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
            
        ?>
             <br>
            <input type="submit" name="registrer3" value="registrer" />
    </form>
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
            <input type="submit" name="registrer4" value="registrer" />
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
