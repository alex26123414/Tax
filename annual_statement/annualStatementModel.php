<?php

	class annualStatementModel {
		
		private $cpr;
		private $first_name;
		private $last_name;
		private $address;
		private $email;
		private $phone;
		private $name;
		private $value;
		private $income_type;
		
	

/* -------------------------------------------------------------------------------------------------------------- */

		public function __construct($cpr, $first_name, $last_name, $address, $email, $phone, $name, $value, $income_type) {
			
			$this->cpr = $cpr;
			$this->first_name = $first_name;
			$this->last_name = $last_name;
			$this->address = $address;
			$this->email = $email;
			$this->phone = $phone;
			$this->name = $name;
			$this->value = $value;
			$this->income_type = $income_type;
			
		}
		
/* -------------------------------------------------------------------------------------------------------------- */		
		
		public function setCpr($cpr) {
			
			if(isset($cpr) && is_numeric($cpr) && $cpr > 0) {
				$this->id = $cpr;
			} else {
				return false;	
			}
		}
		
		public function setFist_name($first_name) {
			
			if (preg_match('/^[A-Za-z]{1}[A-Za-z0-9]{3,40}$/', $username)) {
				$this->username = $username;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setPassword($password) {
			
			if (!empty($password)) {
				$this->password = $password;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setSalt($salt) {
			
			if (!empty($salt)) {
				$this->salt = $salt;
				return true;
			} else {
				return false;	
			}
		}

		public function setFirstName($firstName) {
			
			if (preg_match('/^[ÆØÅæøåa-zA-Z]{2,80}$/', $firstName)) {
				$this->firstName = $firstName;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setLastName($lastName) {
			
			if (preg_match('/^[ÆØÅæøåa-zA-Z ]{2,80}$/', $lastName)) {
				$this->last_name = $lastName;
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
		
		public function setToken($token) {
			
			if (!empty($token)) {
				$this->token = $token;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setTokenDate($tokenDate) {
			
			if (!empty($tokenDate)) {
				$this->tokenDate = $tokenDate;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setTokenIp($tokenIp) {
			
			if (!empty($tokenIp)) {
				$this->tokenIp = $tokenIp;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setTokenAgent($tokenAgent) {
			
			if (!empty($tokenAgent)) {
				$this->tokenAgent = $tokenAgent;
				return true;
			} else {
				return false;	
			}
		}
		
		public function setRoles($roles) {
			
			$this->roles = $roles;
			return true;
		}
		
/* -------------------------------------------------------------------------------------------------------------- */		
		
		public function getId() {
			return $this->id;
		}
		
		public function getUsername() {
			return $this->username;
		}
		
		public function getPassword() {
			return $this->password;
		}
		
		public function getSalt() {
			return $this->salt;
		}
		
		public function getFirstName() {
			return $this->firstName;
		}
		
		public function getLastName() {
			return $this->lastName;
		}
		
		public function getFullName() {
			return $this->getFirstName() . ' ' . $this->getLastName();
		}
		
		public function getEmail() {
			return $this->email;
		}
		
		public function getToken() {
			return $this->token;
		}
		
		public function getTokenDate() {
			return $this->tokenDate;
		}
		
		public function getTokenIp() {
			return $this->tokenIp;
		}
		
		public function getTokenAgent() {
			return $this->tokenAgent;
		}
		
		public function getRoles() {
			return $this->roles;
		}

	}

?>