<?php

class incomeModel {

    private $idincome;
    private $name;
    private $idincome_type;
    private $idtax;

    /* -------------------------------------------------------------------------------------------------------------- */

    function __construct($idincome, $name, $idincome_type, $idtax) {
        $this->idincome = $idincome;
        $this->name = $name;
        $this->idincome_type = $idincome_type;
        $this->idtax = $idtax;
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    public function setIdincome($idincome) {
        if (isset($idincome) && is_numeric($idincome) && $idincome > 0) {
            $this->idincome = $idincome;
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

    public function setIdincome_type($idincome_type) {
        if (isset($idincome_type) && is_numeric($idincome_type) && $idincome_type > 0) {
            $this->idincome_type = $idincome_type;
        } else {
            return false;
        }
    }

    public function setIdtax($idtax) {
        if (isset($idtax) && is_numeric($idtax) && $idtax > 0) {
            $this->idtax = $idtax;
        } else {
            return false;
        }
    }

    /* -------------------------------------------------------------------------------------------------------------- */
    public function getIdincome() {
        return $this->idincome;
    }

    public function getName() {
        return $this->name;
    }

    public function getIdincome_type() {
        return $this->idincome_type;
    }

    public function getIdtax() {
        return $this->idtax;
    }



}

?>