<?php

//custom enquiry item class as enquiry table abstraction
class class_applicationstatus extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'applicationstatus';
	protected $_primary = 'applicationstatus_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp        
        $data['applicationstatus_added']	= date('Y-m-d H:i:s');
		$data['applicationstatus_code']	= $this->createReference();
		
		return parent::insert($data);
    }

	
	/**
	 * Update the database record
	 * example: $table->update($data, $where);
	 * @param query string $where
	 * @param array $data
     * @return boolean
	 */
    public function update(array $data, $where){
        // add a timestamp
        $data['applicationstatus_updated'] = date('Y-m-d H:i:s');        
		
        return parent::update($data, $where);
    }
	
	public function getAll($where = 'applicationstatus.applicationstatus_deleted = 0', $order = 'applicationstatus_added DESC') {
	
		$select = $this->select() 
					   ->from(array('applicationstatus' => 'applicationstatus'))
					   ->where($where)
					   ->order($order);

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	}
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('applicationstatus' => 'applicationstatus'), array('applicationstatus_code', 'applicationstatus_name'))
					   ->where('applicationstatus_active = 1 AND applicationstatus_deleted = 0')
					   ->order('applicationstatus_name ASC');

		$result =  $this->_db->fetchPairs($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getByCode( $code )
	{
		$select = $this->select() 
						->from(array('applicationstatus' => 'applicationstatus'))
					    ->where('applicationstatus_code = ? ', $code)
					    ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('applicationstatus' => 'applicationstatus'))
					   ->where('applicationstatus.applicationstatus_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		//$codeAlphabet .= '123456789';
		
		$count = strlen($codeAlphabet) - 1;
		
		for($i=0;$i<5;$i++){
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