<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';
require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandsDAO.php';

class BandImagesDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    /* --- Getters ------------------------------------------- */

    public function getBandImageById($id){
        $sql = "SELECT *
                FROM `kmn_band_images`
                WHERE `id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $bandimage = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($bandimage)){
                return $bandimage;
            }
        }
        return array();
    }

    public function getBandImages(){
        $sql = "SELECT *
                FROM `kmn_band_images`";
        $qry = $this->pdo->prepare($sql);

        if($qry->execute()){
            $bandImages = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($bandImages)){
                return $bandImages;
            }
        }
        return array();
    }

    public function getBandImagesByBandbattleId($bandbattle_id){
        $sql = "SELECT *
                FROM `kmn_band_images`
                WHERE `bandbattle_id` = :bandbattle_id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':bandbattle_id', $bandbattle_id);

        if($qry->execute()){
            $bandImages = $qry->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($bandImages)){
                return $bandImages;
            }
        }
        return array();
    }

    /* --- Setters ------------------------------------------- */

    public function insertBandImage($bandbattle_id, $uploader_id, $filename, $width, $height){
        $sql = "INSERT INTO kmn_band_images(bandbattle_id, uploader_id, filename, width, height)
                VALUES(:bandbattle_id, :uploader_id, :filename, :width, :height)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':filename', $filename);
        $qry -> bindValue(':bandbattle_id', $bandbattle_id);
        $qry -> bindValue(':uploader_id', $uploader_id);
        $qry -> bindValue(':width', $width);
        $qry -> bindValue(':height', $height);

        if($qry->execute()){
            return $this -> getBandImageById($id);
        }
        return array();
    }

    /* --- Delete ------------------------------------------- */

    public function deleteBandImage($id){
        $sql = "DELETE FROM `komen`.`kmn_band_images` 
                WHERE `kmn_band_images`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        $deletedBandImage = $this -> getBandImageById($id);
        if(!empty($deletedBandImage)){
            if($qry->execute()){
                return $deletedBandImage;
            }
        }
        return array();

    }

}