<?php
// @return getList
function getListVendor($rootHostApi, $vendorId) {
    $curl = curl_init();
    $url = $rootHostApi.'/vendor/getListVendor?id='.$vendorId;
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return $err;
    } 
    return $response; 
}

// @return vendor name
function getVendorNameById($rootHostApi, $vendorId) {
    $url = $rootHostApi.'/vendor/getVendorNameById?id='.$vendorId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

function checkVendorName($rootHostApi, $condition) {
    $url = $rootHostApi.'/vendor/checkVendorName'.$condition;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// add new
function addNewVendor($rootHostApi, $jsonCond) {
    $url = $rootHostApi.'/vendor/addNewVendor';
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
function updateVendor($rootHostApi, $vendorId, $jsonCond) {
    $url = $rootHostApi.'/vendor/updateVendor/'.$vendorId;
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
function deleteVendor($rootHostApi, $vendorId) {
    $jsonCond = '';
    $url = $rootHostApi.'/vendor/deleteVendor/'.$vendorId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_exec($curl);
    curl_close($curl);
    return ;
}

?>