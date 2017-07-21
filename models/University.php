<?php

namespace Models;

use Components\Db;

/**
 * Class University
 * @package Models
 */
class University
{
    /**
     * @return array
     */
    static public function getIdNameUniversities()
    {
        $result = array();
        $db = Db::getConnectionWithDb();
        $result = $db->query('SELECT idUniver, nameUniver FROM universities');
        $newList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $newList[$i]['idUniver'] = $row['idUniver'];
            $newList[$i]['nameUniver'] = $row['nameUniver'];
            $i++;
        }

        return $newList;
    }

    /**
     * @return array
     */
    static public function getListUniversities()
    {
        $db = Db::getConnectionWithDb();
        $result = $db->query('SELECT * FROM universities');
        $list = [];
        $i = 0;
        try {
            while ($row = $result->fetch()) {
                $list[$i]['idUniver'] = $row['idUniver'];
                $list[$i]['nameUniver'] = $row['nameUniver'];
                $list[$i]['cityUniver'] = $row['cityUniver'];
                $list[$i]['siteUniver'] = $row['siteUniver'];
                $i++;
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        return $list;
    }

    /**
     * @param $idUniver
     * @return bool|mixed|\PDOStatement
     */
    static public function getUniversityById($idUniver)
    {
        $db = Db::getConnectionWithDb();
        if (isset($_POST['update'])) {
            $result = $db->prepare(
                '
            UPDATE universities
            SET nameUniver = :nameUniver, cityUniver = :cityUniver, siteUniver = :siteUniver
            WHERE idUniver = :idUniver
            '
            );
            $result->bindValue(':nameUniver', $_POST['nameUniver'], \PDO::PARAM_STR);
            $result->bindValue(':cityUniver', $_POST['cityUniver'], \PDO::PARAM_STR);
            $result->bindValue(':siteUniver', $_POST['siteUniver'], \PDO::PARAM_STR);
            $result->bindValue(':idUniver', $idUniver, \PDO::PARAM_INT);

            return $result->execute();
        } else {
            try {
                $result = $db->query(
                    "
            SELECT * FROM universities
            WHERE idUniver = ".$idUniver.";
            "
                );
                $result = $result->fetch(\PDO::FETCH_ASSOC);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
                $result = false;
            }

            return $result;
        }
    }

    static public function addUniversity($row)
    {
        $db = Db::getConnectionWithDb();
        $result = $db->prepare(
            '
        INSERT INTO `universities` (`nameUniver`, `cityUniver`, `siteUniver`)
        VALUES (:nameUniver, :cityUniver, :siteUniver)
'
        );
        try {
            $result->bindValue(':nameUniver', $row[0], \PDO::PARAM_STR);
            $result->bindValue(':cityUniver', $row[1], \PDO::PARAM_STR);
            $result->bindValue(':siteUniver', $row[2], \PDO::PARAM_STR);
            echo $row[0].$row[1].$row[2];

            return $result->execute();
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $idUniver
     * @return bool
     */
    static public function updateUniversity($idUniver)
    {
        $db = Db::getConnectionWithDb();
        if (isset($_POST['idUniver'])) {
            try {
                $result = $db->prepare(
                    '
                UPDATE university
                SET nameUniversity = :nameUniver, cityUniver = :sityUniver, siteUniver = :siteUniver
                WHERE  = :idUniver;
                '
                );
                $result->bindValue(':nameUniver', $_POST['nameUniver'], \PDO::PARAM_STR);
                $result->bindValue(':sityUniver', $_POST['cityUniver'], \PDO::PARAM_STR);
                $result->bindValue(':siteUniver', $_POST['sityUniver'], \PDO::PARAM_STR);
                $result->bindValue(':idUniver', $idUniver, \PDO::PARAM_INT);

                return $result->execute();
            } catch (\Exception $exception) {

            }
        }
    }

    /**
     * @param $idUniver
     */
    static public function deleteUniversityById($idUniver)
    {
        $db = Db::getConnectionWithDb();
        $result = $db->prepare(
            '
        DELETE FROM universities
        WHERE idUniver = :idUniver
        '
        );
        $result->bindValue(':idUniver', $idUniver, \PDO::PARAM_INT);
        $result->execute();
    }
}