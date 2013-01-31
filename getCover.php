<?php
require_once('moreInfo.class.php');

$cover_fetch = new moreInfo();

$body = array(
		"authentication" => array(
				"authenticationUser" => "netpunkt",
				"authenticationGroup" => "Biblioteksnummer",
				"authenticationPassword" => "kodeord"
		),
		"identifier" => array(
				"faust" => "26775639"
		)
);

print_r($cover_fetch->moreInfo($body));

?>
