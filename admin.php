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
        <style type="text/css">
            tr.header
            {
                font-weight:bold;
            }
            tr.alt
            {
                background-color: #777777;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
               $('.striped tr:even').addClass('alt');
            });
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
                Legg til øvelse
            <form action="" method ="post">
            <table border="1">
            <tr>
                    <td>Øvelsesnavn: </td>
                    <td><input type="text" name="onavn" onchange ="valider_onavn()" /></td>
                </tr>
                <tr>
                    <td>Dato: </td>
                    <td><input type="date" name="dato" onchange ="valider_dato()"/></td>
                </tr>
                <tr>
                    <td>Tidspunkt: </td>
                    <td><input type="text" name="tidspunkt" onchange ="valider_tidspunkt()"/></td>
                </tr>

                </table>
                        <input type="submit" name="registrer" value="registrer"/>
             </form>
           </div>
        
        
        <div id="ovelsetabell">
           <form action='' method ='post'>
                <table id="tabell">
                    <col width="">
                    <col width="">
                    <col width="20">
                    <tr>
                        <th>Øvelse</th>
                        <th>Dato</th>
                        <th>Tidspunkt</th>
                    </tr>

                    <?php //tabellkode /slettknapper /dbqueries
                    include 'db_connect.php';
                    $result = $db->query("select * from ovelser");

                    while ($row = $result->fetch_assoc()) {
                              $id = $row['ovelses_id'];
                              $navn = $row['navn'];
                              $tidspunkt = $row['tid'];
                              $dato = $row['dato'];

                              /*echo "<tr><td>".$navn."</td>"."<td>".$dato."</td>"."<td>".$tidspunkt."</td>"."<td>"
                                      . "<form action='' method ='post'>"
                                      . "<input type='image' name ='slett' src='d_button.png' alt='Submit' id='slett_btn'/>"
                                      . "</form></td></tr>";*/

                                echo "<tr><td>".$navn."</td>"."<td>".$dato."</td>"."<td>".$tidspunkt."</td>"."<td>"
                                      ."<input type='checkbox' name ='slett[]' id='slett_select'/></td></tr>";

                    }
                    ?>
                </table>
                <input type='submit' name='slett' value='slett'/>
            </form>
            
        <?php //legge til ny øvelse ol. funksjonalitet
        include 'db_connect.php';
        
            if(isset($_REQUEST['slett'])){
                        //$result = $db->query("select * from ovelser where ");
                            echo '<script language="javascript">';
                            echo 'alert("message successfully sent")';
                            echo '</script>';
                    }
            
            if(isset($_REQUEST['registrer']))
            {
                $navn = $_REQUEST['onavn'];
                $dato = $_REQUEST['dato'];
                $tpunkt = $_REQUEST['tidspunkt'];

                $sql = "Insert INTO ovelser(navn,dato,tid)Values('$navn','$dato','$tpunkt')";
                $resultat = $db->query($sql);

                if(!$resultat)
                {
                    echo "Error";
                }
                else
                {
                    $antallRader = $db->affected_rows;
                    if($antallRader <= 0)
                    {
                        echo "kunne ikke sette inn dataene i databasen!";
                    }
                    else 
                    {
                        echo '<script language="javascript">';
                        echo 'alert("message successfully sent")';
                        echo '</script>';
                    }
                }
            }
            ?>
        </div>
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
