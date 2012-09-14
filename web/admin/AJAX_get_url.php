<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

if(isset($_GET['queryString']) && $_GET['queryString'] != '')
{
	$res = \classes\model\MenuItem::updateOrder($_GET['queryString']);
}




getPageUrl($id, $lang)


$queryString	= ;
$limit			= isset($_GET['limit'])? $_GET['limit']:'-1';

$query = $db->query('SELECT SQL_CALC_FOUND_ROWS id, value FROM countries WHERE value LIKE "'.$queryString.'%"'.($limit>'0'? ' limit 0, '.$limit:''));
if($query) {
	// While there are results loop through them - fetching an Object (i like PHP5 btw!).
	
	$aRecordSet['nbResult'] = $db->query('SELECT FOUND_ROWS() nbResult;')->fetch_object()->nbResult;
	
	$aRecordSet['items'] = array();
	while ($result = $query->fetch_object())
		$aRecordSet['items'][] = $result->value;
	
	echo json_encode($aRecordSet);
}
?>