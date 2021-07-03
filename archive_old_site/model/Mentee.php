<?php
class Mentee extends User {

	private $race;
	private $home;
	private $homeDetails;
	private $joinDate;

	function __construct($userRow = NULL) {
		parent::__construct($userRow);
		
		if (isset($userRow)) {
			$this->setRace($userRow['race']);
			$this->setHome($userRow['home']);
			$this->setHomeDetails($userRow['home_details']);
			$this->setJoinDate($userRow['join_date']);
		}
	}

	public function getRace() {
		return $this -> race;
	}

	public function setRace($race) {
		$this -> race = $race;
	}

	public function getHome() {
		return $this -> home;
	}

	public function setHome($home) {
		$this -> home = $home;
	}

	public function getHomeDetails() {
		return $this -> homeDetails;
	}

	public function setHomeDetails($homeDetails) {
		$this -> homeDetails = $homeDetails;
	}
	
	public function getJoinDate() {
		return $this -> joinDate;
	}
	
	public function setJoinDate($joinDate) {
		$this -> joinDate = $joinDate;
	}
}
?>