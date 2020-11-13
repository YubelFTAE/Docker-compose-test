<?php
require_once("../api/apiPart.php");
require_once("../api/apiFile.php");
require_once("../includes/vt-config.php");
$action = "";

if (isset($_POST['action'])) {
	$action = isset($_POST['action']) ? $_POST['action'] : '';
	$partId = isset($_POST['part_id']) ? $_POST['part_id'] : '';

	if ($action == 'delete') {
		deletePart(HOST_API, $partId);

	} else if ($action == 'check_part_number') {
		$partNumber = isset($_POST['part_number']) ? $_POST['part_number'] : '';
		$resp = checkPartCode(HOST_API, $partNumber);
		if($resp == 'true') {
			echo 'exist';
		} else {
			echo 'not_exist';
		}

	} else if ($action == 'add_part') {
		$relationship = isset($_POST['relationship']) ? $_POST['relationship'] : '';

		// strs ids part
		$strids =  substr($_POST['part_selected'], 0, strlen($_POST['part_selected'])-1);
		$arrPartIds = explode(',', $strids);
		
		// add part
		addPartRelationShip(HOST_API, $partId, $relationship, json_encode($arrPartIds, JSON_UNESCAPED_UNICODE));

	}  else if ($action == 'add_file_for_part') {
		$strids =  substr($_POST['file_selected'], 0, strlen($_POST['file_selected'])-1);
		$arrFileIds = explode(',', $strids);
		$jsonBody = array(
			"type" => 0,
			"partId" =>  $partId,
			"fileIds" => $arrFileIds
		);
		addFileForPart(HOST_API, json_encode($jsonBody, JSON_UNESCAPED_UNICODE));

	}  else if ($action == 'clone_part') {
		// call api clone and +1 version part
		clonePart(HOST_API, $partId);

	} else if ($action == 'update_quantity') {
		updateQuantity(HOST_API, $_POST['part_id'],$_POST['parent_id'], $_POST['quantity']);

	} else if ($action == 'update_location') {
		updateLocation(HOST_API, $_POST['part_id'],$_POST['parent_id'], $_POST['location']);

	}
	 else if ($action == 'del_part_relationshop') {
		$type = $_POST['type'];
		$strids =  substr($_POST['part_selected'], 0, strlen($_POST['part_selected'])-1);
		$arrFileIds = explode(',', $strids);		
		delPartRelationship(HOST_API, $partId, $type, json_encode($arrFileIds, JSON_UNESCAPED_UNICODE));
	} else if ($action == 'del_mutiple_part') {
		$strids =  substr($_POST['part_selected'], 0, strlen($_POST['part_selected'])-1);
		$arrFileIds = explode(',', $strids);
		delMutiplePart(HOST_API, json_encode($arrFileIds, JSON_UNESCAPED_UNICODE));
	} 
}
?>