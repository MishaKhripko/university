<?php

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
        $paramsPath = ROOT . '/config/createdb.php';
        $this->params = include($paramsPath);
        $this->dbconnect = Db::getConnection();
        $this->faker = Faker\Factory::create('uk_UA');
    }
    private function addTableUniversities($count){
        $query = $this->dbconnect->prepare('INSERT INTO universities (nameUniver, cityUniver, siteUniver) VALUES (?, ?, ?)');
        for ($i=0;$i<$count;$i++){
            $query->execute(array('univer-'.$this->faker->company, $this->faker->city, $this->faker->address));
        }
    }
    private function addTableChairs($count, $idUniver){
        $query = $this->dbconnect->prepare('INSERT INTO chairs (idUniver, nameChairs) VALUES (?, ?)');
        for ($i=0;$i<$count;$i++){
            $idUniver = mt_rand(0,--$idUniver); // Random PRIMARY KEY with table universities.
            $query->execute(array($idUniver,'chairs-'.$this->faker->company));
        }
    }
    private function addTableStudents($count, $idChairs){
        $query = $this->dbconnect->prepare('INSERT INTO students (idChairs,firstnameStudent,lastnameStudent,numberphoneStudent) VALUES (?, ?, ?, ?)');
        for ($i=0;$i<$count;$i++){
            $idChairs = mt_rand(0,--$idChairs);
            $query->execute(array($idChairs,$this->faker->firstName,$this->faker->lastName,$this->faker->phoneNumber));
        }
    }
    private function addTableTeacher($count, $idChairs){
        $query = $this->dbconnect->prepare('INSERT INTO teacher (idChairs, firstnameTeacher, lastnameTeacher) VALUES (?, ?, ?)');
        for ($i=0;$i<$count;$i++){
            $idChairs = mt_rand(0,--$idChairs);
            $query->execute(array($idChairs,$this->faker->firstName,$this->faker->lastName));
        }
    }
    private function addTableDiscipline($count, $idChairs){
        $query = $this->dbconnect->prepare('INSERT INTO discipline (idChairs, nameDiscipline)');
        for ($i=0;$i<$count;$i++){
            $idChairs = mt_rand(0,--$idChairs);
            $query->execute(array($idChairs, 'named'.$this->faker->name));
        }
    }
    private function addTableTtd($count,$idTeacher,$idDiscipline){
        $query = $this->dbconnect->prepare('INSERT INTO teacherToDiscipline (idTeacher,idDiscipline) VALUES (?, ?)');
        for ($i=0;$i<$count;$i++){
            $idTeacher = mt_rand(0,--$idTeacher);
            $idDiscipline = mt_rand(0,--$idDiscipline);
            $query->execute(array($idDiscipline,$idTeacher));
        }
    }
    public function actionIndex(){
        $this->addTableUniversities($this->count["universities"]);
        $this->addTableChairs($this->count["chairs"], $this->count["universities"]);
        $this->addTableStudents($this->count["students"], $this->count["chairs"]);
        $this->addTableTeacher($this->count["teacher"], $this->count["chairs"]);
        $this->addTableDiscipline($this->count["discipline"], $this->count["chairs"]);
        $this->addTableTtd($this->count["teacher"], $this->count["discipline"]);
    }
}


























