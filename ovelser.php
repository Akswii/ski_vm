<?php

class Ovelser {
                private $ovelse;
                private $tidspunkt;
                private $dato;
                
                public function get_ovelse () {return $this->ovelse;}
                public function get_tidspunkt () {return $this->tidspunkt;}
                public function get_dato () {return $this->dato;}
                
                public function set_ovelse ($ovelse) {$this->ovelse=$ovelse;}
                public function set_tidspunkt ($tidspunkt) {$this->tidspunkt=$tidspunkt;}
                public function set_dato ($dato) {$this->dato=$dato;}
                
                
}