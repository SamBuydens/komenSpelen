<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';
require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandsDAO.php';

class BandRatingsDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
        $this->bandsDAO = new BandsDAO();
    }

    /* --- Getters ------------------------------------------- */

    public function getRatingQuota(){
        $sql = "SELECT * FROM `kmn_rating_quota`";
        $qry = $this->pdo->prepare($sql);

        if($qry->execute()){
            $ratingQuota = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ratingQuota)){
                return $ratingQuota;
            }
        }
        return array();
    }

    public function getRatingQuotaById($id){
        $sql = "SELECT * FROM `kmn_rating_quota`
                WHERE `kmn_rating_quota`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $ratingQuota = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($ratingQuota)){
                return $ratingQuota;
            }
        }
        return array();
    }

    public function getRatingById($id){
        $sql = "SELECT `kmn_ratings`.*, `kmn_rating_quota`.`quota`
                FROM `kmn_ratings` LEFT JOIN `kmn_rating_quota` ON `kmn_ratings`.`quota_id` = `kmn_rating_quota`.`id` 
                WHERE `kmn_ratings`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $bandrating = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($bandrating)){
                $bandrating = $this -> getRatingDetails($bandrating);
                return $bandrating;
            }
        }
        return array();
    }

    public function getRatings(){
        $sql = "SELECT `kmn_ratings`.*, `kmn_rating_quota`.`quota`
                FROM `kmn_ratings` LEFT JOIN `kmn_rating_quota` ON `kmn_ratings`.`quota_id` = `kmn_rating_quota`.`id`";
        $qry = $this->pdo->prepare($sql);

        if($qry->execute()){
            $ratings = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ratings)){
                $ratings = $this -> getRatingsDetails($ratings);
                return $ratings;
            }
        }
    }

    public function getRatingsForBand($band_id){
        $sql = "SELECT `kmn_ratings`.*, `kmn_rating_quota`.`quota`
                FROM `kmn_ratings` LEFT JOIN `kmn_rating_quota` ON `kmn_ratings`.`quota_id` = `kmn_rating_quota`.`id` 
                WHERE `kmn_ratings`.`rated_id` = :band_id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':band_id', $band_id);

        if($qry->execute()){
            $ratings = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ratings)){
                $ratings = $this -> getRatingsDetails($ratings);
                return $ratings;
            }
        }
    }

    public function getRatingsByBand($band_id){
        $sql = "SELECT `kmn_ratings`.*, `kmn_rating_quota`.`quota`
                FROM `kmn_ratings` LEFT JOIN `kmn_rating_quota` ON `kmn_ratings`.`quota_id` = `kmn_rating_quota`.`id` 
                WHERE `kmn_ratings`.`rater_id` = :band_id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':band_id', $band_id);

        if($qry->execute()){
            $ratings = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ratings)){
                $ratings = $this -> getRatingsDetails($ratings);
                return $ratings;
            }
        }
    }

    public function getRatingDetails($rating){
        $rating['band_playing'] = $this -> bandsDAO -> getBandById($rating['rated_id']);
        $rating['band_rated'] = $this -> bandsDAO -> getBandById($rating['rater_id']);

        return $rating;
    }

    public function getRatingsDetails($ratings){
        $i = 0;

        foreach($ratings as $rating){
            $rating = $this -> getRatingDetails($rating);
            $ratings[$i] = $rating;
            $i++;
        }

        return $ratings;
    }

    /* --- Setters & Validation ------------------------------------------- */

    public function insertRating($postData){
        $errors = $this -> validateScoringData($postData);
        if(empty($errors)){
            $sql = "INSERT INTO kmn_ratings(rated_id, rater_id, quota_id, score)
                    VALUES(:rated_id, :rater_id, :quota_id, :score)";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':rater_id', $postData['rater_id']);
            $qry -> bindValue(':rated_id', $postData['rated_id']);
            $qry -> bindValue(':quota_id', $postData['quota_id']);
            $qry -> bindValue(':score', $postData['score']);

            if($qry->execute()){
                return $this -> getRatingById($this->pdo->lastInsertId());
            }
        }
        return array();
    }

    public function updateRating($id, $putData){
        $errors = $this -> validateScoringData($putData);
        if(empty($errors)){
            $sql = "UPDATE `komen`.`kmn_ratings` 
                    SET `score` = :score
                    WHERE `kmn_ratings`.`id` = :id";
            $qry = $this->pdo->prepare($sql);
            $qry -> bindValue(':id', $id);
            $qry -> bindValue(':score', $putData['score']);

            if($qry->execute()){
                return $this -> getRatingById($id);
            }
        }
        return array();
    }

    public function validateRatingData($data) {
        $errors = validateScoringData($data);

        if(empty($data['rater_id'])) {
            $errors['rater_id'] = 'no rating band set';
        }elseif(empty($this -> bandsDAO -> getBandById($data['rater_id']))){
            $errors['rater_id'] = 'no band with such id';
        }

        if(empty($data['rated_id'])) {
            $errors['rated_id'] = 'no band selected to rate';
        }elseif(empty($this -> bandsDAO -> getBandById($data['rated_id']))){
            $errors['rated_id'] = 'no band with such id';
        }

        if(empty($data['quota_id'])) {
            $errors['quota_id'] = 'no rating quota selected';
        }elseif(empty($this -> getRatingQuotaById($data['quota_id']))){
            $errors['quota_id'] = 'selected rating quota does not exist';
        }

        return $errors;
    }

    public function validateScoringData($data) {
        $errors = array();

        if(empty($this -> bandsDAO -> checkUserSession())){
            $errors['user'] = 'please log in to continue';
        }

        if(empty($data['score'])) {
            $errors['score'] = 'no new score provided';
        }elseif($data['score'] > 10){
            $errors['score'] = 'cannot score higher than 10';
        }elseif($data['score'] < 0){
            $errors['score'] = 'cannot score lower than 0';
        }

        return $errors;
    }

    /* --- Delete ------------------------------------------- */

    public function deleteRating($id){
        $sql = "DELETE FROM `komen`.`kmn_ratings` 
                WHERE `kmn_ratings`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        $deletedRating = $this -> getRatingById($id);
        if(!empty($deletedBandbattle)){
            if($qry->execute()){
                return $deletedBandbattle;
            }
        }
        return array();

    }

}