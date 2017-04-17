<?php
$db = mysqli_connect("localhost","root","", "db_objekt");
if(!$db)
{
    trigger_error(mysqli_error($db));
    die ("Kunne ikke knytte til server");
}
?>