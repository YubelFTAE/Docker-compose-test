<?php
require_once("../api/apiFile.php");
require_once("../includes/vt-config.php");
$partId = $_POST['part_id'];
$docId = $_POST['cbo_document'];
$createdById = $_POST['created_by_id'];

// ----------------UPLOAD FILE PART -----------------

$valid_formats = array("csv","xls","xlsx","doc", "docx", "pdf", "txt");
$max_file_size = 1024*10000000000; 
$path = "../uploads/documentFile/";
$arrFile = array();
$arrDataFiles = array();

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to execute all files
	$name = '';
	foreach ($_FILES['files']['name'] as $f => $name) { 
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name is too large!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name is not a valid format";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name)) {
					$obj = array(
						"name" => $name,
						"size" => $_FILES['files']['size'][$f],
						"link" => "uploads/documentFile/".$name
					);
					array_push($arrFile, $obj);
	            }
	        }
	    }
	}

	// add file to array()
	foreach($arrFile as $key  => $item) {
		$obj = array(
			"fileName" => $item['name'],
			"fileSize" => $item['size'],
			"filePath" => $item['link'],
			"createdById" => $createdById
		);
		array_push($arrDataFiles, $obj);
	}

	// json post data
	$jsonBody = array(
		"type" => 1,
		"partId" => $partId,
		"documentId" => $docId,
		"fileIds" => array(),
		"files" => $arrDataFiles
	);

	// call api add file from computer
	addFileForPart(HOST_API, json_encode($jsonBody, JSON_UNESCAPED_UNICODE));
	
} else {
	echo "failed";
}
?>