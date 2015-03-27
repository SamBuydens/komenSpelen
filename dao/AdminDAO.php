<?php

require_once WWW_ROOT . 'classes' . DIRECTORY_SEPARATOR . 'DatabasePDO.php';
//require_once WWW_ROOT . 'dao' . DIRECTORY_SEPARATOR . 'BandsDAO.php';

class AdminDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function getInviteById($id){
        $sql = "SELECT *
                FROM `kmn_invite_keys`
                WHERE `id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        if($qry->execute()){
            $code = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($code)){
                return $code;
            }
        }
        return array();
    }

    public function getInviteByCode($invite_code){
        $sql = "SELECT *
                FROM `kmn_invite_keys`
                WHERE `invite_code` = :invite_code";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':invite_code', $invite_code);

        if($qry->execute()){
            $code = $qry->fetch(PDO::FETCH_ASSOC);
            if(!empty($code)){
                return $code;
            }
        }
        return array();
    }

    public function insertInvite($invite_code){
        $sql = "INSERT INTO kmn_invite_keys(invite_code)
                VALUES(:invite_code)";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':invite_code', $invite_code);

        if($qry->execute()){
            return $this -> getInviteById($this->pdo->lastInsertId());
        }
        return array();
    }

    public function activateInvite($id){
        $sql = "UPDATE `komen`.`kmn_invite_keys` 
                SET `activated` = :activated
                WHERE `kmn_invite_keys`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);
        $qry -> bindValue(':activated', 1);

        if($qry->execute()){
            return $this -> getInviteById($id);
        }
        return array();
    }

    public function deleteInvite($id){
        $sql = "DELETE FROM `komen`.`kmn_invite_keys` 
                WHERE `kmn_invite_keys`.`id` = :id";
        $qry = $this->pdo->prepare($sql);
        $qry -> bindValue(':id', $id);

        $deletedCode = $this -> getInviteById($id);
        if(!empty($deletedCode)){
            if($qry->execute()){
                return $deletedCode;
            }
        }
        return array();
    }

}