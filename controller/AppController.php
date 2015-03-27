<?php

class AppController {

	public $route = array();
	public $viewVars = array();
	public $isAdmin = false;
	public $bandsDAO;

	public function __construct() {
		require_once WWW_ROOT . 'dao' . DS . 'BandsDAO.php';
		$this -> bandsDAO = new BandsDAO();
	}

	public function filter() {
		$this->checkLogout();
		$this->checkIsAdmin();
		call_user_func(array($this, $this->route['action']));
	}

	public function checkLogout() {
		if(!empty($_GET['action']) && strtolower($_GET['action']) == 'logout') {
	        unset($_SESSION['bandUser']);
	        $this->redirect('index.php?p=app');
	    }
	}

	public function checkIsAdmin() {
		$isAdmin = false;

		if(!empty($_SESSION['bandUser']) && $_SESSION['bandUser']['role_id'] == 2) {
			$isAdmin = true;
		}

		$this->set('isAdmin', $isAdmin);
		return $isAdmin;
	}

	public function render() {
		extract($this->viewVars, EXTR_OVERWRITE);

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			require WWW_ROOT . 'pages/' . strtolower($this->route['controller']) . '/' . $this->route['action'] . '.php';
		}else{
			require WWW_ROOT . 'parts/header.php';
		    require WWW_ROOT . 'parts/errors.php';
		    require WWW_ROOT . 'pages/' . strtolower($this->route['controller']) . '/' . $this->route['action'] . '.php';
		    require WWW_ROOT . 'parts/footer.php';
		}
	    unset($_SESSION['errors']);
	}

	public function set($variableName, $value) {
		$this->viewVars[$variableName] = $value;
	}

	public function addError($index, $error){
		if(!isset($_SESSION['errors'])) {
			$_SESSION['errors'] = array();
		}
		$_SESSION['errors'][$index] = $error;
	}

	// Check if the loginRequirement is the only error
	public function checkErrors(){
		if(empty($_SESSION['errors'])){
			return false;
		}elseif(count($_SESSION['errors']) <= 1 && !empty($_SESSION['errors']['loginReq'])){
			return false;
		}
		return true;
	}

	public function checkError($error){
		if(empty($_SESSION['errors'][$error])){
			return false;
		}
		return true;
	}

	public function redirect($url) {
		header("Location: {$url}");
		exit();
	}

}