<?php

	function trace($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	/*function addError($error){
		if(!isset($_SESSION["errors"])) {
			$_SESSION["errors"] = array();
		}
		$_SESSION["errors"][] = $error;
	}*/

	function get_base_root(){
		$local_root = "http://localhost:1124/thorr.stevens/20142015/KomenSpelen/";
		$live_root = "http://student.howest.be/thorr.stevens/20142015/MAIV/KOMEN/";

		if(in_array($_SERVER["SERVER_ADDR"], array("127.0.0.1", "::1", "192.168.75.121", "fe80::21c:42ff:fe00:8"))){
		    $root = $local_root;
		}else{
			$root = $live_root;
		}

		return $root;
	}

	function checkIsAdmin(){
		$isAdmin = false;
		if(!empty($_SESSION['bandUser']) && $_SESSION['bandUser']['role_id'] == 2) {
			$isAdmin = true;
		}
		return $isAdmin;
	}

	/*function redirect($url) {
		header("Location: {$url}");
		exit();
	}*/

?>