<?php

class Create
{
    public function createDB(){
        $query = fopen(ROOT.'/config/createdb.sql','rt');
        $db = Db::getConnection();
        $result = $db->exec($query); // Виконає запит що в /config/createdb.sql (створить бд)
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}