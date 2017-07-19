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
    static public function getChairsById($idChairs){
        $db = Db::getConnectionWithDb();
        if (isset($_POST["idChairs"])){
            //switch ($_POST[$update])
            try{
                $result = $db->prepare("
                UPDATE chairs
                SET nameChairs = :nameChairs
                WHERE idChairs = :idChairs;
                ");
                //echo $_POST["nameChairs"]." ".$_POST["idChairs"]." !";
                $result->bindValue(':nameChairs', $_POST["nameChairs"],\PDO::PARAM_STR);
                $result->bindValue(':idChairs',$_POST["idChairs"],\PDO::PARAM_INT);
                if($result->execute()) echo "+";
                else echo "-";
            }
            catch (Exception $exception){
                echo $exception->getMessage();
            }
        }
        else {
            $newList = array();

            try {
                $result = $db->query("
                SELECT chairs.idChairs, universities.nameUniver, chairs.nameChairs 
                FROM chairs INNER JOIN universities ON 
                chairs.idUniver = universities.idUniver
                WHERE chairs.idChairs = " . $idChairs . "
                ORDER BY idChairs ASC
            ");
                return $result->fetch(PDO::FETCH_ASSOC);
            }
            catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
    }
}