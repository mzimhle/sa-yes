<?php

//custom enquiry item class as enquiry table abstraction
class class_meeting extends Zend_Db_Table_Abstract
{

    protected $_name = 'meeting';
	protected $_primary = 'meeting_code';

	public function insert(array $data) {
		
		$data['meeting_code']	= $this->createReference(); 
        $data['meeting_added']	= date('Y-m-d H:i:s');
		
		return parent::insert($data);
		
    }

    public function update(array $data, $where)
    {
        // add a timestamp
        $data['meeting_updated'] = date('Y-m-d H:i:s');
		
        return parent::update($data, $where);
    }
	
	public function getByCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('meeting' => 'meeting'))
						->joinLeft(array('usermentor' => 'user'), 'usermentor.user_code = meeting.mentor_code', array('concat(usermentor.user_name, \' \', usermentor.user_surname) as mentorname'))
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = meeting.mentee_code', array('concat(usermentee.user_name, \' \', usermentee.user_surname) as menteename'))	
						->joinLeft('mentorship', 'mentorship.mentorship_code = meeting.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
						->where('CURDATE() between mentorship_startdate and mentorship_enddate')						
					   ->where('meeting.meeting_code = ?', $code)
					   ->where('meeting.meeting_deleted = 0')
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function getAll($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
						->from(array('meeting' => 'meeting'))
						->joinLeft(array('usermentor' => 'user'), 'usermentor.user_code = meeting.mentor_code', array('concat(usermentor.user_name, \' \', usermentor.user_surname) as mentorname'))
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = meeting.mentee_code', array('concat(usermentee.user_name, \' \', usermentee.user_surname) as menteename'))	
						->joinLeft(array('meetingtype' => 'meetingtype'), 'meetingtype.meetingtype_code = meeting.meetingtype_code and meetingtype_deleted = 0')	
						->joinLeft('mentorship', 'mentorship.mentorship_code = meeting.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
						->where('CURDATE() between mentorship_startdate and mentorship_enddate')
						->where('meeting.meeting_deleted = 0')						
						->where($where)
						->order($order);	

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function searchAll($where = NULL, $order = NULL) {
		$select = $this->_db->select() 
						->from(array('meeting' => 'meeting'))
						->joinLeft(array('usermentor' => 'user'), 'usermentor.user_code = meeting.mentor_code', array('concat(usermentor.user_name, \' \', usermentor.user_surname) as mentorname'))
						->joinLeft(array('usermentee' => 'user'), 'usermentee.user_code = meeting.mentee_code', array('concat(usermentee.user_name, \' \', usermentee.user_surname) as menteename'))	
						->joinLeft(array('meetingtype' => 'meetingtype'), 'meetingtype.meetingtype_code = meeting.meetingtype_code and meetingtype_deleted = 0')	
						->joinLeft('mentorship', 'mentorship.mentorship_code = meeting.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
						->where('meeting.meeting_deleted = 0')						
						->where($where)
						->order($order);	

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;	
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
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('meeting' => 'meeting'))
					   ->where('meeting.meeting_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
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