<?php
// @return getList
function getListfile($rootHostApi, $fileId) {
    $url = $rootHostApi.'/file/getListFile?id='.$fileId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

//  get list file by part id
function getListFileByPartId($rootHostApi, $cond) {
    $url = $rootHostApi.'/file/getListFileByPartId'.$cond;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; 
}

// add new
function addNewFile($rootHostApi, $jsonCond) {
    $url = $rootHostApi.'/file/addNewFile';
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

function addFileForPart($rootHostApi, $jsonCond) {
    $url = $rootHostApi.'/file/addFileForPart';
    echo $url;
    echo $jsonCond;
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

// update information
function updateFile($rootHostApi, $fileId, $jsonCond) {
    $url = $rootHostApi.'/file/updateFile/'.$fileId;
    echo $url;
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
function deleteFile($rootHostApi, $fileId) {
    $jsonCond = '';
    $url = $rootHostApi.'/file/deleteFile/'.$fileId;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");                                                                     
    curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonCond);                                                                  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_exec($curl);
    curl_close($curl);
    return ;
}
// delete file of part one or more files
function deleteFileOfPart($rootHostApi, $str) {
    $url = $rootHostApi.'/file/deleteFileOfPart/'.$str;
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

?>