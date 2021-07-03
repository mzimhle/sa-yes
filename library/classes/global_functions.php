<?php


function randomAlphabet($number = 1) {
	/* New reference. */
	$reference = "";
	$codeAlphabet = "abcdefghijklmnopqrstuvwxyz";
	
	$count = strlen($codeAlphabet) - 1;
	
	for($i=0;$i<$number;$i++){
		$reference .= $codeAlphabet[rand(0,$count)];
	}
	
	return $reference;
	
}	

function validateDomain($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace('https://www.' , '' , $string);
	$string = str_replace('http://www.' , '' , $string);
	$string = str_replace('www://', '', $string);
	$string = str_replace('www.' , '' , $string);

	if(preg_match('/([0-9a-z-]+\.)?[0-9a-z-]+\.[a-z]{2,7}/', trim($string))) {
		return $string;
	} else {
		return '';
	}		
}

function validateEmail($string) {
	if(preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', trim($string))) {
		return trim($string);
	} else {
		return '';
	}
}

function validateID($string) {
	if(preg_match('/^[0-9]{13}$/', trim($string))) {
		return trim($string);
	} else {
		return '';
	}
}

function validateCell($string) {
	if(preg_match('/^[0-9]{10}$/', onlyCellNumber(trim($string)))) {
		return trim($string);
	} else {
		return '';
	}
}

function validateDate($string) {
	if(preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', validDate(trim($string)))) {
		return trim($string);
	} else {
		return '';
	}
}

function validDate($date) {
	if($date == date('Y-m-d', strtotime($date))) {
		return date('Y-m-d', strtotime($date));
	} else {
		return false;
	}
}

function StringToFilename($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace('___' , '_' , $string);
	$string = str_replace('__' , '_' , $string);	
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("è", "e", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "_", $string);
	$string = str_replace("\\", "_", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "_", $string);
	$string = str_replace(".", "_", $string);
	$string = str_replace("ë", "e", $string);	
	$string = str_replace("â€“", "ae", $string);	
	$string = str_replace("â", "a", $string);	
	$string = str_replace("€", "e", $string);	
	$string = str_replace("“", "", $string);	
	$string = str_replace("#", "", $string);	
	$string = str_replace("$", "", $string);	
	$string = str_replace("@", "", $string);	
	$string = str_replace("!", "", $string);	
	$string = str_replace("&", "", $string);	
	$string = str_replace(';' , '_' , $string);		
	$string = str_replace(':' , '_' , $string);		
	$string = str_replace('[' , '_' , $string);		
	$string = str_replace(']' , '_' , $string);		
	$string = str_replace('|' , '_' , $string);		
	$string = str_replace('\\' , '_' , $string);		
	$string = str_replace('%' , '_' , $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(' ' , '_' , $string);
	$string = str_replace('__' , '_' , $string);
	$string = str_replace(' ' , '' , $string);	
	return $string;
			
}

function onlyCellNumber($string) {

	/* Remove some weird charactors that windows dont like. */
	$string = strtolower($string);
	$string = str_replace(' ' , '' , $string);
	$string = str_replace('__' , '' , $string);
	$string = str_replace(' ' , '' , $string);
	$string = str_replace("é", "", $string);
	$string = str_replace("è", "", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "", $string);
	$string = str_replace("\\", "", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "", $string);
	$string = str_replace(".", "", $string);
	$string = str_replace("ë", "", $string);	
	$string = str_replace('___' , '' , $string);
	$string = str_replace('__' , '' , $string);	
	$string = str_replace(' ' , '' , $string);
	$string = str_replace('__' , '' , $string);
	$string = str_replace(' ' , '' , $string);
	$string = str_replace("é", "", $string);
	$string = str_replace("è", "", $string);
	$string = str_replace("`", "", $string);
	$string = str_replace("/", "", $string);
	$string = str_replace("\\", "", $string);
	$string = str_replace("'", "", $string);
	$string = str_replace("(", "", $string);
	$string = str_replace(")", "", $string);
	$string = str_replace("-", "", $string);
	$string = str_replace(".", "", $string);
	$string = str_replace("ë", "", $string);	
	$string = str_replace("â€“", "", $string);	
	$string = str_replace("â", "", $string);	
	$string = str_replace("€", "", $string);	
	$string = str_replace("“", "", $string);	
	$string = str_replace("#", "", $string);	
	$string = str_replace("$", "", $string);	
	$string = str_replace("@", "", $string);	
	$string = str_replace("!", "", $string);	
	$string = str_replace("&", "", $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(':' , '' , $string);		
	$string = str_replace('[' , '' , $string);		
	$string = str_replace(']' , '' , $string);		
	$string = str_replace('|' , '' , $string);		
	$string = str_replace('\\' , '' , $string);		
	$string = str_replace('%' , '' , $string);	
	$string = str_replace(';' , '' , $string);		
	$string = str_replace(' ' , '' , $string);
	$string = str_replace('__' , '' , $string);
	$string = str_replace(' ' , '' , $string);	
	$string = str_replace('-' , '' , $string);	
	$string = str_replace('+27' , '0' , $string);	
	$string = str_replace('(0)' , '' , $string);	
	
	$string = preg_replace('/^00/', '0', $string);
	$string = preg_replace('/^27/', '0', $string);
	
	$string = preg_replace('!\s+!',"", strip_tags($string));
	
	return $string;
			
}

function createReference($connObject, $recruiter) {
	/* New reference. */
	$reference = substr(md5(rand(123, 98745)), 1, 10);
	
	/* First check if it exists or not. */
	$itemCheck = $connObject->getByReference($recruiter, $reference);
	
	if(count($itemCheck) > 0) {
		/* It exists. check again. */
		createReference($connObject, $recruiter);
	} else {
		return $reference;
	}
}

/* Convert word or text to simple text. */
function parseWord($userDoc) {
	$fileHandle = fopen($userDoc, "r");
	$line = @fread($fileHandle, filesize($userDoc));   
	$lines = explode(chr(0x0D),$line);
	$outtext = "";
	foreach($lines as $thisline)
	  {
		$pos = strpos($thisline, chr(0x00));
		if (($pos !== FALSE)||(strlen($thisline)==0))
		  {
		  } else {
			$outtext .= $thisline." ";
		  }
	  }
	 $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);
	return $outtext;
} 

?>