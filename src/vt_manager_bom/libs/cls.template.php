 <?php
class CLS_TEMPLATE{
	private $objmysql = null;

	public function CLS_TEMPLATE(){
	}
	public function loadDefaultTemplate() { 
		return 'default';
	}
	public function wapperTemplate() {
		if($this->error()) return;
		require_once(THIS_TEM_PATH.'home.php');
	}
	private function error() {
		if(!is_file(THIS_TEM_PATH."home.php")){
			echo 'home.php is not exist';
			return false;
		}
	}
	public function loadComponent() {
		$com='';
		if(isset($_GET['com']))	$com=addslashes($_GET['com']);
		if(!is_dir(COM_PATH.'com_'.$com))
			$com='frontpage';
		include(COM_PATH.'com_'.$com.'/layout.php');
	}
}
?>