<?php
/* moreInfo class:
 * creates a SoapClient of a WSDL (Web services Description language)
 * usage: 
 * $newClass = new moreInfo();
 * $newClass->getMoreInfo($body);
 */
class moreInfo {
	var $soapUrl = 'http://moreinfo.addi.dk/2.1/moreinfo.wsdl';
	//Constructor
	function __construct()
	{
		$this->client = new SoapClient($this->soapUrl);
	}
	//Destructor
	function __destruct()
	{
		unset ($this->client);
	}
	//Get method
	function getMoreInfo($body){
		try {
			$result = $this->client->moreInfo($body);
		} catch ( Exception $e ) {
			echo '(moreInfo) SOAP Error: - ' . $e->getMessage ();
		}
		return $result;
	}
}
?>
