<?php
// @return getList
function getListManufacturer($rootHostApi, $depId) {
    $url = $rootHostApi.'/manufacturer/getListManufacturer?id='.$depId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return manufacturer name
function getManuNameById($rootHostApi, $manuId) {
    $url = $rootHostApi.'/manufacturer/getManuNameById?id='.$manuId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

function checkManuName($rootHostApi, $condition) {
    $url = $rootHostApi.'/manufacturer/checkManuName'.$condition;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// add new
function addNewManufacturer($rootHostApi, $jsonCond) {
    $url = $rootHostApi.'/manufacturer/addNewManufacturer';
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

// update information
function updateManufacturer($rootHostApi, $manuId, $jsonCond) {
    $url = $rootHostApi.'/manufacturer/updateManufacturer/'.$manuId;
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

// delete
function deleteManufacturer($rootHostApi, $manuId) {
    $url = $rootHostApi.'/manufacturer/deleteManufacturer/'.$manuId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_exec($curl);
    curl_close($curl);
    return ;
}

// get list part by manufacturer id
function getPartOfManu($rootHostApi, $manuId) {
    $url = $rootHostApi.'/part/getPartOfManu?manu_id='.$manuId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

?>