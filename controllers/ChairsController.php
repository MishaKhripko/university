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
}