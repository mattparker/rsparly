<?php

$page = file_get_contents("http://www.parliament.uk/business/publications/research/briefing-papers/", "r");

$doc = new DOMDocument();
// A corrupt HTML string
$doc->loadHTML($page);

$root = $doc->getElementById("paper-listing");

if (!$root) {
	echo "Root el not found";
	exit;
}
$lis = $root->childNodes;
$numList = $lis->length;
$i = 0;

for ($i= 0; $i < $numList; $i++) {

	$research = $lis->item($i);

	$data = $research->childNodes;
	$numDataChildren = $data->length

	for ($j = 0; $j < $numDataChildren; $j++) {

		echo ' found node ' . $data->item($j)->nodeName . ' with value ' . $data->item($j)->nodeValue . '</br>';
	}
}



