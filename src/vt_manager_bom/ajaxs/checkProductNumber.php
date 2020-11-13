<?php
require_once("../api/apiProduct.php");
require_once("../includes/vt-config.php");
$proNumber = "";
if (isset($_POST['pro_number'])) {
	$proNumber = $_POST['pro_number'];
	$condition = "?pro_number=".$proNumber;
	$resp = checkProductNumber(HOST_API, $condition);
	echo $resp;
}
?>