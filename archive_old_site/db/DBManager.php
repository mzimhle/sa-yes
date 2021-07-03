<?php
include ('debug.php');
require_once ('MDB2.php');


class DBManager {

	private static $instance;
	//private $dsn = 'mysql://root@localhost/sayes_meetings';
	private $dsn = 'mysql://sayesmeetings:xLwUaweJy6wj4J@sayesmeetings.db.5503218.hostedresource.com/sayesmeetings';
	private $mdb2;

	// limit things to only after this date
	private $date_limit = '2012-12-01';

	function __construct() {
		$this -> mdb2 = &MDB2::factory($this -> dsn);

		if (PEAR::isError($this -> mdb2)) {
			die($this -> mdb2 -> getMessage());
		}
	}

	/**
	 * Returns a singleton instance of the DBManager
	 */
	public static function getInstance() {

		if (!self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Authenticate the given user credentials
	 *
	 * @param email email address of the user
	 * @param password password of the user
	 * @return the user object if authenticated, or null
	 */
	public function doLogin($email, $password) {

		// build and execute query
		$types = array('text', 'text');
		$sth = $this -> mdb2 -> prepare("SELECT id FROM users WHERE users.email = :email AND users.password = PASSWORD(:password) AND users.active = TRUE", $types);
		$params = array('email' => $email, 'password' => $password);		
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		$userId = $row['id'];

		return $userId;
	}

	/**
	 * Return the id of the last inserted user row
	 *
	 * @return id of the last inserted row
	 */
	public function getLastUserId() {
		$sth = $this -> mdb2 -> prepare("SELECT users.id FROM users WHERE users.id = LAST_INSERT_ID()");
		$result = $sth -> execute();
		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		return $row['id'];
	}

	/**
	 * Return the id of the last inserted match row
	 *
	 * @return id of the last inserted row
	 */
	public function getLastMatchId() {
		$sth = $this -> mdb2 -> prepare("SELECT matches.id FROM matches WHERE matches.id = LAST_INSERT_ID()");
		$result = $sth -> execute();
		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		return $row['id'];
	}

	/**
	 * Return the id of the last inserted meeting row
	 *
	 * @return id of the last inserted row
	 */
	public function getLastMeetingId() {
		$sth = $this -> mdb2 -> prepare("SELECT meetings.id FROM meetings WHERE meetings.id = LAST_INSERT_ID()");
		$result = $sth -> execute();
		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		return $row['id'];
	}
	
	/**
	 * Returns the id of the owner of the meeting with the given id.
	 * 
	 * @param id id of the meeting
	 */
	public function getMeetingOwner($id) {
		$types = array('integer');
		$sth = $this -> mdb2 -> prepare("SELECT meetings.mentor FROM meetings WHERE meetings.id = :id", $types);
		$params = array('id' => $id);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$mentorId = $row['mentor'];
		$result -> free();
		
		return $mentorId;
	}

	/**
	 * Returns a User object for the user with the given id
	 *
	 * @param $id id of the user
	 * @return a populated User object
	 */
	public function getUser($id) {

		$types = array('integer');
		$sth = $this -> mdb2 -> prepare("SELECT * FROM users WHERE users.id = :id", $types);
		$params = array('id' => $id);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		// check user type
		$groupId = $row['user_group'];
		$group = $this -> getGroupAlias($groupId);

		// create user object
		switch($group) {
			case "Administrator" :
				$user = new Administrator($row);
				break;
			case 'Mentor' :
				$user = new Mentor($row);
				break;
			case 'Mentee' :
				$user = new Mentee($row);
				break;
			default :
				$user = new User($row);
		}

		return $user;
	}

	/**
	 * Returns a User object for the user with the given email
	 *
	 * @param $email email of the user
	 * @return a populated User object
	 */
	public function getUserByEmail($email) {

		$types = array('text');
		$sth = $this -> mdb2 -> prepare("SELECT * FROM users WHERE users.email = :email", $types);
		$params = array('email' => $email);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		// check user type
		$groupId = $row['user_group'];
		$group = $this -> getGroupAlias($groupId);

		// create user object
		switch($group) {
			case "Administrator" :
				$user = new Administrator($row);
				break;
			case 'Mentor' :
				$user = new Mentor($row);
				break;
			case 'Mentee' :
				$user = new Mentee($row);
				break;
			default :
				$user = new User($row);
		}

		return $user;
	}

	/**
	 * Inserts a new mentor/mentee match into the database
	 *
	 * @param String $mentorId id of the mentor
	 * @param String $menteeId id of the mentee
	 * @param String $matchDate date of the match
	 */
	public function newMatch($mentorId, $menteeId, $matchDate, $notes) {

		$types = array('integer', 'integer', 'text', 'text');
		$sth = $this -> mdb2 -> prepare("INSERT INTO matches (mentor,mentee,match_date,notes) VALUES (:mentor, :mentee,:matchDate,:notes)", $types);
		$params = array('mentor' => $mentorId, 'mentee' => $menteeId, 'matchDate' => $matchDate, 'notes' => $notes);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $row;
	}

	/**
	 * Inserts a new meeting into the database
	 *
	 * @param String $values
	 * @param String $types
	 * @param String $owner
	 * @return number of affected rows or error
	 */
	public function newMeeting($params, $types, $owner) {

		// get mentor's current mentee (meetings can only be added for active matches)
		$mentee = $this->getCurrentMentee($owner);
		$params['mentee'] = $mentee;
		array_push($types,'integer');

		// add meeting owner
		$params['mentor'] = $owner;
		array_push($types,'text');
		
		// set deleted to false
		$params['deleted'] = false;
		array_push($types,'boolean');
		
		$names = '';
		$values = '';
		foreach ($params as $key=>$val) {
			if ($names != '') {
				$names .= ','.$key;
				$values .= ',:'.$key;
			} else {
				$names .= $key;
				$values .= ':'.$key;
			}
		}

		$query = "INSERT INTO meetings ($names) VALUES ($values)";
		
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $row;
	}
	
	/**
	 * Returns the id of the current mentee for the given mentor
	 * 
	 * @param mentorId id of the mentor whose mentee is returned
	 * @return id of the mentee
	 */
	public function getCurrentMentee($mentorId) {
		$query = "SELECT matches.mentee FROM matches WHERE matches.mentor=? ORDER BY match_date DESC";
		$types = array('integer');
		$params = array($mentorId);
		
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $row['mentee'];
	}

	/**
	 * Deletes a user from the database
	 *
	 * @param String $userId id of the user to delete
	 */
	public function deleteUser($userId) {

		$query = "UPDATE users SET users.deleted = true WHERE users.id = :id";
		$query = "DELETE FROM users WHERE users.id = :id";
		$types = array('integer');
		$params = array('id' => $userId);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$result -> free();

		// TODO delete matches and meetings

		return $result;
	}

	/**
	 * Deletes a meeting from the database
	 *
	 * @param String $meetingId id of the meeting to delete
	 */
	public function deleteMeeting($meetingId) {

		$query = "UPDATE meetings SET meetings.deleted = ? WHERE meetings.id = ?";
		$types = array('integer','integer');
		$params = array(1,$meetingId);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$result -> free();

		return $result;
	}

	/**
	 * Deletes a mentor/mentee match from the database
	 *
	 * @param String $matchId id of the match to delete
	 */
	public function deleteMatch($matchId) {

		$query = "UPDATE matches SET matches.deleted = true WHERE matches.id = :id";
		$types = array('integer');
		$params = array('id' => $matchId);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$result -> free();

		return $result;
	}
	
	/**
	 * Returns the date of the match between the mentor and mentee
	 *
	 * @param $mentorId id of the mentor
	 * @param $menteeId id of the mentee
	 * @return date of the match
	 */
	public function getMatchDate($mentorId,$menteeId) {

		$query = "SELECT matches.match_date FROM matches WHERE mentor = ? AND mentee = ?";
		$types = array('integer','integer');
		$params = array($mentorId,$menteeId);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);

		$result -> free();

		return $row['match_date'];
	}

	/**
	 * Inserts the given user into the database
	 *
	 * @param user user to save
	 * @return number of rows affected, or error
	 */
	public function newUser($user) {
		
		// email is required for mentor and admins, but not mentees
		
		//$email = $user -> getEmail();
		//if (isset($user) && isset($email)) {
		if (isset($user)) {

			// email is required
			//$attrs = 'email';
			//$values = "'$email'";
			
			// first name is required
			$firstName = $user -> getFirstName();
			$attrs = 'first_name';
			$values = "'$firstName'";

			// if (isset($firstName)) {
				// $attrs .= ',first_name';
				// $values .= ",'$firstName'";
			// }

			$lastName = $user -> getLastName();
			if (isset($lastName)) {
				$attrs .= ',last_name';
				$values .= ",'$lastName'";
			}
			
			$email = $user -> getEmail();
			if (isset($email)) {
				$attrs .= ',email';
				$values .= ",'$email'";
			}
			
			$password = $user -> getPassword();
			if (isset($password)) {
				$attrs .= ',password';
				$values .= ",PASSWORD('$password')";
			}

			$phone = $user -> getPhone();
			if (isset($phone)) {
				$attrs .= ',phone';
				$values .= ",'$phone'";
			}

			$cell = $user -> getCell();
			if (isset($cell)) {
				$attrs .= ',cphone';
				$values .= ",'$cell'";
			}

			$notes = $user -> getNotes();
			if (isset($notes)) {
				$attrs .= ',notes';
				$values .= ",'$notes'";
			}

			$dbm = DBManager::getInstance();

			$groupId = "";
			if ($user instanceof Administrator) {
				$groupId = $this -> getGroupId("Administrator");
			} else if ($user instanceof Mentor) {
				$groupId = $this -> getGroupId("Mentor");

				$menteeId = $user -> getMenteeId();
				if (isset($menteeId)) {
					$attrs .= ',mentee';
					$values .= ",'$menteeId'";
				}
				
				$joinDate = $user -> getJoinDate();
				if (isset($joinDate)) {
					$attrs .= ',join_date';
					$values .= ",'$joinDate'";
				}
			} else if ($user instanceof Mentee) {
				$groupId = $this -> getGroupId("Mentee");

				$home = $user -> getHome();
				if (isset($home)) {
					$attrs .= ',home';
					$values .= ",'$home'";
				}
				
				$homeDetails = $user -> getHomeDetails();
				if (isset($homeDetails)) {
					$attrs .= ',home_details';
					$values .= ",'$homeDetails'";
				}
				
				$joinDate = $user -> getJoinDate();
				if (isset($joinDate)) {
					$attrs .= ',join_date';
					$values .= ",'$joinDate'";
				}
			}
			$attrs .= ',user_group';
			$values .= ",'$groupId'";

			$query = "INSERT INTO users ($attrs) VALUES ($values)";
			$affected = $this -> doSingleSelect($query);

			return $affected;
		}
	}

	/**
	 * Activates or deactivates the user with the given id based on the given active state
	 *
	 * @param userId id of the user to activate/deactive
	 * @param active whether the user should be set to active or deactive
	 * @return number of affected rows, or error
	 */
	public function activateUser($userId, $active) {

		// ensure 'active' is a boolean
		if ($active === 'false')
			$active = false;
		else {
			$active = true;
		}

		$query = "UPDATE users SET users.active = :active WHERE users.id = :userId";
		$types = array('boolean', 'integer');
		$params = array('active' => $active, 'userId' => $userId);

		$sth = $this -> mdb2 -> prepare($query, $types, MDB2_PREPARE_MANIP);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		return $result;
	}

	/**
	 * Returns all users of the selected type. If no type is specified, returns all users.
	 *
	 * @param type type of users to return
	 * @return all users of the specified type as rows
	 */
	public function getUsers($type = NULL) {

		if (isset($type)) {
			$groupId = $this -> getGroupId($type);
			$query = "SELECT * FROM users WHERE user_group = :id AND users.deleted = false ORDER BY last_name";
			$types = array('integer');
			$params = array('id' => $groupId);
		} else {
			$query = "SELECT * FROM users ORDER BY last_name";
			$types = array();
			$params = array();
		}

		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$rows = $result -> fetchAll(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $rows;
	}

	/**
	 * Returns all mentor/mentee matches
	 *
	 * @return all matches as rows
	 */
	public function getMatches() {
		$query = "SELECT * FROM matches WHERE matches.deleted != true";
		$rows = $this -> doMultiSelect($query);
		return $rows;
	}

	/**
	 * Returns whether or not the given user has administrator privileges
	 *
	 * @param userId id of the user to check
	 * @return whether or not the user has administrator privileges
	 */
	function isAdmin($userId) {
		$adminGroupId = $this->getGroupId('Administrator');
		
		$query = "SELECT user_group FROM users where id = $userId";
		$row = $this -> doSingleSelect($query);

		if (PEAR::isError($row)) {
			return false;
		}

		if (isset($row)) {
			return $adminGroupId == $row['user_group'];
		}

		return false;
	}
	
	/**
	 * Returns whether or not the given user is a mentor
	 *
	 * @param userId id of the user to check
	 * @return whether or not the user is a mentor
	 */
	function isMentor($userId) {
		$mentorGroupId = $this->getGroupId('Mentor');
		
		$query = "SELECT user_group FROM users where id = $userId";
		$row = $this -> doSingleSelect($query);

		if (PEAR::isError($row)) {
			return false;
		}

		if (isset($row)) {
			return $mentorGroupId == $row['user_group'];
		}

		return false;
	}

	/**
	 * Returns the id of the group with the given name.
	 *
	 * @param groupAlias alias of the group
	 * @return the id of the group
	 */
	function getGroupId($groupAlias) {

		$query = "SELECT id FROM groups WHERE groups.alias = :alias";
		$types = array('text');
		$params = array('alias' => $groupAlias);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		if (isset($row)) {
			return $row['id'];
		}

		return null;
	}

	/**
	 * Returns the alias of the group with the given id.
	 *
	 * @param groupId id of the group
	 * @return the alias of the group
	 */
	function getGroupAlias($groupId) {

		$query = "SELECT alias FROM groups WHERE groups.id = :id";
		$types = array('integer');
		$params = array('id' => $groupId);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		if (isset($row)) {
			return $row['alias'];
		}

		return null;
	}
	
	/**
	 * Returns the type of the user (Mentor, Mentee, Admin) specified by the 
	 * given user id
	 * 
	 * @param userId id of the user 
	 * @return the user type
	 */
	function getUserType($userId) {
			
		$types = array('integer');
		$sth = $this -> mdb2 -> prepare("SELECT users.user_group FROM users WHERE users.id = :id", $types);
		$params = array('id' => $userId);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		// get user type
		$groupId = $row['user_group'];
		$group = $this -> getGroupAlias($groupId);
		
		return $group;
	}

	/**
	 * Returns a list of valid user types
	 *
	 * @return list of user types
	 */
	function getUserTypes() {

		$types = array();

		$query = "SELECT alias FROM groups";
		$rows = $this -> doMultiSelect($query);

		foreach ($rows as $key => $row) {
			$types[] = $row['alias'];
		}

		return $types;
	}

	/**
	 * Return all meetings owned by the given user, or all meetings if no user is specified.
	 *
	 * @param integer/string $userId id of the user whose meetings should be returned
	 */
	public function getMeetings($userId = NULL) {
		if (isset($userId)) {
			$query = "SELECT * FROM meetings WHERE meetings.mentor = :id AND meetings.deleted = false";
			$types = array('integer');
			$params = array('id' => $userId);
		} else {
			// query for retrieving active status of mentor user
			$query = "SELECT meetings.*, users.active FROM meetings LEFT JOIN users ON meetings.mentor = users.id WHERE meetings.deleted = false";
			$types = array();
			$params = array();
		}
		
		// limit to 2013 only
		$query .= " AND meetings.date > :date";
		array_push($types,'string');
		$params['date'] = $this->date_limit;

		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$rows = $result -> fetchAll(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $rows;
	}

	/**
	 * Updates a user's information. Given user object contains the user id and all values that should be set in the database.
	 *
	 * @param updatedUser user object containing updated information
	 */
	public function updateUser($updatedUser) {

		$fields = '';
		$types = array();
		$params = array();

		// first name
		$fname = $updatedUser -> getFirstName();
		if ($fname != null) {
			$fields .= "users.first_name=?,";
			array_push($types, 'text');
			array_push($params, $fname);
		}

		// last name
		$lname = $updatedUser -> getLastName();
		if ($fname != null) {
			$fields .= "users.last_name=?,";
			array_push($types, 'text');
			array_push($params, $lname);
		}

		// email
		$email = $updatedUser -> getEmail();
		if ($email != null) {
			$fields .= "users.email=?,";
			array_push($types, 'text');
			array_push($params, $email);
		}

		// cell phone
		$cell = $updatedUser -> getCell();
		$fields .= "users.cphone=?,";
		array_push($types, 'text');
		array_push($params, $cell);

		// phone
		$phone = $updatedUser -> getPhone();
		$fields .= "users.phone=?,";
		array_push($types, 'text');
		array_push($params, $phone);
		
		// notes
		$notes = $updatedUser -> getNotes();
		$fields .= "users.notes=?,";
		array_push($types, 'text');
		array_push($params, $notes);
		
		// race
		if ($updatedUser instanceof Mentee) {
			$race = $updatedUser -> getRace();
			$fields .= "users.race=?,";
			array_push($types, 'text');
			array_push($params, $race);
		}
		
		// home
		if ($updatedUser instanceof Mentee) {
			$home = $updatedUser -> getHome();
			$fields .= "users.home=?,";
			array_push($types, 'text');
			array_push($params, $home);
		}
		
		// home details
		if ($updatedUser instanceof Mentee) {
			$homeDetails = $updatedUser -> getHomeDetails();
			$fields .= "users.home_details=?,";
			array_push($types, 'text');
			array_push($params, $homeDetails);
		}
		
		// join date
		if ($updatedUser instanceof Mentee || $updatedUser instanceof Mentor) {
			$joinDate = $updatedUser -> getJoinDate();
			$fields .= "users.join_date=?,";
			array_push($types,'text');
			array_push($params, $joinDate);
		}
		
		// notes
		$notes = $updatedUser -> getNotes();
		$fields .= "users.notes=?,";
		array_push($types, 'text');
		array_push($params, $notes);
	

		// password
		$pw = $updatedUser -> getPassword();
		if ($pw != null && isset($pw)) {
			$fields .= "users.password=PASSWORD(?),";
			array_push($types, 'text');
			array_push($params, $pw);
		}

		// remove trailing comma
		$fields = substr($fields, 0, $fields . length - 1);

		// add id values to types and params
		array_push($types, 'integer');
		array_push($params, $updatedUser -> getId());

		// build and execute query
		$query = "UPDATE users SET " . $fields . " WHERE users.id=?";
		$s = $this -> mdb2 -> prepare($query, $types, MDB2_PREPARE_MANIP);
		$result = $s -> execute($params);

		return $result;
	}

	/**
	 * Updates a match's information
	 *
	 * @param matchId id of the match to update
	 * @param matchDate new match date
	 */
	public function updateMatch($matchId, $matchDate, $notes) {

		$types = array('text', 'text', 'integer');
		$params = array($matchDate, $notes, $matchId);

		// build and execute query
		$query = "UPDATE matches SET matches.match_date = ?, matches.notes = ? WHERE matches.id=?";
		$s = $this -> mdb2 -> prepare($query, $types, MDB2_PREPARE_MANIP);
		$result = $s -> execute($params);

		return $result;
	}

	/**
	 * Updates a meeting's information
	 *
	 * @param meetingId id of the meeting to update
	 * @param meetingDate new meeting date
	 * @param meetingStatus new meeting status
	 * @param meetingReason new meeting status reason
	 */
	public function updateMeeting($meetingId, $values, $types) {

		$params = array();

		// build the query string
		$query = '';
		foreach ($values as $key=>$val) {
			if ($query == '') {
				$query .= "meetings.$key=:$key";
			} else {
				$query .= ",meetings.$key=:$key";
			}
			
			$params[$key] = $val;			
		}
		
		// add meeting id
		$params['meetingId'] = $meetingId;
		array_push($types,'integer');

		// build and execute query
		$query = "UPDATE meetings SET $query WHERE meetings.id=:meetingId";
		$s = $this -> mdb2 -> prepare($query, $types, MDB2_PREPARE_MANIP);
		$result = $s -> execute($params);

		return $result;
	}

	/**
	 * Returns the display name for the user
	 *
	 * @param userId the id of the user whose name should be returned
	 * @return the display name of the user
	 */
	function getDisplayName($userId) {

		$query = "SELECT * FROM users WHERE users.id = :id";
		$types = array('integer');
		$params = array('id' => $userId);
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $row['first_name'] . ' ' . $row['last_name'];
	}

	/**
	 * Performs the given query and returns the first resulting row
	 *
	 * @param query query string
	 * @return the first result row
	 */
	private function doSingleSelect($query) {
		$result = $this -> mdb2 -> query($query);

		if (PEAR::isError($result)) {
			return $result;
		}

		$row = $result -> fetchRow(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $row;
	}

	/**
	 * Performs the given query and returns all resulting rows
	 *
	 * @param query query string
	 * @return all resulting rows
	 */
	private function doMultiSelect($query) {
		$result = $this -> mdb2 -> query($query);

		if (PEAR::isError($result)) {
			return $rows;
		}

		$rows = $result -> fetchAll(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $rows;
	}

	public function doMeetingReport($startDate,$endDate,$allDates,$status) {
		
		$query = "SELECT date,mentor,mentee,status,type,staff,start_time,length,reason,notes,notes_admin FROM meetings WHERE meetings.status = :status";
		$types = array('integer');
		$params = array('status' => $status);
		
		if (!isset($allDates)) {
			$query .= " AND meetings.date BETWEEN :start AND :end";
			array_push($types,'text');
			array_push($types,'text');
			$params['start'] = $startDate;
			$params['end'] = $endDate;
		}
		
		$sth = $this -> mdb2 -> prepare($query, $types);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$rows = $result -> fetchAll(MDB2_FETCHMODE_ASSOC);
		$result -> free();

		return $rows;
		
	}
	
	public function doMeetingStatusReport($startDate,$endDate) {

		// data to return
		$data = array();
		
		// get all users
		$query = "SELECT ID FROM users";
		$query .= " WHERE deleted = 0 AND active = 1";
		$query .= " AND user_group = 2";
		$sth = $this -> mdb2 -> prepare($query);
		$result = $sth -> execute($params);

		if (PEAR::isError($result)) {
			return $result;
		}

		$userIds = $result -> fetchCol(0);
		$result -> free();
		
		foreach ($userIds as $key=>$userId) {
			
			// get meetings in the date range for the user
			$query = "SELECT status FROM meetings";
			$query .= " WHERE date BETWEEN :start AND :end";
			$query .= " AND mentor = :userId";
			$types = array('text','text','int');
			$params = array('start' => $startDate, 'end' => $endDate, 'userId' => $userId);
			
			$sth = $this -> mdb2 -> prepare($query, $types);
			$result = $sth -> execute($params);
	
			if (PEAR::isError($result)) {
				return $result;
			}
	
			$meetings = $result -> fetchAll(MDB2_FETCHMODE_ASSOC);
			$result -> free();	
			
			// see if there was a meeting and save the status if there was
			$meetingStatus = null;
			if (count($meetings) > 0) {
				$meetingStatus = $meetings[0]['status'];
			}
			
			// add user/meeting to the result set
			array_push($data, array("id" => $userId, "status" => $meetingStatus));
		}

		return $data;
		
	}
	
}
?>