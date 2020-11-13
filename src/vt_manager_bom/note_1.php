<?php
function generatePartBom($objData, $resp) {
	foreach($objData as $k => $val) {
		$resp="bachtx->";
		if (count($val->children) > 0) {
			generatePartBom($val->children, $resp);
		}
	}
}
$data = '[{
            "name": "level1", 
            "children": [
                {"name": "level2", "children": [
                    {"name": "level3", "children": []}    
                ]}
            ]
        }]';
        
$data = json_decode($data);
$tmp = array();
$res = generatePartBom($data, $resp="");
array_push($tmp, $res);
var_dump($tmp);
?>