<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_partnercontact extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'partnercontact';
	protected $_primary = 'partnercontact_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
         $data['partnercontact_added'] = date('Y-m-d H:i:s');
        $data['partnercontact_code'] = $this->createReference();

		
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
		$data['partnercontact_updated'] = date('Y-m-d H:i:s');

        return parent::update($data, $where);
    }
	
	public function getAll() {
	
		$select = $this->select()
					->where('partnercontact_deleted = 0');

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	public function searchContact($where = NULL, $order = NULL) {
	
		$select = $this->_db->select() 
					   ->from(array('partnercontact' => 'partnercontact'), array('partnercontact_fullname as fullname', 'partnercontact_email as email', 'partnercontact_cell as cell'))
					   ->joinLeft('partner', 'partner.partner_code = partnercontact.partner_code and partnercontact_deleted = 0 and partnercontact_active = 1', array())
					   ->where('partner.partner_deleted = 0 and partnercontact.partnercontact_deleted = 0')
					   ->where($where)
					   ->order($order);
					   echo $select; exit;
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? array() : $result = $result;
	   
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByPartner( $code )
	{
		$select = $this->select() 
					   ->where('partner_code = ? ', $code);
					   
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByCode( $code )
	{
		$select = $this->select() 
					   ->where('partnercontact_code = ? ', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('partnercontact' => 'partnercontact'))
					   ->where('partnercontact.partnercontact_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet = "0123456789";
		$count = strlen($codeAlphabet) - 1;
		
		for($i = 0; $i < 8; $i++) {
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