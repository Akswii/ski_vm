<?php

include 'db_connect.php';
$q = $_GET['q'];

$sql = "SELECT Navn, utover_id FROM utovere WHERE ovelser LIKE '%$q%'";
$resultat = $db->query($sql);

echo "<table class='tablesa'>";
echo "<tr><th>Utøver ID</th>
      <th>Utøver navn</th>
      <th></th></tr>";
while ($row = $resultat->fetch_assoc()) {
    unset($name);
    unset($id);
    echo "<tr><td>" . $id = $row['utover_id'] . "</td>";
    echo "<td>" . $name = $row['Navn'] . "</td>";
    echo "<td><input type='checkbox' name ='velg_uid[]' value='$id' id='slett_select'/></td></tr>";
}
echo "</table>";
echo '<input class="btn btn-secondary" type="submit" name="slett_u_knp" value="Slett valg"/>';
?>

