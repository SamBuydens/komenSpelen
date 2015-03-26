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
        $bandsDAO = new BandsDAO();
        $bandbattle['band'] = $bandsDAO -> getBandById($bandbattle['band_id']);

        $bandimagesDAO = new BandImagesDAO();
        $bandbattle['images'] = $bandimagesDAO -> getBandImagesByBandbattleId($bandbattle['id']);

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

    /* --- Setters ------------------------------------------- */

    public function insertBandbattle($band_id, $thedate, $location, $latitude, $longitude){
        $sql = "INSERT INTO kmn_bandbattles(band_id, thedate, location, latitude, longitude)
                VALUES(:band_id, :thedate, :location, :latitude, :longitude)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':thedate', $thedate);
        $qry -> bindValue(':band_id', $band_id);
        $qry -> bindValue(':location', $location);
        $qry -> bindValue(':latitude', $latitude);
        $qry -> bindValue(':longitude', $longitude);

        if($qry->execute()){
            return $this -> getBandbattleById($this->pdo->lastInsertId());
        }
        return array();
    }

    public function updateBandbattle($id, $band_id, $thedate, $location, $latitude, $longitude){
        $sql = "UPDATE `komen`.`kmn_bandbattles` 
                SET `band_id` = :band_id, `thedate` = :thedate, `location` = :location, `latitude` = :latitude, `longitude` = :longitude
                WHERE `kmn_bands`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);
        $qry -> bindValue(':thedate', $thedate);
        $qry -> bindValue(':band_id', $band_id);
        $qry -> bindValue(':location', $location);
        $qry -> bindValue(':latitude', $latitude);
        $qry -> bindValue(':longitude', $longitude);

        if($qry->execute()){
            return $this -> getBandbattleById($id);
        }
        return array();
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