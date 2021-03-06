<?php

namespace Models;
use Components\Db;

/**
 * Class Students
 * @package Models
 */
class Students
{
    /**
     * @param $name
     * @return array
     */
    static public function getSearchStudent($name){
        $db = Db::getConnectionWithDb();
        $result = $db->query("
        SELECT students.idStudent, students.firstnameStudent, students.lastnameStudent, numberphoneStudent, chairs.nameChairs, universities.nameUniver
        FROM ((students INNER JOIN chairs ON students.idChairs = chairs.idChairs) INNER JOIN universities ON chairs.idUniver = universities.idUniver)
        WHERE students.firstnameStudent LIKE '%$name%' OR students.lastnameStudent LIKE '%$name%' ORDER BY idStudent ASC
        ");
        $listArray = [];
        $i = 0;
        try{
            while ($row = $result->fetch()){
                $listArray[$i]['idStudent'] = $row['idStudent'];
                $listArray[$i]['firstnameStudent'] = $row['firstnameStudent'];
                $listArray[$i]['lastnameStudent'] = $row['lastnameStudent'];
                $listArray[$i]['numberphoneStudent'] = $row['numberphoneStudent'];
                $listArray[$i]['nameChairs'] = $row['firstnameStudent'];
                $listArray[$i]['nameUniver'] = $row['nameUniver'];
                $i++;
            }
            return $listArray;
        }
        catch (Exception $exception){
            echo $exception->getMessage();
        }
    }

    /**
     * @return array
     */
    static public function getlistStudents(){
        $db = Db::getConnectionWithDb();
        $result = $db->query('
        SELECT students.idStudent, students.firstnameStudent, students.lastnameStudent, numberphoneStudent, chairs.nameChairs
        FROM students INNER JOIN chairs ON students.idChairs = chairs.idChairs 
        ORDER BY idStudent ASC
        ');
        $listStudents = [];
        $i = 0;
        try {
            while ($row = $result->fetch()) {
                $listStudents[$i]['idStudent'] = $row['idStudent'];
                $listStudents[$i]['firstnameStudent'] = $row['firstnameStudent'];
                $listStudents[$i]['lastnameStudent'] = $row['lastnameStudent'];
                $listStudents[$i]['numberphoneStudent'] = $row['numberphoneStudent'];
                $listStudents[$i]['nameChairs'] = $row['nameChairs'];
                $i++;
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
        return $listStudents;
    }

    /**
     * @param $idStudent
     * @return bool|mixed
     */
    static public function getStudentById($idStudent){
        $db = Db::getConnectionWithDb();
        if (isset($_POST['update'])){
            try{
                $result = $db->prepare('
                    UPDATE students
                    SET idChairs = :idChairs, firstnameStudent = :firstnameStudent, lastnameStudent = :lastnameStudent, numberphoneStudent = :numberphoneStudent
                    WHERE idStudent = :idStudent
                    ');
                $result->bindValue(':idChairs', $_POST['idChairs'], \PDO::PARAM_INT);
                $result->bindValue(':firstnameStudent', $_POST['firstnameStudent'], \PDO::PARAM_STR);
                $result->bindValue(':lastnameStudent', $_POST['lastnameStudent'], \PDO::PARAM_STR);
                $result->bindValue(':numberphoneStudent', $_POST['numberphoneStudent'], \PDO::PARAM_STR);
                $result->bindValue(':idStudent', $idStudent, \PDO::PARAM_INT);
                header('Location: /students');
                return $result->execute();
            }
            catch (\Exception $exception){
                echo $exception->getMessage();
            }
        } else {
            $result = $db->query("
            SELECT students.idStudent, students.firstnameStudent, students.lastnameStudent, numberphoneStudent, chairs.nameChairs
            FROM students INNER JOIN chairs ON students.idChairs = chairs.idChairs
            WHERE idStudent = ".$idStudent."
            ORDER BY idStudent ASC
            ");
            $listStudents = $result->fetch(\PDO::FETCH_ASSOC);
            return [$listStudents];
        }
    }

    /**
     * @param $idStudent
     * @return bool
     */
    static public function deleteStudentById($idStudent){
        $db = Db::getConnectionWithDb();
        try {
            $result = $db->prepare('
        DELETE FROM students
        WHERE idStudent = :idStudent
        ');
            $result->bindValue(':idStudent', $idStudent, \PDO::PARAM_INT);
            return $result->execute();
        }
        catch (\Exception $exception){
            echo $exception->getMessage();
        }
    }

    /**
     * @param $array
     * @return bool
     */
    static public function addStudent($array){
        $db = Db::getConnectionWithDb();
        try {
            $result = $db->prepare('
            INSERT INTO `students` (`idChairs`, `firstnameStudent`, `lastnameStudent`, `numberphoneStudent`)
            VALUES (:idChairs, :firstnameStudent, :lastnameStudent, :numberphoneStudent)
            ');
            $result->bindValue(':idChairs', $array[0], \PDO::PARAM_INT);
            $result->bindValue(':firstnameStudent', $array[1], \PDO::PARAM_STR);
            $result->bindValue(':lastnameStudent', $array[2], \PDO::PARAM_STR);
            $result->bindValue(':numberphoneStudent', $array[3], \PDO::PARAM_STR);
        }
        catch (\Exception $exception){
            echo $exception->getMessage();
        }
        if ($result->execute())
            return true;
        else
            return false;
    }
}