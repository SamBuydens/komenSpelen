<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';
require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandsDAO.php';
require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandImagesDAO.php';

class BandBattlesDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
        $this->bandsDAO = new BandsDAO();
        $this->bandimagesDAO = new BandImagesDAO();
    }

    /* --- Getters ------------------------------------------- */

    public function getBandbattleById($id){
        $sql = "SELECT *
                FROM `kmn_bandbattles`
                WHERE `id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $bandbattle = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($bandbattle)){
                $bandbattle = $this -> getBandbattleDetails($bandbattle);
                return $bandbattle;
            }
        }
        return array();
    }

    public function getBandbattles(){
        $sql = "SELECT *
                FROM `kmn_bandbattles`";
        $qry = $this->pdo->prepare($sql);

        if($qry->execute()){
            $bandbattles = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($bandbattles)){
                $bandbattles = $this -> getBandbattlesDetails($bandbattles);
                return $bandbattles;
            }
        }
    }

    public function getBandbattleDetails($bandbattle){
        $bandbattle['band'] = $this -> bandsDAO -> getBandById($bandbattle['band_id']);
        $bandbattle['images'] = $this -> bandimagesDAO -> getBandImagesByBandbattleId($bandbattle['id']);

        return $bandbattle;
    }

    public function getBandbattlesDetails($bandbattles){
        $i = 0;

        foreach($bandbattles as $bandbattle){
            $bandbattle = $this -> getBandbattleDetails($bandbattle);
            $bandbattles[$i] = $bandbattle;
            $i++;
        }

        return $bandbattles;
    }

    /* --- Setters & Validation ------------------------------------------- */

    public function insertBandbattle($postData){
        $errors = $this -> validateBandbattleData($postData);
        if(empty($errors)){
            $sql = "INSERT INTO kmn_bandbattles(band_id, thedate, location, latitude, longitude)
                    VALUES(:band_id, :thedate, :location, :latitude, :longitude)";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':thedate', $postData['gig_date']);
            $qry -> bindValue(':band_id', $postData['band_id']);
            $qry -> bindValue(':location', htmlentities(strip_tags($postData['location'])));
            $qry -> bindValue(':latitude', $postData['latitude']);
            $qry -> bindValue(':longitude', $postData['longitude']);

            if($qry->execute()){
                return $this -> getBandbattleById($this->pdo->lastInsertId());
            }
        }
        return array();
    }

    public function updateBandbattle($id, $putData){
        $errors = $this -> validateBandbattleData($putData);
        if(empty($errors)){
            $sql = "UPDATE `komen`.`kmn_bandbattles` 
                    SET `band_id` = :band_id, `thedate` = :thedate, `location` = :location, `latitude` = :latitude, `longitude` = :longitude
                    WHERE `kmn_bands`.`id` = :id";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':id', $id);
            $qry -> bindValue(':thedate', $putData['gig_date']);
            $qry -> bindValue(':band_id', $putData['band_id']);
            $qry -> bindValue(':location', htmlentities(strip_tags($putData['location'])));
            $qry -> bindValue(':latitude', $putData['latitude']);
            $qry -> bindValue(':longitude', $putData['longitude']);

            if($qry->execute()){
                return $this -> getBandbattleById($id);
            }
        }
        return array();
    }

    public function validateBandbattleData($data) {
        $errors = array();

        if(empty($this -> bandsDAO -> checkUserSession())){
            $errors['user'] = 'please log in to continue';
        }

        if(empty($data['band_id'])) {
            $errors['band_id'] = 'no band chosen';
        }elseif(empty($this -> bandsDAO -> getBandById($data['band_id']))){
            $errors['band_id'] = 'the band you chose does not exist in our database';
        }

        $arrDateTest = explode('/', $data['gig_date']);
        if(empty($data['gig_date'])) {
            $errors['gig_date'] = 'no date set for this bandbattle';
        }elseif(!checkdate($arrDateTest[0], $arrDateTest[1], $arrDateTest[2])){
            $errors['gig_date'] = 'the specified date was not valid';
        }

        if(empty($data['location'])) {
            $errors['location'] = 'no location set for this bandbattle';
        }

        if(empty($data['latitude'])) {
            $errors['latitude'] = 'no latitude coördinate set for this bandbattle';
        }

        if(empty($data['longitude'])) {
            $errors['longitude'] = 'no longitude coördinate set for this bandbattle';
        }

        return $errors;
    }

    /* --- Delete ------------------------------------------- */

    public function deleteBandbattle($id){
        $sql = "DELETE FROM `komen`.`kmn_bandbattles` 
                WHERE `kmn_bandbattles`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        $deletedBandbattle = $this -> getBandbattleById($id);
        if(!empty($deletedBandbattle)){
            if($qry->execute()){
                return $deletedBandbattle;
            }
        }
        return array();

    }

}