<?php
/* Add this on all pages on top. */
set_include_path(realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/'.PATH_SEPARATOR.realpath($_SERVER['DOCUMENT_ROOT']).'/meetings/library/classes/');

//custom account item class as account table abstraction
class class_comms extends Zend_Db_Table_Abstract {
    
   //declare table variables
    protected $_name 		= '_comms';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['_comms_added'])) {
            $data['_comms_added'] = date('Y-m-d H:i:s');
        }

		return parent::insert($data);
		
    }
	
	/**
	 * get job by job _comms Id
 	 * @param string job id
     * @return object
	 */
	public function getByCode($code)
	{
		
		$select = $this->_db->select()	
					->from(array('_comms' => '_comms'))								
					->where('_comms_code = ?', $code)
					->limit(1);
       
	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;

	}
	
	
	public function getAll($where = NULL, $order = NULL)
	{		
		$select = $this->_db->select()	
					->from(array('_comms' => '_comms'))
					->where($where)
					->order($order);	
					
		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function sendEmailComm($template, $userData, $subject, $from) {
		
		require 'config/smarty.php';
		
		global $marty; 
		
		require_once('Zend/Mail.php');
		
		$mail = null; unset($mail);
		$mail = new Zend_Mail();
		
		$data								= array();
		$data['_comms_code']		= $this->createReference();
		
		$smarty->assign('mailercode', $data['_comms_code']);
		$smarty->assign('userData', $userData);	
		$smarty->assign('host', $_SERVER['HTTP_HOST']);
		
		$message = $smarty->fetch($template);
		$mail->setFrom($from['email'], $from['name']); //EDIT!!											
		$mail->addTo($userData['user_email']);
		//$mail->addTo('wendy@sa-yes.com');
		//$mail->addTo('mzimhle.mosiwe@gmail.com');
		$mail->setSubject($subject);
		$mail->setBodyHtml($message);			

		/* Save data to the comms table. */
		$data['user_code']				= isset($userData['user_code']) ? $userData['user_code'] : null;
		$data['_comms_type']			= 'email';
		$data['_comms_email']		= trim($userData['user_email']);
		$data['_comms_output']		= '';
		$data['_comms_category']	= isset($userData['category']) ? $userData['category'] : null;
		$data['_comms_reference']	= isset($userData['reference']) ? $userData['reference'] : null;
		$data['_comms_fullname']	= isset($userData['user_name']) ? $userData['user_name'] : null;
		$data['_comms_sent']			= null;
		$data['_comms_html']			= $message;
		$data['_comms_name']		= $subject;
		
		$this->insert($data);
		
		try {		
			$mail->send();
			$data['_comms_sent']	= 1;	
			$comms						= $data['_comms_code'];
			$data['_comms_output']	= 'Email Sent!';
			
		} catch (Exception $e) {
			$data['_comms_sent']	= 0;	
			$comms						= false;
			$data['_comms_output']	= $e->getMessage();
		}
		
		$where = $this->getAdapter()->quoteInto('_comms_code = ?', $data['_comms_code']);
		$success = $this->update($data, $where);
		
		$mail = null; unset($mail);
		
		return $comms;		
	}
		
	/**
	 * get domain by domain Account Id
 	 * @param string domain id
     * @return object
	 */
	public function getCode($reference)
	{
		$select = $this->_db->select()	
						->from(array('_comms' => '_comms'))		
					   ->where('_comms_code = ?', $reference)
					   ->limit(1);

	   $result = $this->_db->fetchRow($select);
        return ($result == false) ? false : $result = $result;				   		
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "123456789";

		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<13;$i++) {
			$reference .= $codeAlphabet[rand(0,$count)];
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