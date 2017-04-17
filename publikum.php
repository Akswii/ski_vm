<?php


class Publikum {
                private $navn;
                private $tlf;
                private $adresse;
                private $epost;
                
                public function get_navn () {return $this->navn;}
                public function get_tlf () {return $this->tlf;}
                public function get_adresse () {return $this->adresse;}
                public function get_epost () {return $this->epost;}
                
                public function set_navn ($navn) {$this->navn=$navn;}
                public function set_tlf ($tlf) {$this->tlf=$tlf;}
                public function set_adresse ($adresse) {$this->adresse=$adresse;}
                public function set_epost ($epost) {$this->epost=$epost;}           
}
    


