<?php

include_once ROOT. '/models/Create.php';

class CreateController
{
    public function actionIndex()
    {

        $result = false;
        $var = new Create();
        $result = $var->createDB(); // Якщо БД буде створена, метод поверне 1
        $label = "true";
        if (!$result){
            $label = "false";
        }

        require_once(ROOT . '/views/create/index'.$label.'.php');

        return true;
    }
}