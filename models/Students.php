<?php


class Students
{
    static public function getlistStudents($idStudent){
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
            catch (Exception $exception){
                echo $exception->getMessage();
            }
        } else {
            $result = $db->query("
            SELECT students.idStudent, students.firstnameStudent, students.lastnameStudent, numberphoneStudent, chairs.nameChairs
            FROM students INNER JOIN chairs ON students.idChairs = chairs.idChairs
            WHERE idStudent = " . $idStudent . "
            ORDER BY idStudent ASC
            ");
            $listStudents = $result->fetch(\PDO::FETCH_ASSOC);
            return $listStudents;
        }
    }

    static public function deleteStudentById($idStudent){
        $db = Db::getConnectionWithDb();
        $result = $db->prepare('
        DELETE FROM students
        WHERE idStudent = :idStudent
        ');
        $result->bindValue(':idStudents',$idStudent,\PDO::PARAM_INT);
        $result->execute();
    }

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
        catch (Exception $exception){
            echo $exception->getMessage();
        }
        if ($result->execute())
            return true;
        else
            return false;
    }
}