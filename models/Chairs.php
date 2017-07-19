<?php


class Chairs
{
    static public function getListChairs(){
        $db = Db::getConnectionWithDb();
        $newsList = array();

        $result = $db->query('
        SELECT chairs.idChairs, universities.nameUniver, chairs.nameChairs 
        FROM chairs INNER JOIN universities ON 
        chairs.idUniver = universities.idUniver 
        ORDER BY idChairs ASC
        ');
        $i = 0;
        while($row = $result->fetch()) {
            $newsList[$i]['idChairs'] = $row['idChairs'];
            $newsList[$i]['nameUniver'] = $row['nameUniver'];
            $newsList[$i]['nameChairs'] = $row['nameChairs'];
            $i++;
        }
        return $newsList;
    }

}