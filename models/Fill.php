<?php
require_once(ROOT.'/vendor/autoload.php');

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
        //$paramsPath = ROOT . '/config/createdb.php';
        //$this->params = include($paramsPath);
        $this->dbconnect = Db::getConnectionWithDb();
        $this->faker = Faker\Factory::create();//'uk_UA'
    }
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
                if ($query->execute()) $var++;// or die(print_r($db->errorInfo(), false));
            }
        }
        catch (Exception $exception){
            echo 'addTableUniversities'.$exception->getMessage();
        }
        return $var;
    }
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
        catch (Exception $exception){
            echo 'addTableChairs'.$exception->getMessage();
        }
        return $var;
    }
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
        catch (Exception $exception){
            echo 'addTableStudents'.$exception->getMessage();
        }
        return $var;
    }
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
        catch(Exception $exception){
            echo 'addTableTeacher'.$exception->getMessage();
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
        catch (Exception $exception){
            echo 'addTableDiscipline'.$exception->getMessage();
        }
        return $var;
    }
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
        catch (Exception $exception){
            echo 'addTableTtd'.$exception->getMessage();
        }
        return $var;
    }
    public function getReport(){
        $var = array();
        $var['universities'] = $this->addTableUniversities($this->count["universities"]);
        $var['chairs'] = $this->addTableChairs($this->count["chairs"], $this->count["universities"]);
        $var['students'] = $this->addTableStudents($this->count["students"], $this->count["chairs"]);
        $var['teacher'] = $this->addTableTeacher($this->count["teacher"], $this->count["chairs"]);
        $var['discipline'] = $this->addTableDiscipline($this->count["discipline"], $this->count["chairs"]);
        $var['teacherToDiscipline'] = $this->addTableTtd(15, $this->count["teacher"], $this->count["discipline"]);
        return $var;
    }
}


























