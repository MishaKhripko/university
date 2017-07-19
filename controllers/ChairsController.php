<?php

include_once ROOT. '/models/Chairs.php';

class ChairsController
{
    public function actionIndex(){
        $listChairs = array();
        $listChairs = Chairs::getListChairs();

        require_once(ROOT . '/views/chairs/index.php');

        return true;
    }
    public function actionOpen($id){
        //$id = $id[0];
        $arrayidChairs = array();
        $arrayidChairs = Chairs::getChairsById($id);

        require_once(ROOT . '/views/chairs/update.php');

        return true;
    }
}