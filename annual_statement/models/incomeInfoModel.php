<?php

class incomeInfoModel {

    private $idincome_info;
    private $cpr;
    private $idincome;
    private $value;
    private $date;

    /* -------------------------------------------------------------------------------------------------------------- */

    public function __construct($idincome_info, $cpr, $idincome, $value, $date) {

        $this->idincome_info = $idincome_info;
        $this->cpr = $cpr;
        $this->idincome = $idincome;
        $this->value = $value;
        $this->date = $date;
    }

    /* -------------------------------------------------------------------------------------------------------------- */

    public function getIdincome_info() {
        return $this->idincome_info;
    }

    public function getCpr() {
        return $this->cpr;
    }

    public function getIdincome() {
        return $this->idincome;
    }

    public function getValue() {
        return $this->value;
    }

    public function getDate() {
        return $this->date;
    }

    public function setIdincome_info($idincome_info) {
        $this->idincome_info = $idincome_info;
    }

    public function setCpr($cpr) {
        $this->cpr = $cpr;
    }

    public function setIdincome($idincome) {
        $this->idincome = $idincome;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function setDate($date) {
        $this->date = $date;
    }

}

?>