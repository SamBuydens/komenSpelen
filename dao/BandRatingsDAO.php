<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';
require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandsDAO.php';

class BandRatingsDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    /* --- Getters ------------------------------------------- */

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
        $bandsDAO = new BandsDAO();
        $rating['band_scored'] = $bandsDAO -> getBandById($rating['rated_id']);
        $rating['band_rater'] = $bandsDAO -> getBandById($rating['rater_id']);

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

    /* --- Setters ------------------------------------------- */

    public function insertRating($rated_id, $rater_id, $quota_id, $score){
        $sql = "INSERT INTO kmn_ratings(rated_id, rater_id, quota_id, score)
                VALUES(:rated_id, :rater_id, :quota_id, :score)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':rater_id', $rater_id);
        $qry -> bindValue(':rated_id', $rated_id);
        $qry -> bindValue(':quota_id', $quota_id);
        $qry -> bindValue(':score', $score);

        if($qry->execute()){
            return $this -> getRatingById($this->pdo->lastInsertId());
        }
        return array();
    }

    public function updateRating($id, $score){
        $sql = "UPDATE `komen`.`kmn_ratings` 
                SET `score` = :score
                WHERE `kmn_ratings`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);
        $qry -> bindValue(':score', $score);

        if($qry->execute()){
            return $this -> getRatingById($id);
        }
        return array();
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