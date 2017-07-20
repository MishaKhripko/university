<?php

/**
 * Created by PhpStorm.
 * User: mario
 * Date: 20.07.17
 * Time: 9:56
 */
class University
{
    static public function getIdNameUniversities(){
        $result = array();
        $db = Db::getConnectionWithDb();
        $result = $db->query('SELECT idUniver, nameUniver FROM universities');
        $newList = array();
        $i = 0;
        while($row = $result->fetch()) {
            $newList[$i]['idUniver'] = $row['idUniver'];
            $newList[$i]['nameUniver'] = $row['nameUniver'];
            $i++;
        }
        return $newList;
    }

    static public function getListUniversities(){
        $db = Db::getConnectionWithDb();
        $result = $db->query('SELECT * FROM universities');
        $list = [];
        $i =0;
        try {
            while ($row = $result->fetch()) {
                $list[$i]['idUniver'] = $row['idUniver]'];
                $list[$i]['nameUniver'] = $row['nameUniver'];
                $list[$i]['cityUniver'] = $row['cityUniver'];
                $list[$i]['siteUniver'] = $row['siteUniver'];
                $i++;
            }
        }
        catch (Exception $exception){
            echo $exception->getMessage();
        }
        return $list;
    }
    static public function getUniversityById($idUniver){
        $db = Db::getConnectionWithDb();
        try {
            $result = $db->query('
            SELECT * FROM universities
            WHERE idUniver = :idUniver;
            ');
            $result->bindValue(':idUniver', $idUniver, \PDO::PARAM_INT);
            $result = $result->fetch();
        }
        catch(Exception $exception){
            echo $exception->getMessage();
            $result = FALSE;
        }
        return $result;
    }
    static public function addUniversity($row){
        $db = Db::getConnectionWithDb();
        $result = $db->prepare('
        INSERT INTO `universities` (`nameUniver`, `cityUniver`, `siteUniver`)
        VALUES (:nameUniver, :cityUniver, :sityUniver);
');
        try {
            $result->bindValue(':nameUniver', $row['nameUniver'], \PDO::PARAM_STR);
            $result->bindValue(':cityUniver', $row['cityUniver'], \PDO::PARAM_STR);
            $result->bindValue(':siteUniver', $row['siteUniver'], \PDO::PARAM_STR);
            return $result->execute();
        }
        catch (Exception $exception){
            echo $exception->getMessage();
        }
    }
    static public function updateUniversity($idUniver){
        $db = Db::getConnectionWithDb();
        if (isset($_POST['idUniver'])){
            try{
                $result = $db->prepare('
                UPDATE university
                SET nameUniversity = :nameUniver, cityUniver = :sityUniver, siteUniver = :siteUniver
                WHERE  = :idUniver;
                ');
                $result->bindValue(':nameUniver', $_POST['nameUniver'], \PDO::PARAM_STR);
                $result->bindValue(':sityUniver', $_POST['cityUniver'], \PDO::PARAM_STR);
                $result->bindValue(':siteUniver', $_POST['sityUniver'], \PDO::PARAM_STR);
                $result->bindValue(':idUniver', $idUniver, \PDO::PARAM_INT);
                return $result->execute();
            }catch(Exception $exception){

            }
        }
    }

    static public function deleteUniversityById($idUniver){
        $db = Db::getConnectionWithDb();
        $result = $db->prepare('
        DELETE FROM universities
        WHERE idUniver = :idUniver
        ');
        $result->bindValue(':idUniver',$idUniver,\PDO::PARAM_INT);
        $result->execute();
    }
}