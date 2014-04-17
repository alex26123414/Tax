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

    /**
     * Constructor for the tax obj.
     * @param type $idtax
     * @param type $value
     */
    function __construct($idtax, $value) {
        $this->idtax = $idtax;
        $this->value = $value;
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

    /* ---------------------------------------------------------------------------------------- */
    public function getIdtax() {
        return $this->idtax;
    }

    public function getValue() {
        return $this->value;
    }
}
