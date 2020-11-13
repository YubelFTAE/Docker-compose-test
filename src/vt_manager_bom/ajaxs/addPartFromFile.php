<?php
require_once("../api/apiPart.php");
require_once("../includes/vt-config.php");

$partId = $_POST['part_id'];
$created_by_id = $_POST['created_by_id'];
$relationship = $_POST['txt_relationship'];

// ----------------UPLOAD FILE PART -----------------

$valid_formats = array("csv","xls","xlsx");
$max_file_size = 1024*10000000000; 
$path = "../uploads/file/";
$strFile = "";

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
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
	            	$strFile.=$path.$name."#";
	            }
	        }
	    }
	}
	$link = "../uploads/file/".$name;
	// get content file post to api
	$contentFile = base64_encode(file_get_contents($link));

	// call api add part from file
    addPartFromFile(HOST_API, $partId, $created_by_id, $contentFile);
	
} else {
	echo "failed";
}
?>