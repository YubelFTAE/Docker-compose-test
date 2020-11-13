<?php
require_once("../api/apiProduct.php");
require_once("../api/apiModel.php");
require_once("../includes/vt-config.php");
$action = "";

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	// action lock or unlock product
	if ($action == 'lock_or_unlock') {
		$proId = $_POST['pro_id'];
		$lockVal = $_POST['lock_val'];
		if ($lockVal == 1) $lockVal = 0;
    	else $lockVal = 1;
		updateStateLock(HOST_API, $proId, $lockVal);
	
	// action delete product
	} else if ($action == 'delete') {
		$proId = $_POST['pro_id'];
		deleteProduct(HOST_API, $proId);
	
	// action change part of model product
	} else if ($action == 'change_part') {
		$modelId = $_POST['model_id'];
		$partId = $_POST['part_id'];
		// call api change part of model
		changePartOfModel(HOST_API, $modelId, $partId);
	
	} else {

	}
}
?>