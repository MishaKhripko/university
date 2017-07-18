<?php

include_once ROOT. '/models/Fill.php';

class FillController
{
    public function actionIndex(){
        // Метод не приймає параметри. Це метод відповідає за заповнення БД (faker);
        $var = new Fill();
        $result = $var->actionIndex();
    }
}