<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
// include config
define('incl_path','includes/');
define('libs_path','libs/');
define('api_path','api/');

require_once(incl_path.'simple_html_dom.php');
require_once(incl_path.'vt-config.php');
require_once(incl_path.'vt-function.php');
require_once(libs_path.'cls.template.php');
require_once(api_path.'apiCommon.php');
require_once(api_path.'apiPart.php');
require_once(api_path.'apiModel.php');
require_once(api_path.'apiProduct.php');
require_once(api_path.'apiManufacturer.php');
require_once(api_path.'apiVendor.php');
require_once(api_path.'apiDocument.php');
require_once(api_path.'apiFile.php');

$tmp = new CLS_TEMPLATE();
$tmp_name = $tmp->loadDefaultTemplate();
$this_tem_path = TEM_PATH.$tmp_name.'/';
define('ISHOME',true);
define('THIS_TEM_PATH',$this_tem_path);
$tmp->wapperTemplate();

?>
