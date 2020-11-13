<?php
require_once("../api/apiCommon.php");
require_once("../includes/vt-config.php");
$proNumber = "";
if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$condition = "?username=".$username;
	$resp = checkExistAccount(HOST_API, $condition);
	echo $resp;
}
?>