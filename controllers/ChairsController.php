<?php

namespace Controllers;

use Models\Chairs;

/**
 * Class ChairsController
 * @package Controllers
 */
class ChairsController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        $listChairs = array();
        $listChairs = Chairs::getListChairs();

        require_once(ROOT.'/views/chairs/index.php');

        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionOpen($id)
    {
        //$id = $id[0];
        $arrayidChairs = array();
        $arrayidChairs = Chairs::getChairsById($id);

        require_once(ROOT.'/views/chairs/update.php');

        return true;
    }
}