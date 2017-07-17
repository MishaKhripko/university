<?php

include_once ROOT. '/models/Create.php';

class CreateController
{
    public function actionIndex()
    {

        $result = false;
        $result = Create::createDB(); // Якщо БД буде створена, метод поверне 1
        $label = "true";
        if (!$result){
            $label = "false";
        }

        require_once(ROOT . '/views/news/index'.$label.'.php');

        return true;
    }
}