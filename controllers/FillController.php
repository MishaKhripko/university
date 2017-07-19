<?php

namespace Controllers;

use Models\Fill;

/**
 * Class FillController
 * @package Controllers
 */
class FillController
{
    private $record;

    /**
     *
     */
    public function actionIndex()
    {
        // Метод не приймає параметри. Цей метод відповідає за заповнення БД (faker);
        $var = new Fill();
        $this->record = $var->getReport();

        require_once(ROOT.'/views/fill/index.php');
    }
}