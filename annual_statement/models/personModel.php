<?php

class personModel {

    private $cpr;
    private $first_name;
    private $last_name;
    private $address;
    private $email;
    private $phone;
    private $partner_cpr;

    /* -------------------------------------------------------------------------------------------------------------- */

    public function __construct($cpr, $first_name, $last_name, $address, $email, $phone, $partner_cpr) {

        $this->cpr = $cpr;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
        $this->partner_cpr;
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

    public function setPartner_cpr($partner_cpr) {
        if (isset($partner_cpr) && is_numeric($partner_cpr) && $partner_cpr > 0) {
            $this->partner_cpr = $partner_cpr;
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

    public function getName() {
        return $this->name;
    }
    public function getPartner_cpr() {
        return $this->partner_cpr;
    }


}

?>