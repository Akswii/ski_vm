<?php

include 'db_connect.php';
$q = $_GET['q'];

$sql = "SELECT Navn, utover_id FROM utovere WHERE ovelser LIKE '%$q%'";
$resultat = $db->query($sql);

echo "<table id='ovelsetabell'>";
echo "<tr><th>Utøver ID</th>
      <th>Utøver navn</th></tr>";
while ($row = $resultat->fetch_assoc()) {
    unset($name);
    unset($id);
    echo "<tr><td>" . $id = $row['utover_id'] . "</td>";
    echo "<td>" . $name = $row['Navn'] . "</td></tr>";
}
echo "</table>";
?>

