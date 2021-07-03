<?php

//custom account item class as account table abstraction
class class_match extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'match';
	protected $_primary = 'match_code';
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {

        $data['match_added'] = date('Y-m-d H:i:s');
        $data['match_code'] = $this->createReference();
        		
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
        if (empty($data['match_updated'])) {
            $data['match_updated'] = date('Y-m-d H:i:s');
        }

        return parent::update($data, $where);
    }
	
	/**
	 * get job by job match Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
						->from(array('match' => 'match'))		
						->joinLeft(array('usermentor' => 'user'), 'usermentor.user_code = match.mentor_code', array('concat(usermentor.user_name, \' \', usermentor.user_surname) as mentorname'))
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = match.mentee_code', array('concat(usermentee.user_name, \' \', usermentee.user_surname) as menteename'))	
						->joinLeft('mentorship', 'mentorship.mentorship_code = match.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
						->joinLeft('partner', 'partner.partner_code = usermentee.partner_code and partner_deleted = 0 and partner_active = 1')
						->where('match_active = 1 and match_deleted = 0')
						->where('match.match_code = ?', $code)
						->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}
	
	/**
	 * get job by job match Id
 	 * @param string job id
     * @return object
	 */
	public function getByUserMentorship($mentor, $mentee, $mentorship, $matchcode = null) {
		
		if($matchcode == null) {
			$select = $this->_db->select()	
						->from(array('match' => 'match'))		
						->where('match_active = 1 and match_deleted = 0')
						->where('match.mentor_code = ?', $mentor)
						->where('match.mentee_code = ?', $mentee)
						->where('match.mentorship_code = ?', $mentorship)
						->limit(1);
       } else {
			$select = $this->_db->select()	
						->from(array('match' => 'match'))		
						->where('match_active = 1 and match_deleted = 0')
						->where('match.mentor_code = ?', $mentor)
						->where('match.mentee_code = ?', $mentee)
						->where('match.mentorship_code = ?', $mentorship)
						->where('match.match_code != ?', $matchcode)
						->limit(1);	   
	   }

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}
	
	/**
	 * get job by job match Id
 	 * @param string job id
     * @return object
	 */
	public function getByMentor($mentor, $mentorship) {
		
			$select = $this->_db->select()	
						->from(array('match' => 'match'))
						->joinLeft(array('usermentor' => 'user'), 'usermentor.user_code = match.mentor_code', array('concat(usermentor.user_name, \' \', usermentor.user_surname) as mentorname'))
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = match.mentee_code', array('concat(usermentee.user_name, \' \', usermentee.user_surname) as menteename', 'usermentee.user_code as menteecode'))	
						->where('match_deleted = 0')
						->where('match.mentor_code = ?', $mentor)
						->where('match.mentorship_code = ?', $mentorship)
						->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}
	
	
	public function getAll($where = 'match.match_code is not null', $order = 'match_added desc')
	{
		
		$select = $this->_db->select()
						->from(array('match' => 'match'))		
						->joinLeft(array('usermentor' => 'user'), 'usermentor.user_code = match.mentor_code')
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = match.mentee_code')
						->joinLeft('mentorapp', 'usermentor.user_code = mentorapp.user_code and mentorapp_deleted = 0')
						->joinLeft('menteeapp', 'usermentee.user_code = menteeapp.user_code and menteeapp_deleted = 0')
						->joinLeft('mentorship', 'mentorship.mentorship_code = mentorapp.mentorship_code and mentorship_deleted = 0', array('mentorship_code', 'mentorship_name'))
						->joinLeft('partner', 'partner.partner_code = usermentee.partner_code and partner_deleted = 0 and partner_active = 1')
						->where('match_active = 1 and match_deleted = 0')
						->where($where)
						->order($order);

	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;		
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('match' => 'match'))
					   ->where('match.match_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function array2csv(array &$array) {

	   if (count($array) == 0) {
		 return null;
	   }
	   
	   ob_start();
	   
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
		  fputcsv($df, $row);
	   }
	   
	   fclose($df);
	   return ob_get_clean();
	   
	}
	
	public function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");

		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");

		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}
	
	function createReference() {
	
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "0123456789";
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