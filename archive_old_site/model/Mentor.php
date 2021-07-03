<?php
class Mentor extends User {

	// used for lazy loading
	private $menteeId;
	private $mentee;
	private $joinDate;

	function __construct($userRow = NULL) {
		parent::__construct($userRow);

		if ($userRow != null) {
			if (isset($userRow['mentee'])) {
				$this->setMenteeId($userRow['mentee']);
				$this->setJoinDate($userRow['join_date']);
			}
		}
	}

	public function getMentee() {

		// lazy load Mentor object
		if (!isset($this->mentee)) {
			$this->setMentee(DBManager::getInstance()->getUser($menteeId));
		}
		return $this->mentee;
	}

	public function setMentee($mentee) {
		$this->mentee = $mentee;
	}

	public function getMenteeId() {
		return $this->menteeId;
	}

	public function setMenteeId($menteeId) {
		$this->menteeId = $menteeId;
	}
	
	public function getJoinDate() {
		return $this -> joinDate;
	}
	
	public function setJoinDate($joinDate) {
		$this -> joinDate = $joinDate;
	}
}
?>