<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_documents extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'documents';
	protected $_primary = 'documents_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['documents_added'] = date('Y-m-d H:i:s');
        $data['documents_code'] = $this->createReference();

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
        $data['documents_updated'] = date('Y-m-d H:i:s');
        
        return parent::update($data, $where);
    }	
	
	/**
	 * get all users ordered by column name
	 * example: $collection->getAllusers('user_title');
	 * @param string $order
     * @return object
	 */
	public function getAll($code) {
		$select = $this->_db->select()	
					   ->from(array('documents' => 'documents'))
					   ->joinLeft('mentorapp', 'mentorapp.mentorapp_code = documents.mentorapp_code and mentorapp_deleted = 0')
					   ->joinLeft('menteeapp', 'menteeapp.menteeapp_code = documents.menteeapp_code and menteeapp_deleted = 0')
					   ->where('documents.documents_deleted = 0');
		
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getByMentee($code) {
		$select = $this->_db->select()	
					   ->from(array('documents' => 'documents'))
					   ->joinLeft('menteeapp', 'menteeapp.menteeapp_code = documents.menteeapp_code and menteeapp_deleted = 0')
					   ->where('documents.menteeapp_code = ?', $code)
					   ->where('documents.documents_deleted = 0');
		
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;	
	}
	
	public function getByMentor($code) {
		$select = $this->_db->select()	
					   ->from(array('documents' => 'documents'))
					   ->joinLeft('mentorapp', 'mentorapp.mentorapp_code = documents.mentorapp_code and mentorapp_deleted = 0')
					   ->where('documents.mentorapp_code = ?', $code)
					   ->where('documents.documents_deleted = 0');
		
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;	
	}
	
	/**
	 * get all users ordered by column name
	 * example: $collection->getAllusers('user_title');
	 * @param string $order
     * @return object
	 */
	public function getByCode($code) {
		$select = $this->_db->select()	
					   ->from(array('documents' => 'documents'))
					   ->joinLeft('mentorapp', 'mentorapp.mentorapp_code = documents.mentorapp_code and mentorapp_deleted = 0')
					   ->joinLeft('menteeapp', 'menteeapp.menteeapp_code = documents.menteeapp_code and menteeapp_deleted = 0')
					   ->where('documents.documents_code = ?', $code)
					   ->where('documents.documents_deleted = 0');
		
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('documents' => 'documents'))
					   ->where('documents.documents_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		//$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = "123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 15; $i++) {
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