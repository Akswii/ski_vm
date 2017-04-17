<?php

class Ovelser {
                private $ovelse;
                private $tidspunkt;
                private $dato;
                
                function __construct($n_ovelse,$n_tidspunkt,$n_dato){
                    $this->ovelse=$n_ovelse;
                    $this->tidspunkt=$n_tidspunkt;
                    $this->dato=$n_dato;
                }
                
                public function get_ovelse () {return $this->ovelse;}
                public function get_tidspunkt () {return $this->tidspunkt;}
                public function get_dato () {return $this->dato;}
                
                public function set_ovelse ($ovelse) {$this->ovelse=$ovelse;}
                public function set_tidspunkt ($tidspunkt) {$this->tidspunkt=$tidspunkt;}
<<<<<<< HEAD
                public function set_dato ($dato) {$this->dato=$dato;}         
}


=======
                public function set_dato ($dato) {$this->dato=$dato;}
                
                
}
>>>>>>> morten
