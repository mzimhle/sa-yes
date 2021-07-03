<?php
class User {
	
	private $id;
	private $firstName;
	private $lastName;
	private $email;
	private $password;
	private $phone;
	private $cell;
	private $notes;
	
	function __construct($userRow = NULL) {
		if ($userRow != null) {
			$this->setId($userRow['id']);
			$this->setFirstName($userRow['first_name']);
			$this->setLastName($userRow['last_name']);
			//$this->setPassword($userRow['password']);
			$this->setEmail($userRow['email']);
			$this->setPhone($userRow['phone']);
			$this->setCell($userRow['cphone']);
			$this->setNotes($userRow['notes']);
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function getFirstName() {
		return $this->firstName;
	}
	
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getPhone() {
		return $this->phone;
	}
	
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	
	public function getCell() {
		return $this->cell;
	}
	
	public function setCell($cell) {
		$this->cell = $cell;
	}
	
	public function getNotes() {
		return $this->notes;
	}
	
	public function setNotes($notes) {
		$this->notes = $notes;
	}
}
?>