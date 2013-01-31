<?php
/* getImage.php
 *  usage example:
*  getImage.php?faust=29558264
*/

//require moreInfo class
require_once('moreInfo.class.php');

if(isset($_GET['faust'])){
	//Create a new instance of the moreInfo class
	$img_fetch = new moreInfo();

	//The request body as specified in the XML schema definition.
	$body = array(
			//Authenticiation for the web service
			"authentication" => array(
					"authenticationUser" => "netpunkt",
					"authenticationGroup" => "761500",
					"authenticationPassword" => "svitrudri"
			),
			//The identifier for a specific image
			//Identifiers: 
			//"faust", "isbn", array("localIdentifier" => X, "libraryCode" => Y)
			"identifier" => array(
					"faust" => $_GET['faust']
			)
	);
	//Result
	if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "ok"){
		if($img_fetch->getMoreInfo($body)->identifierInformation->identifierKnown == 1){
			header('Content-Type: image/jpeg');
			readfile($img_fetch->getMoreInfo($body)->identifierInformation->coverImage[4]->_);
		}
		//Error handling
		else {
			echo "Error, identifier not found.";
		}
	}
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "service_unavailable"){
		echo "Error, Service unavailble";
	}
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "error_in_request"){
		echo "Error in request";
	}
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "authentication_error"){
		echo "Error, Authentication error";
	}
}
else {
	echo "Error, no faust specified.";
}
?>