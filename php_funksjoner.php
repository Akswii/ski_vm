<?php

class Ovelse {

    private $db;

    function __construct($db_inn) {
        $this->db = $db_inn;
    }

    public function slett_o($inn_valgid) {//slette øvelse
        $boks_id = $inn_valgid;

        foreach ($boks_id as $valgt) {
            $this->db->query("DELETE FROM ovelser where ovelses_id = '$valgt'");
        }
        return true;
    }

    public function oppdater_o($inn_navn, $inn_dato, $inn_tpunkt, $inn_id) {//oppdater øvelse
        $navn = $inn_navn;
        $datoen = $inn_dato;
        $tpunkt = $inn_tpunkt;
        $boks_id = $inn_id;

        foreach ($boks_id as $valgt) {
            $sql = "UPDATE `ovelser` SET `navn`='$navn',`dato`='$datoen',`tid`='$tpunkt' WHERE ovelses_id = '$valgt'";
            $resultat = $this->db->query($sql);

            if (!$resultat) {
                echo "Error";
            } else {
                $antallRader = $this->db->affected_rows;
                if ($antallRader <= 0) {
                    echo "kunne ikke sette inn dataene i databasen!";
                } else {
                    return true;
                }
            }
        }
    }

    public function registrer_o($inn_navn, $inn_dato, $inn_tpunkt) {//registrere ny øvelse
        $navn = $inn_navn;
        $datoen = $inn_dato;
        $tpunkt = $inn_tpunkt;

        $sql = "Insert INTO ovelser(navn,dato,tid)Values('$navn','$datoen','$tpunkt')";
        $resultat = $this->db->query($sql);
        if (!$resultat) {
            echo "Error";
        } else {
            $antallRader = $this->db->affected_rows;
            if ($antallRader <= 0) {
                echo "kunne ikke sette inn dataene i databasen!";
            } else {
                return true;
            }
        }
    }

    public function skrivut_o() {
        $result = $this->db->query("select * from ovelser"); //skrive ut alle øvelser
        while ($row = $result->fetch_assoc()) {
            $id = $row['ovelses_id'];
            $navn = $row['navn'];
            $tidspunkt = $row['tid'];
            $dato = $row['dato'];

            echo "<tr><td>" . $navn . "</td>" . "<td>" . $dato . "</td>" . "<td>" . $tidspunkt . "</td>" . "<td>"
            . "<input type='checkbox' name ='valg_id[]' value='$id' id='slett_select'/></td></tr>";
        }
    }
}
?>