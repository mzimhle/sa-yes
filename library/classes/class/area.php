<?php

/**
 * This class uses the Zend Framework :
 * @package    Zend_Db
 * This class is used for all standard areas functions, both singleton and collection
 * Created: 05 May 2009
 * Author: Rafeeqah Mollagee
 */

//custom enquiry item class as enquiry table abstraction
class class_area extends Zend_Db_Table_Abstract
{
   //declare table variables
    protected $_name = 'area';
	protected $_primary = 'area_code';

	/**
	 * Insert the database record
	 * example: $table->insert($data);
	 * @param array $data
     * @return boolean
	 */ 

	 public function insert(array $data)
    {
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
        return parent::update($data, $where);
    }
	
	/**
	 * Get area by areaId
	 * example: $collection->getByfkAreaId(2);
	 * @param string $order
     * @return object
	 */
	public function getByFullPath($path)
	{
		$select = $this->select()
					   ->where('area_path = ?', $path);

	   $result = $this->_db->fetchAll($select);	
       return ($result == false) ? false : $result = $result;		

	}	
	/**
	 * Get area by areaId
	 * example: $collection->getByfkAreaId(2);
	 * @param string $order
     * @return object
	 */
	public function getByCode($areaId)
	{
		$select = $this->_db->select()
						->from(array('a' => 'area'))
						->joinLeft(array('p' => 'area'), 'p.area_code = a.parent_area_code')						
						->where('a.area_code = ?', $areaId);

	   $result = $this->_db->fetchRow($select);	
       return ($result == false) ? false : $result = $result;		

	}
		/**
	 * Get area by mapped areas.
	 * example: $collection->getMappedAreas(2);
	 * @param string $order
     * @return object
	 */
	public function getMappedSubProvinceAreas($parentAreaId)
	{
	
			//fetch all areas from AreaMap
		return $this->_db->fetchAll("SELECT * FROM area WHERE area_sPath LIKE '%|".$parentAreaId."|%' AND area_active = 1 AND area_deleted = 0 AND areatype_code != 2");
		
		/*
		$select = $this->select()
		               ->where("parent_area_code in (?)",$subAreas)
		               ->order(array("area_name"));		   

        return $this->fetchAll($subAreas);
		*/
	}
	
	/**
	 * get all areas ordered by column name
	 * example: $collection->getAllareas('area_title');
	 * @param string $order
     * @return object
	 */
	public function getAll($where = "area_name !=''", $order = 'area_name DESC')
	{
			$select = $this->_db->select()
						->from(array('area' => 'area'))
						->where($where)
						->where('area_active = 1 AND area_deleted = 0')
						->order($order);
					   
	   $result = $this->_db->fetchAll($select);	
        return ($result == false) ? false : $result = $result;		

	}
	
	 public function areaPairs($where = 'area_name != ""') {
		$select = $this->_db->select()
					   ->from(array('a' => 'area'), array('a.area_code', 'a.area_name'))
					   ->where($where)
					   ->order('area_name DESC');

	   $result = $this->_db->fetchPairs($select);	
        return ($result == false) ? false : $result = $result;				
	}	 		
	
	 public function areaPairsByType($areaType = 4) {
	 
		$select = $this->_db->select()
					   ->from(array('a' => 'area'), array('a.area_code', 'a.area_name'))
					   ->where('areatype_code = ?', $areaType)
					   ->where('area_active = 1 AND area_deleted = 0')
					   ->order('area_name DESC');

	   $result = $this->_db->fetchPairs($select);	
        return ($result == false) ? false : $result = $result;					
		
	}		
    /**
     * get all areas within a specific area ( NB not limited to 1 level direct children, use getDirectSubAreas for this)
     * example: $obj->getSubAreas();
     * @param integer $parentAreaId
     * @return array of area objects
     */
    public function getSubAreas($parentAreaId = -1){
        
		//check $parentAreaId is numeric
        if (!is_numeric($parentAreaId) || ($parentAreaId == -1) ){
				echo 'Only numeric parameters.';
				exit;
        }
		
		//fetch all areas from AreaMap
		$subAreas = $this->_db->fetchCol("SELECT area_code FROM area WHERE area_sPath LIKE '%|".$parentAreaId."|%'");
		
		$select = $this->select()
		               ->where("parent_area_code in (?)",$subAreas)
		               ->order(array("area_name"));		   

        return $this->fetchAll($select);
		
    }
	
	/**
	 * Get job count by area
	 * example: $table->jobCoutByArea();
	 * @param string city
	 * @return array
	 */
	 
	public function getAllProvinceAreaPairs() {
		
		$select = $this->_db->select()
						->from(array('area' => 'area'), array('area_code'))
						->joinLeft('job', 'area.area_code = job.fk_area_id', 'CONCAT(CONCAT(area.area_name, CONCAT(" (", COUNT(pk_job_id))), ")") AS area_count')						
						->where('job.job_active = 1 AND job.job_deleted = 0')
						->group('area_code')
						->order('area.area_name ASC');		
						
	   $result = $this->_db->fetchPairs($select);	
       return ($result == false) ? false : $result = $result;			
		
	}	
	
	
	/**
	 * Get areas by type.
	 * example: $table->getByType(5);
	 * @param integer
	 * @return array
	 */
	 
	public function getByType($areaTypeId) {
		
		$select = $this->_db->select()
						->from(array('area' => 'area'), array('area_code', 'area_name'))
						->joinLeft('areaType', 'area.areatype_code = areaType.areaTypeId', 'areaTypeName')						
						->where('areaTypeId = ?', $areaTypeId)
						->where('area.area_active = 1 AND area.area_deleted = 0')
						->order('area.area_name ASC');						
						
	   $result = $this->_db->fetchAll($select);	
       return ($result == false) ? false : $result = $result;			
	}	

		public function getAllByType($areaTypeArray) {
		
		$select = $this->_db->select()
						->from(array('area' => 'area'), array('area_path', 'area_code', 'area_name'))
						->joinLeft('areaType', 'area.areatype_code = areaType.areaTypeId', 'areaTypeName')						
						->where('areaTypeId IN (?)', $areaTypeArray)
						->where('area.area_active = 1 AND area.area_deleted = 0')
						->order('area.area_name ASC');	
						
		$result = $this->_db->fetchAll($select);	
        return ($result == false) ? false : $result = $result;	
	}	
	/**
     * get a specific area
     * example: $obj->getArea();
     * @param int $areaId
     * @return an area object
     */
    public function getArea($areaId = -1) {
		
       //check $areaId is numeric
        if (!is_numeric($areaId) || ($areaId == -1) ){
				echo 'Only numeric parameters.';
				exit;
        }
		
        $select = $this->select()
                       ->where("area_code = ?",$areaId);

        $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;	
    }
	
   	/**
     * get path to root area vain.
     * example: $obj->getPathToRoot();
     * @param string $areaId
     * @return array of areas
     */
     public function getPathToRoot($areaId = -1){
		
       //check $areaId is numeric
        if (!is_numeric($areaId) || ($areaId == -1) ){
				echo 'Only numeric parameters.';
				exit;
        }		
		
		//fetch the path from AreaMap
		$map = $this->_db->fetchOne("Select area_sPath from area where area_code = ?",$areaId);
	
		//check we have data to split & remove empty top and tail nulls
		if (strlen($map) > 0) {
		    $nodes = array_filter(explode("|",$map));
		}
		 
		//return and array of area objects  
		$areaPathArray = array();
		
		if (isset($nodes) && !is_null($nodes) && is_array($nodes) && count($nodes) > 0) { // prevent "undefined variable" PHP Notice
			foreach ($nodes as $node){
				$nodeData = $this->getArea((int)$node);
				$areaPathArray[] = $nodeData;  // only one element is returned
			}
		}
		//return array of areas 
		return $areaPathArray;

	}	
	
	public function fetchAreaName($areaId) {
		return $this->_db->fetchOne("Select area_name from area where area_code = ?",$areaId);
		
	}
	
	public function fetchByLink($areaLink) {
		return $this->_db->fetchRow("Select area_code, area_shortPath from area where TRIM(REPLACE(REPLACE(LOWER(area_shortPath), ', ', '_'), ' ', '_')) = ?", $areaLink);
		
	}
	
	public function fetchByShortPath($pathName) {
        $select = $this->select()
                       ->where("REPLACE(LOWER(area_shortPath), ' ', '') = ?",$pathName);
					   
        $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;	
		
	}
	
	public function fetchByShortPath_removeCharacters($pathName) {
        $select = $this->select()
                       ->where("REPLACE(REPLACE(REPLACE(LOWER(area_shortPath), ' ', ''), ',', ''), '-', '') = ?",$pathName);
					   
        $result = $this->_db->fetchRow($select);	
        return ($result == false) ? false : $result = $result;	
		
	}	
	public function getShortPath($rowArray) {
	
		/* Provinces array. */
		$provinces = array(2, 11, 12, 13, 14, 15, 16, 17, 18);	
		/* Separate the IDS. */
		$mapIds = explode("|", $rowArray['area_sPath']);
			
		/* Get province first. */
		for($z = 0; $z < count($mapIds); $z++) {
			/* Output the province. */
			if(in_array($mapIds[$z], $provinces)) {		
				$provinceName = $this->fetchAreaName($mapIds[$z]);
				if(trim(strtolower($rowArray['area_name'])) == trim(strtolower($provinceName)))				
					return $rowArray['area_name'].', '.$this->fetchAreaName($rowArray['parent_area_code']);			
				else {
					return $rowArray['area_name'].', '.$provinceName;
				}
			}
		}		
	}
	
	/**
	 * get spam by spam spam Id
 	 * @param string spam id
     * @return object
	 */
	public function getWithoutCoordinates($limit = 20)
	{
		$select = $this->_db->select() 
						->from(array('area' => 'area'))		
					   ->where('area_google_name  is null')
					   ->limit($limit);

		$result = $this->_db->fetchAll($select);
		return ($result == false) ? false : $result = $result;
	}
	
	function getPath($areaId,$currentAreaName) {
		
		$maxDepth = 3;
		
		//check if the $areaId is valid
		if ( !isset($areaId) || !is_numeric($areaId)) return '-';
		
		// get data
		$areaObj = $this->getPathToRoot($areaId);

		//convert to standard array
		$areas = array();
		if ( is_array($areaObj)) {
			foreach ($areaObj as $area) {
				
				//exclude duplicate first area
				if ($area->area_name != $currentAreaName) $areas[] = $area->area_name;
			}
		}
		
		//check for reverse
		$areas = array_reverse($areas);
		
		$pathString = '';
		$totalAreas = count($areas);
		for ($currentArea = 0; $currentArea < $totalAreas; $currentArea++) {
			if ($currentArea > $maxDepth-1) break;

			//check how deep and skip one level if too deep
			//if ( ($totalAreas > 2)) { 
			//	if ($currentArea > 1) $pathString .= ', ';
			//	if ($currentArea > 0) $pathString .= $areas[$currentArea];
			//}else{
				if ($currentArea > 0) $pathString .= ', ';
				$pathString .= $areas[$currentArea];
			//}
		}
			
		return $currentAreaName.', '.$pathString;
	}
}
?>