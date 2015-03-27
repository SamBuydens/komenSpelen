<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';
require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandsDAO.php';

class BandsDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    /* --- Getters ------------------------------------------- */

    public function getBandById($id){
        $sql = "SELECT bandname, email, band_image, role_id
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
        $sql = "SELECT bandname, email, band_image
                FROM `kmn_bands` 
                WHERE role_id = 1";
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
        $sql = "SELECT id, bandname, email, band_image, role_id 
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

    /* --- Setters & Validation ------------------------------------------- */

    public function register($postData){
        $errors = $this -> validateBandData($postData);
        if(empty($errors)){
            return $this->insertBand($postData['bandname'], $postData['email'], $postData['password'], $postData['band_image']);
        }
        return array();
    }

    public function insertBand($bandname, $email, $password, $band_image){
        $sql = "INSERT INTO kmn_bands(bandname, email, password, band_image)
                VALUES(:bandname, :email, :password, :band_image)";
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

    public function updateBand($id, $putData){
        $errors = $this -> validateBandData($putData);
        if(empty($errors)){
            $sql = "UPDATE `komen`.`kmn_bands` 
                    SET `bandname` = :bandname, `email` = :email, `band_image` = :band_image 
                    WHERE `kmn_bands`.`id` = :id";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':id', $id);
            $qry -> bindValue(':email', $putData['email']);
            $qry -> bindValue(':bandname', htmlentities(strip_tags($putData['bandname'])));
            $qry -> bindValue(':band_image', $putData['band_image']);

            if($qry->execute()){
                return $this -> getBandById($id);
            }
        }
        return array();
    }

    public function validateBandData($data) {
        $errors = array();

        if(empty($this -> checkUserSession())){
            $errors['user'] = 'please log in to continue';
        }

        if(empty($data['bandname'])) {
            $errors['bandname'] = 'no bandname provided';
        }

        if(empty($data['email'])) {
            $errors['email'] = 'no contact email provided';
        }elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'invalid contact email';
        }

        /*if(empty($data['band_image'])) {
            $errors['band_image'] = 'no band profile image specified';
        }*/

        return $errors;
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

    /* --- Check User Session ------------------------------------------- */

    public function checkUserSession(){

        if(!empty($_SESSION['bandUser'])){
            return $_SESSION['bandUser'];
        }
        return array();

    }

}