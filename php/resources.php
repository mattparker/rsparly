<?php
require_once 'class/ParliamentaryResources';


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
			echo json_encode($end);
			break;

	}
}

