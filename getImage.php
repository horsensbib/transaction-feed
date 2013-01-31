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
					"authenticationGroup" => "biblioteksnummer",
					"authenticationPassword" => "kodeord"
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
=======
<?php
/* getImage.php
 *  usage example:
*  getImage.php?faust=29558264
*/

//require moreInfo class
require_once('moreInfo.class.php');

//site root + image folder.
$path = $_SERVER['DOCUMENT_ROOT'] . '/feed/img/';
//Default image, returns upon error.
$img_default = 'default.jpg';

if(isset($_GET['faust'])){
	//Create a new instance of the moreInfo class
	$img_fetch = new moreInfo();

	//Image file variable.
	$img_file = $_GET['faust'] . ".jpg";

	//The request body as specified in the XML schema definition.
	$body = array(
			//Authenticiation for the web service
			"authentication" => array(
					"authenticationUser" => "netpunkt",
					"authenticationGroup" => "biblioteksnummer",
					"authenticationPassword" => "kodeord"
			),
			//The identifier for a specific image
			//Identifiers:
			//"faust", "isbn", array("localIdentifier" => X, "libraryCode" => Y)
			"identifier" => array(
					"faust" => $_GET['faust']
			)
	);
	//Result
	//Check if image is already cached, if so return from folder.
	if(file_exists($path . $img_file)){
		header('Content-Type: image/jpeg');
		readfile($path . $img_file);
	}
	//Else fetch image from webservice.
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "ok"){
		if($img_fetch->getMoreInfo($body)->identifierInformation->identifierKnown == 1){
			//Set MIME type to image/jpeg
			header('Content-Type: image/jpeg');
			//Read and print image
			readfile($img_fetch->getMoreInfo($body)->identifierInformation->coverImage[4]->_);
			//Cache images
			file_put_contents($path . $img_file, file_get_contents($img_fetch->getMoreInfo($body)->identifierInformation->coverImage[4]->_));
		}
		//Error handling
		else {
			header('Content-Type: image/jpeg');
			readfile($path . $img_default);
			//echo "Error, identifier not found.";
		}
	}
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "service_unavailable"){
		header('Content-Type: image/jpeg');
		readfile($path . $img_default);
		//echo "Error, Service unavailble";
	}
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "error_in_request"){
		header('Content-Type: image/jpeg');
		readfile($path . $img_default);
		//echo "Error in request";
	}
	else if($img_fetch->getMoreInfo($body)->requestStatus->statusEnum == "authentication_error"){
		header('Content-Type: image/jpeg');
		readfile($path . $img_default);
		//echo "Error, Authentication error";
	}
}
else {
	header('Content-Type: image/jpeg');
	readfile($path . $img_default);
	//echo "Error, no faust specified.";
}
?>
