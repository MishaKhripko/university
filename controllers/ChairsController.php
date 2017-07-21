<?php

namespace Controllers;

use Chairs\Chairs;
use Models\University;

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
        if (isset($_POST['idUniver']) and isset($_POST['nameChairs'])) {
            //echo $_POST['idUniver']." ".$_POST['nameChairs'];
            $result = Chairs::addRecord(array($_POST['idUniver'], $_POST['nameChairs']));
            if ($result) {
                header('Location: /chairs');
            }
        }
        $listChairs = Chairs::getListChairs();
        $listUniversities = University::getIdNameUniversities();

        require_once(ROOT.'/views/chairs/index.php');

        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionOpen($id)
    {
        $arrayidChairs = Chairs::getChairsById($id);

        require_once(ROOT.'/views/chairs/update.php');

        return true;
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $result = Chairs::deleteChairsById($id);
        header('Location: /chairs');
    }
}