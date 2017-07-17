<?php

class Create
{
    public function createDB(){
        echo ROOT.'/config/createdb.sql';
        $query = fopen(ROOT.'/config/createdb.txt','r');
        $query = "CREATE DATABASE university;";
        $db = Db::getConnection();
        echo "<br>".$query;
        if ($db !== null) {
            $result = $db->exec($query) or die(print_r($db->errorInfo(), true)); // Виконає запит що в /config/createdb.sql (створить бд)
            if ($result) {
                return true;
            } else {
                return false;
            }
        }
    }
}