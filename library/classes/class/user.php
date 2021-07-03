<?php

//custom enquiry item class as enquiry table abstraction
class class_user extends Zend_Db_Table_Abstract
{

    protected $_name		= 'user';
	protected $_primary	= 'user_code';

	public function insert(array $data) {
		
		if(!isset($data['user_code'])) {
			$data['user_code']	= $this->createReference();
		} else if(isset($data['user_code']) && trim($data['user_code']) == ''){
			$data['user_code']	= $this->createReference();
		}		
		
		$data['user_added']		= date('Y-m-d H:i:s');
		$data['user_decoded']	= $this->createPassword();
		$data['user_password']	= new Zend_Db_Expr('PASSWORD(\''.$data['user_decoded'].'\')');
		
		return parent::insert($data);
		
    }
	
    public function update(array $data, $where)
    {
        // add a timestamp
        if (empty($data['user_updated'])) {
            $data['user_updated'] = date('Y-m-d H:i:s');
        }
		
		if(isset($data['user_password']) && trim($data['user_password']) != '') {
			$data['user_password'] = new Zend_Db_Expr('PASSWORD(\''.$data['user_password'].'\')');
		}
		
        return parent::update($data, $where);
    }
	
	public function insertFromMenteeApplication(array $data) {
	        
		$insertdata['user_code']				= $this->createReference();
		$insertdata['partner_code'] 		= trim($data['partner_code']);		
		$insertdata['usertype_code'] 		= $data['usertype_code'];	
		$insertdata['area_code'] 			= trim($data['area_code']);			
		$insertdata['user_dateofbirth'] 	= trim($data['menteeapp_dateofbirth']);			
		$insertdata['user_name'] 			= trim($data['menteeapp_name']);				
		$insertdata['user_surname'] 		= trim($data['menteeapp_surname']);				
		$insertdata['user_idnumber'] 		= trim($data['menteeapp_idnumber']);				
		$insertdata['user_email'] 			= trim($data['menteeapp_email']);	
		$insertdata['user_cell'] 				= trim($data['menteeapp_number']);	
		$insertdata['user_race'] 				= trim($data['menteeapp_race']);		
		$insertdata['user_notes'] 			= trim($data['menteeapp_notes']);		
		$insertdata['user_address'] 		= trim($data['menteeapp_address']);		
		$insertdata['user_gender'] 			= trim($data['menteeapp_gender']);				
		$insertdata['user_active']			= 0;			
		$insertdata['user_deleted']			= 0;			
		
		$this->insert($insertdata);	
				
		return $insertdata['user_code'];
		
	}
	
	public function updateFromMenteeApplication(array $data, $code) {
	
        // add a timestamp
		$updatedata['partner_code'] 		= trim($data['partner_code']);		
		$updatedata['area_code'] 			= trim($data['area_code']);			
		$updatedata['user_dateofbirth'] 	= trim($data['menteeapp_dateofbirth']);			
		$updatedata['user_name'] 			= trim($data['menteeapp_name']);				
		$updatedata['user_surname'] 		= trim($data['menteeapp_surname']);				
		$updatedata['user_idnumber'] 	= trim($data['menteeapp_idnumber']);				
		$updatedata['user_email'] 			= trim($data['menteeapp_email']);	
		$updatedata['user_cell'] 			= trim($data['menteeapp_number']);	
		$updatedata['user_race'] 			= trim($data['menteeapp_race']);			
		$updatedata['user_notes'] 			= trim($data['menteeapp_notes']);		
		$updatedata['user_address'] 		= trim($data['menteeapp_address']);		
		$updatedata['user_gender'] 		= trim($data['menteeapp_gender']);		
		$updatedata['user_decoded']		= $this->createPassword();
		$updatedata['user_password']		= $updatedata['user_decoded'];
		
		/* if its for previous years update, leave it, only if its for current year's program needs to be deactivated. */
		if(isset($data['mentorship_code']) && $data['mentorship_code'] == date('Y')) {
			$updatedata['user_active'] 		= 0;				
		}
		
		$where = $this->getAdapter()->quoteInto('user_code = ?', $code);
		$success = $this->update($updatedata, $where);	
		
	}
	
	public function insertFromMentorApplication(array $data) {
	
        
		$insertdata['user_code']				= $this->createReference();	
		$insertdata['usertype_code'] 		= $data['usertype_code'];		
		$insertdata['area_code'] 			= trim($data['area_code']);			
		$insertdata['user_dateofbirth'] 	= trim($data['mentorapp_dateofbirth']);			
		$insertdata['user_name'] 			= trim($data['mentorapp_name']);				
		$insertdata['user_surname'] 		= trim($data['mentorapp_surname']);				
		$insertdata['user_idnumber'] 		= trim($data['mentorapp_idnumber']);				
		$insertdata['user_email'] 			= trim($data['mentorapp_email']);	
		$insertdata['user_cell'] 				= trim($data['mentorapp_cell']);	
		$insertdata['user_telephone']		= trim($data['mentorapp_telephone']);		
		$insertdata['user_race'] 				= trim($data['mentorapp_race']);	
		$insertdata['user_notes'] 			= trim($data['mentorapp_notes']);		
		$insertdata['user_address'] 		= trim($data['mentorapp_address']);		
		$insertdata['user_gender'] 			= trim($data['mentorapp_gender']);			
		$insertdata['user_active']			= 0;			
		$insertdata['user_deleted']			= 0;			

		$this->insert($insertdata);	
				
		return $insertdata['user_code'];
		
	}
	
	public function updateFromMentorApplication(array $data, $code) {
	
        // add a timestamp	
		$updatedata['area_code'] 			= trim($data['area_code']);			
		$updatedata['user_dateofbirth'] 	= trim($data['mentorapp_dateofbirth']);			
		$updatedata['user_name'] 			= trim($data['mentorapp_name']);				
		$updatedata['user_surname'] 		= trim($data['mentorapp_surname']);				
		$updatedata['user_idnumber'] 	= trim($data['mentorapp_idnumber']);				
		$updatedata['user_email'] 			= trim($data['mentorapp_email']);	
		$updatedata['user_cell'] 			= trim($data['mentorapp_cell']);	
		$updatedata['user_telephone']	= trim($data['mentorapp_telephone']);	
		$updatedata['user_race'] 			= trim($data['mentorapp_race']);			
		$updatedata['user_notes'] 			= trim($data['mentorapp_notes']);		
		$updatedata['user_address'] 		= trim($data['mentorapp_address']);		
		$updatedata['user_gender'] 		= trim($data['mentorapp_gender']);	
		$updatedata['user_decoded']		= $this->createPassword();
		$updatedata['user_password']		= $updatedata['user_decoded'];
		
		/* if its for previous years update, leave it, only if its for current year's program needs to be deactivated. */
		if(isset($data['mentorship_code']) && $data['mentorship_code'] == date('Y')) {
			$updatedata['user_active'] 		= 0;				
		}
		
		$where = $this->getAdapter()->quoteInto('user_code = ?', $code);
		$success = $this->update($updatedata, $where);	
		
	}	
	
	/**
	 * get all users ordered by column name
	 * example: $collection->getAllusers('user_title');
	 * @param string $order
     * @return object
	 */
	public function checkLogin($username = '', $password= '')
	{
		$select = $this->_db->select()	
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->joinLeft('area', 'area.area_code = user.area_code')
						->where('user_email = ?', $username)
						->where('user.user_password = PASSWORD(?)', $password) 
						->where('user_deleted = 0')
						->where('user_active = 1');
		
	   $result = $this->_db->fetchRow($select);
	   
	   if(count($result) > 0) {
			if($result['usertype_code'] == 2) {
				if(!$this->mentorLogin($result['user_code'])) {
					return false;
				}
			}
	   }
	   
       return ($result == false) ? false : $result = $result;

	}
	
	/**
	 * get all users ordered by column name
	 * example: $collection->getAllusers('user_title');
	 * @param string $order
     * @return object
	 */
	public function adminLogin($code)
	{
		$select = $this->_db->select()	
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('user.user_code = ?', $code)
					   ->where('user.user_deleted = 0');
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;

	}
	
	/**
	 * get all users ordered by column name
	 * example: $collection->getAllusers('user_title');
	 * @param string $order
     * @return object
	 */
	public function mentorLogin($usercode)
	{
		$select = $this->_db->select()	
					   ->from(array('user' => 'user'))
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1 ', array('usermentorship_code'))
					   ->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
						->where('user.user_code = ?', $usercode)
						->where('usermentorship.mentorship_code = YEAR(CURDATE())')
						->where('user_deleted = 0')
						->where('user_active = 1');
		
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
	
	public function getByCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1', array('usermentorship_code'))
					   ->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1 and CURDATE() between mentorship_startdate and mentorship_enddate')
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('CURDATE() between mentorship_startdate and mentorship_enddate')
					   ->where('user.user_code = ?', $code)
					   ->where('user.user_deleted = 0')
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function getUserToLink($code, $type) {
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->where('user.user_code = ?', $code)
					   ->where('user.usertype_code = ?', $type)
					   ->where('user.user_deleted = 0')
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;	
	}
	
	public function getAll($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1', array('usermentorship_code'))
					   ->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('CURDATE() between mentorship_startdate and mentorship_enddate')
					   ->where('user.user_deleted = 0')
						->where($where)
						->order($order);	
					   
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function getReport($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0', array('usertype_name'))
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1', array('usermentorship_code'))
					   ->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
						->where($where)
						->order($order);
						
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function searchAll($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1', array('usermentorship_code'))
					   ->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('user.user_active = 1 and user.user_deleted = 0')
					   ->where($where)
					   ->order($order);
					   
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function searchAdmin($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('user.user_active = 1 and user.user_deleted = 0 and usertype_code = 1')
					   ->where($where)
					   ->order($order);
					   
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}	
	
	public function getAdmin($code) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('user.user_active = 1 and user.user_deleted = 0 and usertype_code = 1')
					   ->where('user_code = ?', $code);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}	
	
	public function searchUsers($term, $type, $active = array(0,1)) {
		
		if(is_array($active)) { $active = implode(',',$active); }
		
		$select = $this->_db->select()  
					   ->from(array('user' => 'user'))
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1', array('mentorship_code'))
						->where("user_deleted = 0 and user_active in ($active)")
						->where('usertype_code = ?', $type)
					   ->where("lower(concat(user_name, ' ', user_surname, ' ', user_email, ' ', user_cell)) like ?", '%'.strtolower($term).'%')
					   ->order('user_name desc');

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;	
	}
	
	public function searchApplication($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
						->where('user_deleted = 0')
					   ->where($where)
					   ->order($order);
					   
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function searchContact($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'), array("concat(user_name, ' ', user_surname) fullname", 'user_email as email', 'user_cell as cell', 'user_code as reference'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1', array('usertype_name'))
					   ->where('user.user_deleted = 0')
					   ->where($where)
					   ->order($order);

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? array() : $result = $result;
	   
	}
	
	
	public function getAllToAssign($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->joinLeft('usertype', 'usertype.usertype_code = user.usertype_code and usertype_deleted = 0 and usertype_active = 1')
					   ->joinLeft('usermentorship', 'usermentorship.user_code = user.user_code and usermentorship_deleted = 0 and usermentorship_active = 1', array('usermentorship_code'))
					   ->joinLeft('mentorship', 'mentorship.mentorship_code = usermentorship.mentorship_code and mentorship_deleted = 0 and mentorship_active = 1')
					   ->joinLeft('area', 'area.area_code = user.area_code')
					   ->joinLeft('partner', 'partner.partner_code = user.partner_code')
					   ->where('user.user_deleted = 0 and user.user_active = 1')
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
	
	public function checkEmail($email, $code = null)
	{
		if($code == null) {
		$select = $this->_db->select()	
						->from(array('user' => 'user'))	
						->where('user_email = ?', $email)
						->where('user_deleted = 0');						
		} else {
		$select = $this->_db->select()
						->from(array('user' => 'user'))
						->where('user_email = ?', $email)
						->where('user_code != ?', $code)
						->where('user_deleted = 0');
		}		

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;

	}
	
	public function checkUpdateEmail($email, $code)
	{
		$select = $this->_db->select()
						->from(array('user' => 'user'))
						->where('user_email = ?', $email)
						->where('user_code != ?', $code)
						->where('user_deleted = 0');

	   $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;

	}	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('user' => 'user'))
					   ->where('user.user_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByCell($number, $usercode = false) {
		
		if($usercode == false) {
		
			$select = $this->_db->select()
							->from(array('user' => 'user'))
							->where('user_cell = ? ', $number)
							->where('user_deleted = 0')
							->limit(1);
							
		} else {
			$select = $this->_db->select()
							->from(array('user' => 'user'))
							->where('user_code != ?', $usercode)
							->where('user_cell = ? ', $number)
							->where('user_deleted = 0')
							->limit(1);		
		}
		
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
	
	function filename() {
		/* New reference. */
		$reference = "";
		// $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 10; $i++) {
			$reference .= $codeAlphabet[rand(1,$count)];
		}
		
		return $reference;
		
	}	
	
	function createPassword() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 6; $i++) {
			$reference .= $codeAlphabet[rand(1,$count)];
		}
		
		return $reference;

	}		
}
?>