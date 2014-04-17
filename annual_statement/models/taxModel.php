<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of taxModel
 *
 * @author alex
 */
class taxModel {

    private $idtax;
    private $value;
    private $includes_AM;

    function __construct($idtax, $value, $includes_AM) {
        $this->idtax = $idtax;
        $this->value = $value;
        $this->includes_AM = $includes_AM;
    }

        /* ---------------------------------------------------------------------------------------- */
    public function setIdtax($idtax) {
         if (isset($idtax) && is_numeric($idtax) && $idtax > 0) {
            $this->idtax = $idtax;
        } else {
            return false;
        }
    }
    public function setValue($value) {
        $this->value = $value;
    }
    
    public function setIncludes_AM($includes_AM) {
        $this->includes_AM = $includes_AM;
    }

    
    /* ---------------------------------------------------------------------------------------- */
    public function getIdtax() {
        return $this->idtax;
    }

    public function getValue() {
        return $this->value;
    }
    
    public function getIncludes_AM() {
        return $this->includes_AM;
    }

}
