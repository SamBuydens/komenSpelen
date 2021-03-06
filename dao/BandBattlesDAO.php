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

    public function getBandbattleEventById($id){
        $sql = "SELECT *
                FROM `kmn_bandbattle_events`
                WHERE `id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $bandbattleEvent = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($bandbattleEvent)){
                //$bandbattleEvent = $this -> getBandbattleDetails($bandbattleEvent);
                return $bandbattleEvent;
            }
        }
        return array();
    }

    public function getBandbattleEventsByBandbattleId($bandbattle_id){
        $sql = "SELECT *
                FROM `kmn_bandbattle_events`
                WHERE `bandbattle_id` = :bandbattle_id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':bandbattle_id', $bandbattle_id);

        if($qry->execute()){
            $bandbattle_events = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($bandbattle_events)){
                //$bandbattle_events = $this -> getBandbattleEventDetails($bandbattle_events);
                return $bandbattle_events;
            }
        }
        return array();
    }

    public function getBandbattleEventByBandId($band_id){
        $sql = "SELECT *
                FROM `kmn_bandbattle_events`
                WHERE `host_id` = :band_id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':band_id', $band_id);

        if($qry->execute()){
            $bandbattle_event = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($bandbattle_event)){
                return $bandbattle_event;
            }
        }
        return array();
    }

    public function getBandbattleDetails($bandbattle){
        $bandbattle['gigs'] = $this -> getBandbattleEventsByBandbattleId($bandbattle['id']);
        $bandbattle['organiser'] = $this -> bandsDAO -> getBandById($bandbattle['organiser_id']);
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

    public function validateBandbattleEventData($id, $postData){
        $errors = array();

        if(empty($data['host_id'])) {
            $errors['host_id'] = 'no host_id provided';
        }

        /*if(empty($data['gig_date'])) {
            $errors['gig_date'] = 'no gig_date provided';
        }*/

        if(empty($data['location'])) {
            $errors['location'] = 'no location provided';
        }

        if(empty($data['latitude'])) {
            $errors['latitude'] = 'no latitude provided';
        }

        if(empty($data['longitude'])) {
            $errors['longitude'] = 'no longitude provided';
        }

        return $errors;
    }

    public function insertBandbattleEvent($id, $postData){
        //$errors = $this -> validateBandbattleEventData($postData);
        if(empty($errors)){
            $sql = "INSERT INTO kmn_bandbattle_events(bandbattle_id, host_id, gig_date, location, latitude, longitude)
                    VALUES(:bandbattle_id, :host_id, :gig_date, :location, :latitude, :longitude)";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':bandbattle_id', $id);
            $qry -> bindValue(':host_id', $postData['host_id']);
            $qry -> bindValue(':gig_date', date('yyyy/mm/dd') /*$postData['gig_date']*/);
            $qry -> bindValue(':location', htmlentities(strip_tags($postData['location'])));
            $qry -> bindValue(':latitude', $postData['latitude']);
            $qry -> bindValue(':longitude', $postData['longitude']);

            if($qry->execute()){
                return $this -> getBandbattleEventById($this->pdo->lastInsertId());
            }
        }
        return array();
    }

    public function insertBandbattle($postData){
        //$errors = $this -> validateBandbattleEventData($postData);
        if(empty($errors)){
            $sql = "INSERT INTO kmn_bandbattles(organiser_id)
                    VALUES(:organiser_id)";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':organiser_id', $postData['organiser_id']);

            if($qry->execute()){
                return $this -> getBandbattleById($this->pdo->lastInsertId());
            }
        }
        return array();
    }

    public function updateBandbattleEvent($id, $putData){
        $errors = $this -> validateBandbattleData($putData);
        if(empty($errors)){
            $sql = "UPDATE `komen`.`kmn_bandbattle_events` 
                    SET `gig_date` = :gig_date, `location` = :location, `latitude` = :latitude, `longitude` = :longitude
                    WHERE `kmn_bandbattle_events`.`id` = :id";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':id', $id);
            $qry -> bindValue(':gig_date', $putData['gig_date']);
            $qry -> bindValue(':location', htmlentities(strip_tags($putData['location'])));
            $qry -> bindValue(':latitude', $putData['latitude']);
            $qry -> bindValue(':longitude', $putData['longitude']);

            if($qry->execute()){
                return $this -> getBandbattleById($id);
            }
        }
        return array();
    }

    public function updateBandbattle($id, $name){
        if(empty($errors)){
            $sql = "UPDATE `komen`.`kmn_bandbattles` 
                    SET `name` = :name
                    WHERE `kmn_bandbattles`.`id` = :id";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':id', $id);
            $qry -> bindValue(':name', htmlentities(strip_tags($putData['name'])));

            if($qry->execute()){
                return $this -> getBandbattleById($id);
            }
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