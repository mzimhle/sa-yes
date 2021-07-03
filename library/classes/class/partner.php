<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_partner extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'partner';
	protected $_primary = 'partner_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['partner_added'])) {
            $data['partner_added'] = date('Y-m-d H:i:s');
        }

        $data['partner_code'] = $this->createReference();

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
        if (empty($data['partner_updated'])) {
            $data['partner_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * Get all jobSections as pairs.
	 * example: $pairs = $collection->pairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('partner' => 'partner'), array('partner_code', 'partner_name'))
						->joinLeft('partnertype', 'partnertype.partnertype_code = partner.partnertype_code and partnertype_deleted = 0')
						->joinLeft('area', 'area.area_code = partner.area_code')
					   ->where('partner_active = 1 and partner_deleted = 0')
					   ->order('partner_name ASC');

		$result = $this->_db->fetchPairs($select);
		return ($result == false) ? false : $result = $result;
	}
	
	public function getAll() {
	
		$select = $this->_db->select()
						->from(array('partner' => 'partner'))
						->joinLeft('partnertype', 'partnertype.partnertype_code = partner.partnertype_code and partnertype_deleted = 0')
						->joinLeft('area', 'area.area_code = partner.area_code')
						->where('partner_deleted = 0');

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
		$select = $this->_db->select()
						->from(array('partner' => 'partner'))
						->joinLeft('partnertype', 'partnertype.partnertype_code = partner.partnertype_code and partnertype_deleted = 0')
						->joinLeft('area', 'area.area_code = partner.area_code')
					   ->where('partner_code = ? ', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select()
						->from(array('partner' => 'partner'))
						->where('partner_deleted = 0')
					   ->where('partner.partner_code = ?', $code)
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