<?php

//custom account item class as account table abstraction
class class_usermentorship extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'usermentorship';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        if (empty($data['usermentorship_added'])) {
            $data['usermentorship_added'] = date('Y-m-d H:i:s');
        }
		
        $data['usermentorship_code'] = $this->createReference();
        		
		return parent::insert($data);
    }
	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where)
    {
        // add a timestamp
        if (empty($data['usermentorship_updated'])) {
            $data['usermentorship_updated'] = date('Y-m-d H:i:s');
        }

        return parent::update($data, $where);
    }
	
	/**
	 * get job by job usermentorship Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('usermentorship' => 'usermentorship'))		
					->joinLeft(array('user' => 'user'), 'user.user_code = usermentorship.user_code')
					->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_active = 1 and mentorship_deleted = 0 and mentorship.mentorship_code = YEAR(CURDATE())')
					->where('usermentorship.usermentorship_code = ?', $code)
					->where('usermentorship.usermentorship_deleted = 0')
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}
	
	/**
	 * get job by job usermentorship Id
 	 * @param string job id
     * @return object
	 */
	public function getUserMentorship($usercode, $mentorshipcode, $active = 1) {
			
		if($active != null) {

			$select = $this->_db->select()	
						->from(array('usermentorship' => 'usermentorship'))
						->where('usermentorship.user_code = ?', $usercode)
						->where('usermentorship.mentorship_code = ?', $mentorshipcode)
						->where('usermentorship.usermentorship_deleted = 0 and usermentorship.usermentorship_active = ?', $active)
						->order('mentorship_code desc')
						->limit(1);

       } else {
	   
			$select = $this->_db->select()	
						->from(array('usermentorship' => 'usermentorship'))
						->where('usermentorship.user_code = ?', $usercode)
						->where('usermentorship.mentorship_code = ?', $mentorshipcode)
						->where('usermentorship.usermentorship_deleted = 0')
						->order('mentorship_code desc')
						->limit(1);		
	   }
	   
		$result = $this->_db->fetchRow($select);
		return ($result == false) ? false : $result = $result;

	}
	
	public function getAll($where = 'usermentorship.usermentorship_deleted = 0', $order = 'usermentorship_added desc') {
		
		$select = $this->_db->select()	
					->from(array('usermentorship' => 'usermentorship'))		
					->joinLeft(array('user' => 'user'), 'user.user_code = usermentorship.user_code')
					->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_active = 1 and mentorship_deleted = 0 and mentorship.mentorship_code = YEAR(CURDATE())')
						->where('usermentorship.usermentorship_deleted = 0')
						->where($where)
						->order($order);

	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;		
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('usermentorship' => 'usermentorship'))
					   ->where('usermentorship.usermentorship_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	function createReference() {
	
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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