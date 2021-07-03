<?php

//custom enquiry item class as enquiry table abstraction
class class_calendar extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'calendar';
	protected $_primary = 'calendar_code';
	
	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
        // add a timestamp
        $data['calendar_added']		= date('Y-m-d H:i:s');
		$data['calendar_code']		= $this->createReference();
		
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
        $data['calendar_updated']	= date('Y-m-d H:i:s');        
		
        return parent::update($data, $where);
    }
	
	public function getByCode($code) {
	
		$select = $this->_db->select() 
						->from(array('calendar' => 'calendar'))
						->joinLeft('calendartype', 'calendartype.calendartype_code = calendar.calendartype_code')
						->joinLeft('user', 'user.user_code = calendar.user_code')
						->where('calendar_code = ?', $code);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getAll($where = 'calendar.calendar_code is not null', $order = 'calendar_added desc', $list = false) {
	
		if($list) {
			$select = $this->_db->select() 
							->from(array('calendar' => 'calendar'))
							->joinLeft('calendartype', 'calendartype.calendartype_code = calendar.calendartype_code')
							->joinLeft('user', 'user.user_code = calendar.user_code')
							->where($where)
							->order($order);
		} else {
		
			$select = "select
								calendar.*, calendartype.*, user.*, group_concat(calendarattend_fullname separator ', ') As attendees, count(calendarattend_fullname) as attendeesnumber
							from
								calendar
								left join calendartype on calendartype.calendartype_code = calendar.calendartype_code
								left join user on user.user_code = calendar.user_code
								left join calendarattend on  calendarattend.calendar_code = calendar.calendar_code and calendarattend_active = 1 and calendarattend_deleted = 0
							where
								calendar.calendar_deleted = 0 and $where
							group by calendar.calendar_code
							order by $order;";									
		}
		
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	}
	
	public function getCode($code) {
	
		$select = $this->_db->select() 
					   ->from(array('calendar' => 'calendar'))
					   ->where('calendar.calendar_code = ?', $code)
					   ->limit(1);
					   
	   $result = $this->_db->fetchRow($select);
       return ($result == false) ? false : $result = $result;
	   
	}
	
	function createReference() {
		/* New reference. */
		$reference = "";
		//$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
	
	public function searchContact($where) {
		
		$select = "select fullname, code, email, cell, type, search from
							(select
								concat(user_name,' ',user_surname)fullname,
								`user`.`user_code` AS `code`,
								`user`.`user_email` AS `email`,
								`user`.`user_cell` AS `cell`,
								'user' as type,
								concat(user_name,' ',user_surname,' - ',user_email,' - ',user_cell, ' - ') search
							from
								`user`
							left join  `usertype` ON usertype.usertype_code = user.usertype_code
							and usertype_deleted = 0
							and usertype_active = 1
							where
								user_deleted = 0
							union
							select
								`partnercontact`.`partnercontact_fullname` AS `fullname`,
								`partnercontact`.`partnercontact_code` AS `code`,
								`partnercontact`.`partnercontact_email` AS `email`,
								`partnercontact`.`partnercontact_cell` AS `cell`,
								'partner' as type,
								concat(partnercontact_fullname,' - ',partnercontact_email,' - ',partnercontact_cell) as search
							from
								`partnercontact`
							left join `partner` ON partner.partner_code = partnercontact.partner_code
							and partner_deleted = 0
							where
								partner.partner_deleted = 0 and partnercontact.partnercontact_deleted = 0) nom where nom.search like '%$where%' order by nom.fullname;";
						
	   $result = $this->_db->fetchAll($select);
       return ($result == false) ? false : $result = $result;
	}
}
?>