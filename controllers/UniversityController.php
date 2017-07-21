<?php

namespace Controllers;

use Models\University;

/**
 * Class UniversityController
 * @package Controllers
 */
class UniversityController
{
    /**
     * Index method. It run query "SELECT * FROM universities" and view this.
     * return: rows
     */
    static public function actionIndex()
    {
        $listUniversity = [];
        if (isset($_POST['submit'])) {
            $result = University::addUniversity(
                array($_POST['nameUniver'], $_POST['cityUniver'], $_POST['siteUniver'])
            );
            if ($result) {
                header('Location: ', '/university');
            }
        }
        $listUniver = University::getListUniversities();

        require_once(ROOT.'/views/university/index.php');
    }

    /**
     * This method open rows with table in new page (example: /univer/open/1)
     * result: row
     *
     * @param $idUniver
     * @return bool
     */
    static public function actionOpen($idUniver)
    {
        $arrayGetRow = University::getUniversityById($idUniver);

        require_once(ROOT.'/views/university/update.php');

        return true;
    }

    /**
     * This method delete rows with table Universities
     * return: true/false delete row
     *
     * @param $idUniver
     */
    static public function actionDelete($idUniver)
    {
        $result = University::deleteUniversityById($idUniver);

        header('Location: /university');
    }
}