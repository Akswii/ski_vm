<?php

include 'db_connect.php';
$q = $_GET['q'];

$sql = "SELECT Navn FROM utovere WHERE ovelser LIKE '%$q%'";
$sql2 = "SELECT * FROM utovere";
$resultat = $db->query($sql);

echo "<table id='ovelsetabell'>";
while ($row = $resultat->fetch_assoc()) {
    unset($name);
    echo "<tr><td>" . $name = $row['Navn'] . "</td></tr>";
}
echo "</table>";
?>

