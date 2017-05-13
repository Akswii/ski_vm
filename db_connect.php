<?php
$db = mysqli_connect("localhost","root","", "db_objekt");
if(!$db)
{
    trigger_error(mysqli_error($db));
    echo "database kunne ikke koble til";
    error_log("database kunne ikke koble til - ", 3, "Logg.txt");
    echo '<script type="text/javascript">alert("kunne ikke koble til databasen");</script>';
    //die ("Kunne ikke knytte til server");
}
?>