<?php

include_once ROOT. '/models/Create.php';

class CreateController
{
    public function actionIndex()
    {
        $result = false;
        $var = new Create();
        $result = $var->createDB(); // Якщо БД буде створена, метод поверне 1
        require_once(ROOT . '/views/create/index.php');
        return true;
    }
}