<?php
require_once("../api/apiCommon.php");
require_once("../api/apiManufacturer.php");
require_once("../api/apiVendor.php");
require_once("../api/apiDocument.php");
require_once("../includes/vt-config.php");
$proNumber = "";
if (isset($_POST['field'])) {
    $value = trim($_POST['value']); 
    if ($_POST['field'] === 'department_name') {
        $condition = "?name=".$value.'&code';
        $resp = checkDepartmentName(HOST_API, $condition);

    } else if ($_POST['field'] === 'group_name') {
        $condition = "?name=".$value;
        $resp = checkGroupName(HOST_API, $condition);

    } else if ($_POST['field'] === 'txt_manu_name') {
        $condition = "?name=".$value;
        $resp = checkManuName(HOST_API, $condition);

    } else if ($_POST['field'] === 'vendor_name') {
        $condition = "?name=".$value;
        $resp = checkVendorName(HOST_API, $condition);

    } else if ($_POST['field'] === 'document_name') {
        $condition = "?name=".$value;
        $resp = checkDocumentName(HOST_API, $condition);
        
    }

    echo $resp;
}
?>