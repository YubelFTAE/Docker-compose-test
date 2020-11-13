<?php
require_once("../../api/apiPart.php");
require_once("../../includes/vt-config.php");

if (isset($_POST['cmd_save'])) {
	$cdate = date('Y-m-d H:i:s');
	$cdate = str_replace(' ', 'T', $cdate).'.000+0000';
	$effectiveDate =  date('Y-m-d H:i:s', strtotime($_POST['txt_effective_date']));
	$effectiveDate = str_replace(' ', 'T', $effectiveDate).'.000+0000';
	$releaseDate =  date('Y-m-d H:i:s', strtotime($_POST['txt_release_date']));
	$releaseDate = str_replace(' ', 'T', $releaseDate).'.000+0000';
	$partId = $_POST['txt_part_id'];

	$jsonPost = array(
		"item_number" => $_POST['txt_part_number'],
		"vietelCode" => $_POST['txt_viettel_code'],
		"name" => $_POST['txt_part_name'],
		"description" => $_POST['txt_description'],
		"category" => $_POST['txt_category'],
		"manufacturer_id" => $_POST['cbo_manufacturer'],
		"vendorId" => $_POST['cbo_vendor'],
		"number_manufacturer_res" => 0,
		"lead_time" => null,
		"classification" => $_POST['cbo_type'],
		"active" => $_POST['cbo_status'],
		"state" => $_POST['cbo_state'],
		"current_state" => "current_state",
		"version" => $_POST['txt_version'],
		"cost" => $_POST['txt_price'],
		"make_by" => $_POST['cbo_makebuy'],
		"unit" =>  $_POST['cbo_unit'],
		"weight" => $_POST['txt_weight'],
		"thumbnail" => null,
		"created_by_id" => $_POST['txt_created_by_id'],
		"modified_by_id" => $_POST['txt_modified_id'],
		"modified_on" => $cdate,
		"locked_by_id" => null,
		"not_lockable" => true,
		"generation" => null,
		"release_date" => $releaseDate,
		"effective_date" => $effectiveDate,
		"is_released" => true,
		"is_current" => true,
		"major_rev" => null,
		"has_change_pending" => true,
		"permission_id" => null,
		"external_type" => $_POST['txt_external_type'],
		"quantity" => $_POST['txt_quantity'],
		"sort_order" => 0,
		"reference_designator" => null
	);
	echo json_encode($jsonPost, JSON_UNESCAPED_UNICODE);
	// call api add new part
	updatePart(HOST_API, $partId, json_encode($jsonPost, JSON_UNESCAPED_UNICODE));
}

