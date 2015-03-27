<?php
require_once WWW_ROOT . 'controller' . DS . 'AppController.php';

class BandsController extends AppController {

	public function __construct()
	{
		require_once WWW_ROOT . 'dao' . DS . 'BandsDAO.php';
		$this -> bandsDAO = new BandsDAO();

		require_once WWW_ROOT . 'dao' . DS . 'AdminDAO.php';
		$this -> adminDAO = new AdminDAO();
	}

	public function app() {

		if(empty($_SESSION['bandUser'])){
			//$this -> addError('loginReq', "Please log in to access app");
			$this -> redirect("index.php?p=login");
		}

	}

	public function logout() {

		if(!empty($_SESSION['bandUser'])){
			unset($_SESSION['bandUser']);
		}

	}

	public function login() {

		if(!empty($_SESSION['bandUser'])){
			unset($_SESSION['bandUser']);
		}
		
		if(!empty($_POST)){

			if(empty($_POST['login'])){
				$this -> addError('login', "Please fill in your bandname or email");
			}

			if(empty($_POST['password'])){
				$this -> addError('password', "Please fill in your password");
			}

			if($this -> checkErrors() == false){
				$user = $this -> bandsDAO -> login($_POST['login'], $_POST['password']);
				if(!empty($user)){
					$_SESSION['bandUser'] = $user;
					unset($_SESSION['errors']['loginReq']);
					$this -> redirect("index.php?p=app");
					exit();
				}else{
					$this -> addError('password', "Unknown user / password combination");
					//$this -> redirect("index.php?p=login");
				}
			}

		}

	}

	public function register() {

		if(!empty($_GET['invite'])){
			$_SESSION['invite'] = $_GET['invite'];
		}

		if(empty($_SESSION['invite'])){
			$this -> addError('loginReq', "Register is invite only");
			$this -> redirect("index.php?p=login");
			exit();
		}else{
			$validInvite = $this -> adminDAO -> getInviteByCode($_SESSION['invite']);

			if(!empty($validInvite)){
				if(!empty($_POST)){
					$_SESSION['errors'] = $this -> bandsDAO -> validateBandData($_POST);

					if(empty($_POST['password'])){
						$this -> addError('password', "Please fill in your desired password.");
					}elseif(strlen($_POST['password']) < 8 || strlen($_POST['password']) > 64){
						$this -> addError('password', "Passwords should be 8 to 64 characters.");
					}elseif(empty($_POST['repeat_pass']) || $_POST['password'] != $_POST['repeat_pass']){
						$this -> addError('repeat_pass', "Passwords did not match.");
					}

					$_POST['band_image'] = "band.png"; //basename($targetfile);

					if($this -> checkErrors() == false){
		 				$user = $this -> usersDAO -> register($_POST);

				        if(!empty($user)){
				            $_SESSION["bandUser"] = $user;
				            $this -> redirect("index.php?p=app");
				        }
					}
				}
			}else{
				$this -> addError('loginReq', "Invalid invitation code");
				$this -> redirect("index.php?p=login");
				exit();
			}
		}
	}

}