<?php

class annualStatementModel {

    private $cpr;
    private $first_name;
    private $last_name;
    private $address;
    private $email;
    private $phone;
    private $date;
    private $income_name;
    private $income_value;
    private $income_type_name;
    private $income_type;
    private $tax_value;

    /* -------------------------------------------------------------------------------------------------------------- */

    public function __construct($cpr, $first_name, $last_name, $address, $email, $phone) {

        $this->cpr = $cpr;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
//        $this->date = $date;
//        $this->income_name = $income_name;
//        $this->income_value = $income_value;
//        $this->income_type_name = $income_type_name;
//        $this->income_type = $income_type;
//        $this->tax_value = $tax_value;
    }
    

    /* -------------------------------------------------------------------------------------------------------------- */

    public function setCpr($cpr) {

        if (isset($cpr) && is_numeric($cpr) && $cpr > 0) {
            $this->id = $cpr;
        } else {
            return false;
        }
    }

    public function setFirst_name($first_name) {

        if (preg_match('/^[ÆØÅæøåa-zA-Z]{2,80}$/', $first_name)) {
            $this->first_name = $first_name;
            return true;
        } else {
            return false;
        }
    }

    public function setLast_name($last_name) {

        if (preg_match('/^[ÆØÅæøåa-zA-Z ]{2,80}$/', $last_name)) {
            $this->last_name = $last_name;
            return true;
        } else {
            return false;
        }
    }

    public function setAdress($address) {

        if (!empty($address)) {
            $this->address = $address;
            return true;
        } else {
            return false;
        }
    }

    public function setEmail($email) {

        if (isset($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            return true;
        } else {
            return false;
        }
    }

    public function setPhone($phone) {

        if (!empty($phone)) {
            $this->phone = $phone;
            return true;
        } else {
            return false;
        }
    }
    
    public function setDate($date) {

        if (!empty($date)) {
            $this->date = $date;
            return true;
        } else {
            return false;
        }
    }

    public function setIncome_name($income_name) {

        if (!empty($income_name)) {
            $this->income_name = $income_name;
            return true;
        } else {
            return false;
        }
    }

    public function setIncome_value($income_value) {

        if (!empty($income_value)) {
            $this->income_value = $income_value;
            return true;
        } else {
            return false;
        }
    }

    public function setIncome_type($income_type) {

        if (!empty($income_type)) {
            $this->income_type = $income_type;
            return true;
        } else {
            return false;
        }
    }
    
    public function setIncome_type_name($income_type_name) {

        if (!empty($income_type_name)) {
            $this->income_type_name = $income_type_name;
            return true;
        } else {
            return false;
        }
    }

    public function setTax_value($tax_value) {

        if (!empty($tax_value)) {
            $this->tax_value = $tax_value;
            return true;
        } else {
            return false;
        }
    }
    /* -------------------------------------------------------------------------------------------------------------- */

    public function getCpr() {
        return $this->cpr;
    }

    public function getFirst_name() {
        return $this->first_name;
    }

    public function getLast_name() {
        return $this->last_name;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getDhone() {
        return $this->date;
    }
    
    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getIncome_type() {
        return $this->income_type;
    }

    public function getIncome_type_name() {
        return $this->income_type_name;
    }
    
    public function getTax_value() {
        return $this->tax_value;
    }
}

?>