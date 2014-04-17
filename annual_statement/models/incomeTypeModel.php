<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of incomeTypeModel
 *
 * @author alex
 */
class incomeTypeModel {

    private $idincome_type;
    private $name;

    /**
     * Constructor for the income_type obj
     * @param type $idincome_type
     * @param type $name
     */
    function __construct($idincome_type, $name) {
        $this->idincome_type = $idincome_type;
        $this->name = $name;
    }

    /* ---------------------------------------------------------------------------------------- */

    public function setIdincome_type($idincome_type) {
        if (isset($idincome_type) && is_numeric($idincome_type) && $idincome_type > 0) {
            $this->idincome_type = $idincome_type;
        } else {
            return false;
        }
    }

    public function setName($name) {
        if (preg_match('/^[ÆØÅæøåa-zA-Z]{2,80}$/', $name)) {
            $this->name = $name;
            return true;
        } else {
            return false;
        }
    }

    /* ---------------------------------------------------------------------------------------- */

    public function getIdincome_type() {
        return $this->idincome_type;
    }

    public function getName() {
        return $this->name;
    }

}
