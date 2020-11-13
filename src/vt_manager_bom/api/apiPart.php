<?php
// ==========================PART========================
// @return all part
function getListParts($rootHostApi, $id) {
    $url = $rootHostApi.'/part/getListParts?id='.$id;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// get list part relationshio of part (part bom)
function getListPartRelationShip($rootHostApi, $condition) {
    $url = $rootHostApi.'/part/getListPartRelationShip'.$condition;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// get list document of part
function getListDocumentOfPart($rootHostApi, $condition) {
    $url = $rootHostApi.'/part/getListDocumentOfPart'.$condition;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// get info part of model id
function getInfoPartByModelId($rootHostApi, $modId) {
    $url = $rootHostApi.'/part/getInfoPartByModelId?mod_id='.$modId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// add new part about info common
function addNewPart($rootHostApi, $jsonCond, $parttype) {
    $url = $rootHostApi.'/part/addNewPart';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonCond))                                                                       
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// API update part
function updatePart($rootHostApi, $partId, $jsonCond) {
    $url = $rootHostApi.'/part/updatePart/'.$partId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonCond))                                                                       
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// @check part number exist or not
function checkPartCode($rootHostApi, $partNumber) {
    $url = $rootHostApi.'/part/checkPartCode?part_number='.$partNumber;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// delete part
function deletePart($rootHostApi, $partId) {
    $json = '';
    $url = $rootHostApi.'/part/deletePart/'.$partId;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// return part number by id
function getPartNumberById($rootHostApi, $id) {
    $url = $rootHostApi.'/part/getPartNumberById?part_id='.$id;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}
// add new part relationship (part-bom, part alternate, part alm) 
function addPartRelationShip($rootHostApi, $partId, $type, $arrayId) {
    $url = $rootHostApi.'/part/addPartRelationShip/'.$partId.'/'.$type;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $arrayId);                                                             
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);         
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                    
        'Content-Type: application/json',
        'Content-Length: ' . strlen($arrayId))                                                                       
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// add part from file upload
function addPartFromFile($rootHostApi, $partId, $created_by_id, $contentFile) {
    $url = $rootHostApi.'/part/addPartFromFile/'.$partId.'/'.$created_by_id;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $contentFile);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',
        'Content-Length: ' . strlen($contentFile))                                                                       
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// get struct bom
function getStructBomById($rootHostApi, $partId) {
    $url = $rootHostApi.'/part/getStructBomById?part_id='.$partId;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// Clone part and +1 version
function clonePart($rootHostApi, $partId) {
    $url = $rootHostApi.'/part/updateVersionPart/'.$partId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");                                                         
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// delete relationship
function delPartRelationship($rootHostApi, $partId, $type, $jsonBody) {
    $url = $rootHostApi.'/part/deletePartRelationShip/'.$partId.'/'.$type;
    // echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonBody);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonBody))                                                                       
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// delete mutiple part
function delMutiplePart($rootHostApi, $jsonBody) {
    $url = $rootHostApi.'/part/deleteMultiPart';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonBody);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',
        'Content-Length: ' . strlen($jsonBody))                                                                       
    );
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
function getVersionPart($rootHostApi, $id) {
    $url = $rootHostApi.'/part/getVersionOfPart?part_id='.$id;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// API update part
function updateQuantity($rootHostApi, $partId,$parentId, $quantity) {
    $url = $rootHostApi.'/part/updateQuantity?part_id='.$partId.'&parentId='.$parentId.'&quantity='.$quantity;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json'));
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
function updateLocation($rootHostApi, $partId,$parentId, $location) {
    $url = $rootHostApi.'/part/updateLocation?part_id='.$partId.'&parentId='.$parentId.'&location='.$location;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json'));
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

?>