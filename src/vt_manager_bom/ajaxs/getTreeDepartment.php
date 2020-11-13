<?php
require_once("../api/apiCommon.php");
require_once("../includes/vt-config.php");
// get tree department
$lstTreeDep = getTreeDepartment(HOST_API);
echo $lstTreeDep;
?>