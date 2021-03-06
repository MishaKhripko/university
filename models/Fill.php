<?php

namespace Models;

use Components\Db;

/**
 * Class Fill
 * @package Models
 */
class Fill
{
    private $faker;
    private $dbconnect;
    private $count = array (
        'universities' => '3',
        'chairs' => '10',
        'students' => '100',
        'teacher' => '15',
        'discipline' => '15',
        'teacherToDiscipline' => '15'
    );
    public function __construct()
    {
        $this->dbconnect = Db::getConnectionWithDb();
        $this->faker = \Faker\Factory::create();
    }

    /**
     * @param $count
     * @return int
     */
    private function addTableUniversities($count){
        $var = 0;
        $query = $this->dbconnect->prepare('
        INSERT INTO `universities` (`nameUniver`, `cityUniver`, `siteUniver`) VALUES (:nameUniver, :cityUniver, :siteUniver)
        ');
        try {
            for ($i = 0; $i < $count; $i++) {
                $query->bindValue(':nameUniver', 'unvr-' . $this->faker->company, \PDO::PARAM_STR);
                $query->bindValue(':cityUniver', 'city-' . $this->faker->city, \PDO::PARAM_STR);
                $query->bindValue(':siteUniver', 'site-' . $this->faker->address, \PDO::PARAM_STR);
                if ($query->execute())
                    $var++;
            }
        }
        catch (\Exception $exception){
            echo $exception->getMessage();
        }
        return $var;
    }

    /**
     * @param $count
     * @param $idUniver
     * @return int
     */
    private function addTableChairs($count, $idUniver){
        $query = $this->dbconnect->prepare('
        INSERT INTO `chairs` (`idUniver`, `nameChairs`) VALUES (:idUniver, :nameChairs)
        ');
        $var = 0;
        try {
            for ($i = 0; $i < $count; $i++) {
                $query->bindValue(':idUniver', mt_rand(0, $idUniver), \PDO::PARAM_INT);
                $query->bindValue(':nameChairs', 'chairs-'.$this->faker->company, \PDO::PARAM_STR);
                if ($query->execute()) $var++;
            }
        }
        catch (\Exception $exception){
            echo $exception->getMessage();
        }
        return $var;
    }

    /**
     * @param $count
     * @param $idChairs
     * @return int
     */
    private function addTableStudents($count, $idChairs){
        $query = $this->dbconnect->prepare('
        INSERT INTO `students` (`idChairs`,`firstnameStudent`,`lastnameStudent`,`numberphoneStudent`) VALUES (:idChairs,:firstnameStudent,:lastnameStudent,:numberphoneStudent)'
        );
        $var = 0;
        try {
            for ($i = 0; $i < $count; $i++) {
                $query->bindValue(':idChairs', mt_rand(0, $idChairs), \PDO::PARAM_INT);
                $query->bindValue(':firstnameStudent', $this->faker->firstName, \PDO::PARAM_STR);
                $query->bindValue(':lastnameStudent', $this->faker->lastName, \PDO::PARAM_STR);
                $query->bindValue(':numberphoneStudent', $this->faker->phoneNumber, \PDO::PARAM_STR);
                if ($query->execute()) $var++;
            }
        }
        catch (\Exception $exception){
            echo $exception->getMessage();
        }
        return $var;
    }

    /**
     * @param $count
     * @param $idChairs
     * @return int
     */
    private function addTableTeacher($count, $idChairs){
        $query = $this->dbconnect->prepare('
        INSERT INTO `teacher` (`idChairs`, `firstnameTeacher`, `lastnameTeacher`) VALUES (:idChairs, :firstnameStudent, :lastnameStudent)
        ');
        $var = 0;
        try {
            for ($i = 0; $i < $count; $i++) {
                $query->bindValue(':idChairs', mt_rand(0, $idChairs), \PDO::PARAM_INT);
                $query->bindValue(':firstnameStudent', $this->faker->firstName, \PDO::PARAM_STR);
                $query->bindValue(':lastnameStudent', $this->faker->lastName, \PDO::PARAM_STR);
                if ($query->execute()) $var++;
            }
        }
        catch(\Exception $exception){
            echo $exception->getMessage();
        }
        return $var;
    }
    private function addTableDiscipline($count, $idChairs){
        $query = $this->dbconnect->prepare('
        INSERT INTO discipline (idChairs, nameDiscipline) VALUES (:idChairs,:nameDiscipline)
        ');
        $var = 0;
        try {
            for ($i = 0; $i < $count; $i++) {
                $query->bindValue(':idChairs', mt_rand(0, $idChairs), \PDO::PARAM_INT);
                $query->bindValue(':nameDiscipline', $this->faker->company, \PDO::PARAM_STR);
                if ($query->execute()) $var++;
            }
        }
        catch (\Exception $exception){
            echo 'addTableDiscipline'.$exception->getMessage();
        }
        return $var;
    }

    /**
     * @param $count
     * @param $idTeacher
     * @param $idDiscipline
     * @return int
     */
    private function addTableTtd($count,$idTeacher,$idDiscipline)
    {
        $query = $this->dbconnect->prepare('
        INSERT INTO `teacherToDiscipline` (`idTeacher`,`idDiscipline`) VALUES (:idTeacher, :idDiscipline)
        ');
        $var = 0;
        try {
            for ($i = 0; $i < $count; $i++) {
                $query->bindValue(':idTeacher', mt_rand(0, $idTeacher), \PDO::PARAM_INT);
                $query->bindValue(':idDiscipline', mt_rand(0, $idDiscipline), \PDO::PARAM_INT);
                if ($query->execute()) $var++;
            }
        }
        catch (\Exception $exception){
            echo 'addTableTtd'.$exception->getMessage();
        }
        return $var;
    }
    public function getReport(){
        try {
            return array(
                array('name' => 'Університети', 'value' => $this->addTableUniversities($this->count["universities"]),),
                array('name' => 'Кафедри', 'value' => $this->addTableChairs($this->count["chairs"], $this->count["universities"]),),
                array('name' => 'Студенти', 'value' => $this->addTableStudents($this->count["students"], $this->count["chairs"]),),
                array('name' => 'Викладачі', 'value' => $this->addTableTeacher($this->count["teacher"], $this->count["chairs"]),),
                array('name' => 'Дисципліни', 'value' => $this->addTableDiscipline($this->count["discipline"], $this->count["chairs"]),),
                array('name' => 'Вчителі та дисципліни', 'value' => $this->addTableTtd(15, $this->count["teacher"], $this->count["discipline"]),),
            );
        }
        catch(\Exception $exception){
            echo $exception->getMessage();
        }
    }
}


























