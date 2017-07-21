<?php

namespace Models;

use Components\Db;

/**
 * Class Chairs
 * @package Chairs
 */
class Chairs
{
    /**
     * @return array
     */
    static public function getListChairs()
    {
        $db = Db::getConnectionWithDb();
        $newsList = array();

        $result = $db->query(
            '
        SELECT chairs.idChairs, universities.nameUniver, chairs.nameChairs 
        FROM chairs INNER JOIN universities ON 
        chairs.idUniver = universities.idUniver 
        ORDER BY idChairs ASC
        '
        );
        $i = 0;
        while ($row = $result->fetch()) {
            $newsList[$i]['idChairs'] = $row['idChairs'];
            $newsList[$i]['nameUniver'] = $row['nameUniver'];
            $newsList[$i]['nameChairs'] = $row['nameChairs'];
            $i++;
        }

        return $newsList;
    }

    static public function getChairsById($idChairs)
    {
        $db = Db::getConnectionWithDb();
        if (isset($_POST["idChairs"])) {
            //switch ($_POST[$update])
            try {
                $result = $db->prepare(
                    "
                UPDATE chairs
                SET nameChairs = :nameChairs
                WHERE idChairs = :idChairs;
                "
                );
                //echo $_POST["nameChairs"]." ".$_POST["idChairs"]." !";
                $result->bindValue(':nameChairs', $_POST["nameChairs"], \PDO::PARAM_STR);
                $result->bindValue(':idChairs', $_POST["idChairs"], \PDO::PARAM_INT);

                return $result->execute();
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        } else {
            $newList = array();
            try {
                $result = $db->query(
                    "
                SELECT chairs.idChairs, universities.nameUniver, chairs.nameChairs 
                FROM chairs INNER JOIN universities ON 
                chairs.idUniver = universities.idUniver
                WHERE chairs.idChairs = ".$idChairs."
                ORDER BY idChairs ASC
            "
                );

                return $result->fetch(\PDO::FETCH_ASSOC);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }

    /**
     * @param $idChairs
     */
    static public function deleteChairsById($idChairs)
    {
        $db = Db::getConnectionWithDb();
        $result = $db->prepare(
            '
        DELETE FROM chairs
        WHERE idChairs = :idChairs
        '
        );
        $result->bindValue(':idChairs', $idChairs, \PDO::PARAM_INT);
        $result->execute();
    }

    /**
     * @param $arrayPost
     * @return bool
     */
    static public function addRecord($arrayPost)
    {
        $db = Db::getConnectionWithDb();
        echo $arrayPost[0].$arrayPost[1];
        try {
            $result = $db->prepare(
                '
        INSERT INTO `chairs` (`idUniver`, `nameChairs`) VALUES (:idUniver, :nameChairs)
        '
            );
            $result->bindValue(':idUniver', $arrayPost[0], \PDO::PARAM_INT);
            $result->bindValue(':nameChairs', $arrayPost[1], \PDO::PARAM_STR);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }
}