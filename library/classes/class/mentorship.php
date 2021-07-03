<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard administrators functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_mentorship extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'mentorship';
	protected $_primary = 'mentorship_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        if (empty($data['mentorship_added'])) {
            $data['mentorship_added'] = date('Y-m-d H:i:s');
        }

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
        if (empty($data['mentorship_updated'])) {
            $data['mentorship_updated'] = date('Y-m-d H:i:s');
        }
        return parent::update($data, $where);
    }
	
	/**
	 * Get all jobSections as pairs.
	 * example: $jobSections = $collection->jobSectionPairs();
     * @return array
	 */
	 public function pairs() {
		$select = $this->_db->select()
						->from(array('mentorship' => 'mentorship'), array('mentorship_code', 'mentorship_name'))
					   ->where('mentorship_active = 1 and mentorship_deleted = 0')
					   ->order('mentorship_code DESC');

		$result = $this->_db->fetchPairs($select);
		return ($result == false) ? false : $result = $result;
	}
	
	
	public function getAll() {
	
		$select = $this->select()
			->where('mentorship_deleted = 0')
			->order('mentorship_code DESC');

	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	   
	}

	public function getMentors()
	{		
		$select = $this->_db->select()
						->from(array('mentorship' => 'mentorship'), array('mentorship_code', 'mentorship_name'))
						->joinLeft('mentorapp', 'mentorship.mentorship_code = mentorapp.mentorship_code and mentorapp_deleted = 0')
						->joinLeft(array('mentorstatus' => 'applicationstatus'), 'mentorstatus.applicationstatus_code = mentorapp.applicationstatus_code and mentorstatus.applicationstatus_deleted = 0', array('mentorstatus.applicationstatus_code', 'mentorstatus.applicationstatus_name'))
						->where('mentorship_active = 1 and mentorship_deleted = 0')
						->order('mentorship.mentorship_code');

	   $result = $this->_db->fetchAll($select);
        return ($result == false) ? false : $result = $result;		
	}
	
	public function getMentees()
	{		
		$select = $this->_db->select()
						->from(array('mentorship' => 'mentorship'), array('mentorship_code', 'mentorship_name'))
						->joinLeft('menteeapp', 'mentorship.mentorship_code = menteeapp.mentorship_code and menteeapp_deleted = 0')
						->joinLeft('partner', 'partner.partner_code = menteeapp.partner_code and partner_deleted = 0 and partner_active = 1', array('partner_code', 'partner_name'))
						->joinLeft(array('menteestatus' => 'applicationstatus'), 'menteestatus.applicationstatus_code = menteeapp.applicationstatus_code and menteestatus.applicationstatus_deleted = 0', array('menteestatus.applicationstatus_code', 'menteestatus.applicationstatus_name'))
						->where('mentorship_active = 1 and mentorship_deleted = 0')
						->order('mentorship.mentorship_code');

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
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getByCode( $code )
	{
		$select = $this->select() 
					   ->where('mentorship_code = ? ', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('mentorship' => 'mentorship'))
					   ->where('mentorship.mentorship_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}	
}
?>