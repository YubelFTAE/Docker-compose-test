<?php
require_once("../../api/apiDocument.php");
require_once("../../api/apiFile.php");
require_once("../../includes/vt-config.php");
$action = "";

if (isset($_POST['action'])) {
	$action = $_POST['action'];
	if ($action == 'delete_file') {
		$fileId = $_POST['file_id'];
		deleteFile(HOST_API, $fileId);
	} 
	else if ($action == 'delete_doc') {
		$docId = $_POST['doc_id'];
		$resp = deleteDocument(HOST_API, $docId);
		echo $resp;
	}
	else if ($action == 'delete_file_of_part') {
		$partId = $_POST['part_id'];
		$strids = substr($_POST['strids'], 0, strlen($_POST['strids'])-1);
		deleteFileOfPart(HOST_API, $partId.'?fileIds='.$strids);
	}
}
?>