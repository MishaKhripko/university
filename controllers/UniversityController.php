<?php

include_once ROOT. '/models/University.php';

class UniversityController
{
    /**
     * Index method. It run query "SELECT * FROM universities" and view this.
     * return: rows
     */
    static public function actionIndex(){
        $listUniversity = [];
        if(isset($_POST['idUniver'])){
            $result = University::addUniversity($_POST['idUniver']);
            if ($result){
                header('Location: ', '/university');
            }
        }
        $listUniver = University::getListUniversities();

        require_once(ROOT.'/views/university/index.php');
    }

    /**
     * @param $idUniver
     * This method open rows with table in new page (example: /univer/open/1)
     * result: row
     */
    static public function actionOpen($idUniver){
        $arrayGetRow = University::getUniversityById($idUniver);

        require_once(ROOT.'/views/university/update.php');
    }

    /**
     * @param $idUniver
     * This method delete rows with table Universities
     * return: true/false delete row
     */
    static public function actionDelete($idUniver){
        $result = University::deleteUniversityById($idUniver);

        header('Location: /university');
    }
}