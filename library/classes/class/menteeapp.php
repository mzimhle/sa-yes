<?php

class class_menteeapp extends Zend_Db_Table_Abstract {

   //declare table variables
    protected $_name		= 'menteeapp';
	protected $_primary	= 'menteeapp_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	public function insert(array $data) {
	 
        // add a timestamp
        $data['menteeapp_added']		= date('Y-m-d H:i:s');
        $data['menteeapp_code']		= $this->createReference();

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
        $data['menteeapp_updated']	= date('Y-m-d H:i:s');

        return parent::update($data, $where);
    }
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('menteeapp' => 'menteeapp'), array('menteeapp_code', 'menteeapp_name'))
					    ->where('menteeapp_active = 1 and menteeapp_deleted = 0')
					    ->order('menteeapp_name ASC');

		$result = $this->_db->fetchPairs($select);
		return ($result == false) ? false : $result = $result;
	}
	
	
	public function getAll($where = 'menteeapp_deleted = 0', $order = 'menteeapp_added desc') {
	
		$select = $this->_db->select()
						->from(array('menteeapp' => 'menteeapp'))
						->joinLeft('user', 'user.user_code = menteeapp.user_code')
						->joinLeft('partner', 'partner.partner_code = menteeapp.partner_code and partner_deleted = 0')
						->joinLeft('mentorship', 'mentorship.mentorship_code = menteeapp.mentorship_code and mentorship_deleted = 0')
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = menteeapp.applicationstatus_code and applicationstatus_deleted = 0')
						->joinLeft('area', 'area.area_code = menteeapp.area_code')
						->where('menteeapp_deleted = 0')
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
	public function getByCode( $code , $mentorship = null) {
	
		$select = $this->_db->select()
						->from(array('menteeapp' => 'menteeapp'))
						->joinLeft('user', 'user.user_code = menteeapp.user_code')
						->joinLeft('partner', 'partner.partner_code = menteeapp.partner_code and partner_deleted = 0')
						->joinLeft('mentorship', 'mentorship.mentorship_code = menteeapp.mentorship_code and mentorship_deleted = 0')
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = menteeapp.applicationstatus_code and applicationstatus_deleted = 0')
						->joinLeft('area', 'area.area_code = menteeapp.area_code')
					    ->where('menteeapp_code = ? ', $code)
						->where('menteeapp_deleted = 0')
					    ->limit(1);
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}

	public function getToMatch($code, $mentorship) {
		$select = $this->_db->select()
						->from(array('menteeapp' => 'menteeapp'))
						->joinLeft('user', 'user.user_code = menteeapp.user_code')
						->joinLeft('mentorship', 'mentorship.mentorship_code = menteeapp.mentorship_code and mentorship_deleted = 0')
						->joinLeft('match', 'match.mentorship_code = menteeapp.mentorship_code and match_deleted = 0 and match.mentee_code = menteeapp.user_code')
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = menteeapp.applicationstatus_code and applicationstatus_deleted = 0')
						->where('menteeapp.mentorship_code = ?', $mentorship)
						->where('match.mentee_code is null or match.mentee_code = null or match.mentee_code = \'\'')
						->where('applicationstatus_code = \'matched\'')
					    ->where('menteeapp_code = ? ', $code)
						->where('menteeapp_deleted = 0')
					    ->limit(1);

	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function checkApplication($usercode, $mentorship) {
		$select = $this->_db->select()
						->from(array('menteeapp' => 'menteeapp'))
						->joinLeft('user', 'user.user_code = menteeapp.user_code and user_deleted = 0')
						->joinLeft('partner', 'partner.partner_code = menteeapp.partner_code and partner_deleted = 0')
						->joinLeft('mentorship', 'mentorship.mentorship_code = menteeapp.mentorship_code and mentorship_deleted = 0')
						->joinLeft('area', 'area.area_code = menteeapp.area_code')
						->joinLeft('applicationstatus', 'applicationstatus.applicationstatus_code = menteeapp.applicationstatus_code and applicationstatus_deleted = 0')
					    ->where('menteeapp.user_code = ? ', $usercode)
						->where('menteeapp.mentorship_code = ? ', $mentorship)
						->where('menteeapp_deleted = 0')
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
							->from(array('menteeapp' => 'menteeapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('menteeapp_number = ? ', $number)
							->where('menteeapp_deleted = 0')
							->limit(1);
							
		} else {
			$select = $this->_db->select()
							->from(array('menteeapp' => 'menteeapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('menteeapp_number = ? ', $number)
							->where('menteeapp_code != ? ', $code)
							->where('menteeapp_deleted = 0')
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
							->from(array('menteeapp' => 'menteeapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('menteeapp_email = ? ', $email)
							->where('menteeapp_deleted = 0')
							->limit(1);
		} else {
			$select = $this->_db->select()
							->from(array('menteeapp' => 'menteeapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('menteeapp_email = ? ', $email)
							->where('menteeapp_code != ? ', $code)
							->where('menteeapp_deleted = 0')
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
							->from(array('menteeapp' => 'menteeapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('menteeapp_idnumber = ? ', $idnumber)
							->where('menteeapp_deleted = 0')
							->limit(1);
		} else {
			$select = $this->_db->select()
							->from(array('menteeapp' => 'menteeapp'))
							->where('mentorship_code = ?', $mentorship)
							->where('user_code != ?', $usercode)
							->where('menteeapp_idnumber = ? ', $idnumber)
							->where('menteeapp_code != ? ', $code)
							->where('menteeapp_deleted = 0')
							->limit(1);		
		}
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function getCode($code) {
		
		$select = $this->_db->select() 
					   ->from(array('menteeapp' => 'menteeapp'))
					   ->where('menteeapp.menteeapp_code = ?', $code)
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