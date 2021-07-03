<?php

class class_mentorapp extends Zend_Db_Table_Abstract {

   //declare table variables
    protected $_name		= 'mentorapp';
	protected $_primary	= 'mentorapp_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
	 
        // add a timestamp
        $data['mentorapp_added']		= date('Y-m-d H:i:s');
        $data['mentorapp_code']		= $this->createReference();

		return parent::insert($data);
		
    }

	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where) {
        // add a timestamp
        $data['mentorapp_updated']	= date('Y-m-d H:i:s');

        return parent::update($data, $where);
    }
	
	public function getAll($where = 'mentorapp_deleted = 0', $order = 'mentorapp_added desc') {
	
		$select = $this->_db->select()
						->from(array('mentorapp' => 'mentorapp'))
						->joinLeft('user', 'user.user_code = mentorapp.user_code')						
						->joinLeft('mentorship', 'mentorship.mentorship_code = mentorapp.mentorship_code and mentorship_deleted = 0', array('mentorship_code', 'mentorship_name'))
						->joinLeft('match', 'match.mentor_code = mentorapp.user_code and match.mentorship_code = mentorapp.mentorship_code and match_deleted = 0', array(''))	 
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = mentorapp.applicationstatus_code and applicationstatus_deleted = 0')
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = match.mentee_code and usermentee.user_deleted = 0', array('concat(usermentee.user_name, \' \', usermentee.user_surname) as menteename'))	
						->where('mentorapp_deleted = 0')
						->where($where)						
						->order($order);

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByCode( $code ) {
	
		$select = $this->_db->select()
						->from(array('mentorapp' => 'mentorapp'))
						->joinLeft('user', 'user.user_code = mentorapp.user_code')
						->joinLeft('mentorship', 'mentorship.mentorship_code = mentorapp.mentorship_code and mentorship_deleted = 0')
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = mentorapp.applicationstatus_code and applicationstatus_deleted = 0')
						->joinLeft('area', 'area.area_code = mentorapp.area_code')
					    ->where('mentorapp_code = ? ', $code)
						->where('mentorapp_deleted = 0')
					    ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function checkApplication($usercode, $mentorship) {
		$select = $this->_db->select()
						->from(array('mentorapp' => 'mentorapp'))
						->joinLeft('user', 'user.user_code = mentorapp.user_code and user_deleted = 0')
						->joinLeft('mentorship', 'mentorship.mentorship_code = mentorapp.mentorship_code and mentorship_deleted = 0')
						->joinLeft('area', 'area.area_code = mentorapp.area_code')
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = mentorapp.applicationstatus_code and applicationstatus_deleted = 0')
					    ->where('mentorapp.user_code = ? ', $usercode)
						->where('mentorapp.mentorship_code = ? ', $mentorship)
						->where('mentorapp_deleted = 0')
					    ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;	
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByNumber($number, $mentorship = NULL, $usercode = '', $code = false) {
		
		$mentorship = $mentorship == null ? date('Y') : $mentorship;
		
		if($code == false) {
		
			$select = $this->_db->select()
							->from(array('mentorapp' => 'mentorapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('mentorapp_cell = ? ', $number)
							->where('mentorapp_deleted = 0')
							->limit(1);
							
		} else {
			$select = $this->_db->select()
							->from(array('mentorapp' => 'mentorapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('mentorapp_cell = ? ', $number)
							->where('mentorapp_code != ? ', $code)
							->where('mentorapp_deleted = 0')
							->limit(1);		
		}
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByEmail( $email, $mentorship = NULL, $usercode = '', $code = false ) {
		
		$mentorship = $mentorship == null ? date('Y') : $mentorship;
		
		if($code == false) {
		
			$select = $this->_db->select()
							->from(array('mentorapp' => 'mentorapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('mentorapp_email = ? ', $email)
							->where('mentorapp_deleted = 0')
							->limit(1);
		} else {
			$select = $this->_db->select()
							->from(array('mentorapp' => 'mentorapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('mentorapp_email = ? ', $email)
							->where('mentorapp_code != ? ', $code)
							->where('mentorapp_deleted = 0')
							->limit(1);		
		}
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByID( $idnumber, $mentorship = NULL, $usercode = '', $code = false ) {
		
		$mentorship = $mentorship == null ? date('Y') : $mentorship;
		
		if($code == false) {
		
			$select = $this->_db->select()
							->from(array('mentorapp' => 'mentorapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('mentorapp_idnumber = ? ', $idnumber)
							->where('mentorapp_deleted = 0')
							->limit(1);
		} else {
			$select = $this->_db->select()
							->from(array('mentorapp' => 'mentorapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('mentorapp_idnumber = ? ', $idnumber)
							->where('mentorapp_code != ? ', $code)
							->where('mentorapp_deleted = 0')
							->limit(1);		
		}
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function getCode($code) {
		
		$select = $this->_db->select() 
					   ->from(array('mentorapp' => 'mentorapp'))
					   ->where('mentorapp.mentorapp_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		//$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 10; $i++) {
			$reference .= $codeAlphabet[rand(1,$count)];
		}
		
		/* First check if it exists or not. */
		$itemCheck = $this->getCode($reference);
		
		if($itemCheck) {
			/* It exists. check again. */
			$this->createReference();
		} else {
			return $reference;
		}
	}	
}

?>