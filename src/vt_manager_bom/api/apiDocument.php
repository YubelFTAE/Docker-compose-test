<?php
// @return getList
function getListDocument($rootHostApi, $docId) {
    $url = $rootHostApi.'/document/getListDocument?id='.$docId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// @return name
function getDocNameById($rootHostApi, $docId) {
    $url = $rootHostApi.'/document/getDocNameById?id='.$docId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

function checkDocumentName($rootHostApi, $condition) {
    $url = $rootHostApi.'/document/checkDocumentName'.$condition;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// add new
function addNewDocument($rootHostApi, $jsonCond) {
    $url = $rootHostApi.'/document/addNewDocument';
    // echo $url;
    echo $jsonCond;
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
function updateDocument($rootHostApi, $docId, $jsonCond) {
    $url = $rootHostApi.'/document/updateDocment/'.$docId;
    // echo $url;
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
function deleteDocument($rootHostApi, $docId) {
    $jsonCond = '';
    $url = $rootHostApi.'/document/deleteDocument/'.$docId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// get list file by document id
function getFileOfDocument($rootHostApi, $docId) {
    $url = $rootHostApi.'/document/getFileOfDocument?id='.$docId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

?>