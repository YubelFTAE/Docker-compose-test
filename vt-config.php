<?php
define('ROOTHOST','http://'.$_SERVER['HTTP_HOST'].'/');
define('WEBSITE','http://'.$_SERVER['HTTP_HOST'].'/');
define('ROOT_PATH',''); 
define('TEM_PATH',ROOT_PATH.'templates/');
define('COM_PATH',ROOT_PATH.'components/');
define('DAT_PATH',ROOT_PATH.'databases/');
define('ASSETS_PATH',ROOT_PATH.'assets/');
define('LIB_PATH',ROOT_PATH.'libs/');
define('LOG_PATH',ROOT_PATH.'logs/');

// Defined host call API
define('HOST_API', '192.168.203.139:8080');

define('HOST_API_DU', '192.168.203.139:8080');

//  Defined type part
define('PART_BOM', 0);
define('PART_ALTERNATE', 1);
define('PART_BUY', 2);

// Defined commom available
define('PRO_UNLOCK', 0);
define('PRO_LOCK', 1);

?>
