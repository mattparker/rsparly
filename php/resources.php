<?php
/**
 *
 * Webservice for searching parliamentary resources we've scraped from the website.
 *
 * do something like:
 *
 * /resources.php?q=youth,services&format=json&callback=myCrazyFunction
 *
 * q		Comma-separated list of search terms
 * format       (optional) String: json only at the mo
 * callback     (optional) Name of callback function that will wrap the data
 *
 * and you should get a json pile of data.  It'll look something like:
 *
 * { 
 *   results: [
 * 	{id: 123, title:"bill title", type: "bill", summary: "this is what it is about"},
 *	{id: 456, title:"another bill", type: "bill", summary: "another important one"}
 *   ],
 *   meta: {
 *   	numResults: 2
 *   }
 * }
 *
 *
 */



require_once 'class/ParliamentaryResources.php';
require_once 'inc/db.inc.php';


$params = $_GET['q'];

// Class does the db search
$res = new ParliamentaryResources($params);
// and returns an array
$ret = $res->search();

if ($ret && count($ret) > 0) {

	$end = array(
		'results' => $ret,
		'meta' => array(
			'numResults' => count($ret)
		)
	);

} else {

	$end = array(
		'results' => false
	);

}

if (!array_key_exists('format', $_GET)) {

	$format = 'json';

} else {

	$format = $_GET['format'];

}

	switch ($format) {

		case 'json':
		default:
			if (array_key_exists('callback', $_GET)) {
				echo $_GET['callback'] . '(';
			}
			
			echo json_encode($end);
			
			if (array_key_exists('callback', $_GET)) {
				echo ');';
			}
			break;

	}


