<?php

class Utover
{
                private $navn;
                private $utover_id;
                private $ovelse;
                
                public function get_navn () {return $this->navn;}
                public function get_utover_id () {return $this->utover_id;}
                public function get_ovelse () {return $this->ovelse;}
                
                public function set_navn ($navn) {$this->navn=$navn;}
                public function set_utover_id ($utover_id) {$this->utover_id=$utover_id;}
                public function set_ovelse ($ovelse) {$this->ovelse=$ovelse;}
                }
