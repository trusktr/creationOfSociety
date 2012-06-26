<?php /*Declare Functions*/
	
	function isIe() {
		if ( isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'chromeframe') === false )
			return true;
		else
			return false;
	}
	
	function ieVersion() {
		$match=preg_match('/MSIE ([0-9]\.[0-9])/', $_SERVER['HTTP_USER_AGENT'], $reg);
		if($match==0) return -1;
		else return floatval($reg[1]);
	}
	
	function isChrome() {
		if ( eregi("chrome", $_SERVER['HTTP_USER_AGENT']) && !eregi("chromeframe", $_SERVER['HTTP_USER_AGENT']) )
		return;
	}
	
	function isChromeFrame() {
		return(eregi("chromeframe", $_SERVER['HTTP_USER_AGENT']));
	}
	
	function isFirefox() {
		return(eregi("Firefox", $_SERVER['HTTP_USER_AGENT']));
	}

?>
