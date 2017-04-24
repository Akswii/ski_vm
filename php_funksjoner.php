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

class Registrer {

    private $db;

    function __construct($db_inn) {
        $this->db = $db_inn;
    }

    function skrivut_p() {
        $resultPublikum = $this->db->query("select * from ovelser");

        while ($row = $resultPublikum->fetch_assoc()) {
            unset($name);
            $name = $row['navn'];

            echo '<tr>' . '<td></td>' . '<td>' . $name . '<input type="checkbox" name="ovelser[]" id="ovelser" value='
            . $name . ' /></td>' . '</tr>';
        }
    }

    public function registrer_p($inn_navn, $inn_tlf, $inn_epost, $inn_adresse, $inn_ovelser) {
        $ovelse_p = "";
        
        foreach ($inn_ovelser as $ovelse) {
            echo $ovelse . ", ";
            $ovelse_p .= $ovelse . ", ";
        }

        $sql = "Insert INTO publikum(navn,tlf,epost,adresse,ovelser)";
        $sql .= "Values('$inn_navn','$inn_tlf','$inn_epost','$inn_adresse','$ovelse_p')";
        $resultat = $this->db->query($sql);

        if (!$resultat) {
            echo "Error";
        }
        return true;
    }

}

class Utover {

    private $db;

    function __construct($db_inn) {
        $this->db = $db_inn;
    }

    function reg_utover($navn, $boks_id) { //registrere ny utøver
        $valgt_ovelser = "";

        foreach ($boks_id as $valgt) {
            $valgt_ovelser .= $valgt . ",";
        }echo $valgt_ovelser;

        $sql = "Insert INTO utovere(Navn,ovelser)Values('$navn','$valgt_ovelser')";
        $resultat = $this->db->query($sql);
        if (!$resultat) {
            echo "Error";
        } else {
            $antallRader = $this->db->affected_rows;
            if ($antallRader <= 0) {
                echo "kunne ikke sette inn dataene i databasen!";
            } else {
                echo "oppdatert";
            }
        }
        return true;
    }

    function skriv_utover() { //velg hvilke øvelse å vise utøvere fra
        $resultPrintu = $this->db->query("select * from ovelser");
        echo "<select name='select' onchange='showUser(this.value)'>";
        echo "<option value='' disabled selected>Velg en øvelse å vise</option>";

        while ($row = $resultPrintu->fetch_assoc()) {
            $o_name = $row['navn'];

            echo "<option value='$o_name'> $o_name </option>";
        }
        echo '</select>';
    }

}

?>