<?php

include_once ROOT. '/models/Chairs.php';

class ChairsController
{
    public function actionIndex(){
        if(isset($_POST['idUniver']) and isset($_POST['nameChairs'])){
            echo $_POST['idUniver']." ".$_POST['nameChairs'];
            $result = Chairs::addRecord(array($_POST['idUniver'], $_POST['nameChairs']));
            if ($result)
                header('Location: /chairs');
        }
        $listChairs = [];
        $listUniversities = [];
        $listChairs = Chairs::getListChairs();
        $listUniversities = University::getIdNameUniversities();

        require_once(ROOT . '/views/chairs/index.php');

        return true;
    }

    public function actionOpen($id){
        $arrayidChairs = array();
        $arrayidChairs = Chairs::getChairsById($id);

        require_once(ROOT . '/views/chairs/update.php');

        return true;
    }
    public function actionDelete($id)
    {
        $result = Chairs::deleteChairsById($id);
        header('Location: /chairs');
    }
}