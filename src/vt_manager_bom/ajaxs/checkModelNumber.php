<?php
require_once("../api/apiModel.php");
require_once("../includes/vt-config.php");
$proNumber = "";
if (isset($_POST['mod_number'])) {
	$modNumber = $_POST['mod_number'];
	$condition = "?moder=".$modNumber;
	$resp = checkModelCode(HOST_API, $condition);
	echo $resp;
}
?>