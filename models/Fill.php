<?php

class Fill
{
    private $faker;
    private $dbconnect;
    public function __construct()
    {
        $paramsPath = ROOT . '/config/createdb.php';
        $this->params = include($paramsPath);
        $this->dbconnect = Db::getConnection();
        $this->faker = Faker\Factory::create('uk_UA');
    }
    private function addUniversities($count){
        $sth = $this->dbconnect->prepare('INSERT INTO universities (nameUniver, cityUniver, siteUniver) VALUES (?, ?, ?)');
        for ($i=0;$i<$count;$i++){
            $sth->execute(array('univer-'.$this->faker->company, $this->faker->city, $this->faker->address));
            $red = $sth->fetchAll();
        }

    }
    public function actionIndex(){
        $this->addUniversities(3);

    }
}