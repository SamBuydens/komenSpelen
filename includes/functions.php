<?php

	function trace($var){
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

	function get_base_root(){
		$local_root = "http://localhost:1124/thorr.stevens/20142015/KomenSpelen/";
		$live_root = "http://student.howest.be/thorr.stevens/20142015/MA4/KOMEN/";

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

	function addImage($image, $imgRoot){
		$targetfile = $imgRoot.'img/images/'.$image['name'];
		$thumbfile = $imgRoot.'img/images/thumbs/'.$image['name'];
		$pos = strrpos($targetfile, '.');
		$fileName = substr($targetfile, 0, $pos);
		$thumbName = substr($thumbfile, 0, $pos);
		$ext = substr($targetfile, $pos + 1);

		$i = 0;
		while(file_exists($targetfile)){
			$i++;
			$targetfile = $fileName.$i.'.'.$ext;
			$thumbfile = $thumbName.$i.'.'.$ext;
		}

		if($image['width'] <= $image['height']){
			$ratio = $image['height'] / $image['width'];
			$nWidth = 100;
			$nHeight = 100 * $ratio;
		}else{
			$ratio = $image['width'] / $image['height'];
			$nWidth = 100 * $ratio;
			$nHeight = 100;
		}

		$new_thumb = imagecreatetruecolor($nWidth, $nHeight);
		if($image['type'] == 'image/jpeg'){
			$thumb = imagecreatefromjpeg($image['tmp_name']);
			imagecopyresampled($new_thumb, $thumb, 0, 0, 0, 0, $nWidth, $nHeight, $image['width'], $image['height']);
			imagejpeg($new_thumb, $thumbfile, 90);
		}else{
			$thumb = imagecreatefrompng($image['tmp_name']);
			imagecopyresampled($new_thumb, $thumb, 0, 0, 0, 0, $nWidth, $nHeight, $image['width'], $image['height']);
			imagepng($new_thumb, $thumbfile);
		}
		move_uploaded_file($image['tmp_name'], $targetfile);

		$image['name'] = basename($targetfile);

		return $image;
	}

?>