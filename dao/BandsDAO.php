<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';

class BandsDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    /* --- Getters ------------------------------------------- */

    public function getBandById($id){
        $sql = "SELECT *
                FROM `kmn_bands`
                WHERE `id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $band = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($band)){
                return $band;
            }
        }
        return array();
    }

    public function getBands(){
        $sql = "SELECT *
                FROM `kmn_bands`";
        $qry = $this->pdo->prepare($sql);

        if($qry->execute()){
            $bands = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($bands)){
                return $bands;
            }
        }
        return array();
    }

    /* --- Login ------------------------------------------- */

    public function login($entry, $password){
        return $this -> getBandByLoginData($entry, $password);
    }

    public function getBandByLoginData($entry, $password){
        $sql = "SELECT * 
                FROM `kmn_bands` 
                WHERE (email = :entry1
                OR bandname = :entry2)
                AND password = :password";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':entry1', $entry);
        $qry -> bindValue(':entry2', $entry);
        $qry -> bindValue(':password', sha1(CONFIG::SALT.$password));

        if($qry->execute()){
            $band = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($band)){
                return $band;
            }
        }
        return array();
    }

    /* --- Register ------------------------------------------- */

    public function register($bandname, $email, $password, $band_image){
        return $this->insertUser($bandname, $email, $password, $band_image);
    }

    public function insertUser($bandname, $email, $password, $band_image){
        $sql = "INSERT INTO kmn_bands(bandname, email, password, role_id, band_image)
                VALUES(:bandname, :email, :password, :role_id, :band_image)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':email', $email);
        $qry -> bindValue(':bandname', htmlentities(strip_tags($bandname)));
        $qry -> bindValue(':password', sha1(CONFIG::SALT.$password));
        $qry -> bindValue(':band_image', $band_image);

        if($qry->execute()){
            return $this -> getBandById($this->pdo->lastInsertId());
        }
        return array();
    }

    /* --- Update / Edit ------------------------------------------- */

    public function updateBand($id, $bandname, $email, $band_image){
    	$sql = "UPDATE `komen`.`kmn_bands` 
    			SET `bandname` = :bandname, `email` = :email, `band_image` = :band_image 
    			WHERE `kmn_bands`.`id` = :id";
    	$qry = $this->pdo->prepare($sql);
    	$qry -> bindValue(':id', $id);
        $qry -> bindValue(':email', $email);
        $qry -> bindValue(':bandname', htmlentities(strip_tags($bandname)));
        $qry -> bindValue(':band_image', $band_image);

        if($qry->execute()){
            return $this -> getBandById($this->pdo->lastInsertId());
        }
        return array();
    }

    /* --- Delete ------------------------------------------- */

    public function deleteBand($id){
    	$sql = "DELETE FROM `komen`.`kmn_bands` 
    			WHERE `kmn_bands`.`id` = :id";
    	$qry = $this->pdo->prepare($sql);
    	$qry -> bindValue(':id', $id);

    	$deletedBand = $this -> getBandById($id);
    	if(!empty($deletedBand)){
    		if($qry->execute()){
        	    return $deletedBand;
        	}
    	}
    	return array();

    }

}