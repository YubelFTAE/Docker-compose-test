<?php
// ==========================MODEL========================
// get all model
function getListModel($rootHostApi, $id) {
    $url = $rootHostApi.'/model/getListModel?id='.$id;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// add new model
function addNewModel($rootHostApi, $jsonCond) {
    $url = $rootHostApi.'/model/addNewModel';
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

// change part of model
function changePartOfModel($rootHostApi, $modelId, $partId) {
    $url = $rootHostApi.'/model/changePartOfModel/'.$modelId.'/'.$partId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");                                                           
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json')                                                                       
    );                                                                                                                   
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

function deleteModel($rootHostApi, $modId) {
    $url = $rootHostApi.'/model/deleteModel/'.$modId;
    echo $url;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// check model code
function checkModelCode($rootHostApi, $condition) {
    $url = $rootHostApi.'/model/checkModelCode'.$condition;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// get list model by proid
function getListModelByProId($rootHostApi, $proId) {
    $url = $rootHostApi.'/model/getListModelByProId?pro_id='.$proId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;   
}

// update info model
function updateInfoModel($rootHostApi, $modelId, $jsonBody) {
    $url = $rootHostApi.'/model/updateInfoModel/'.$modelId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
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

?>