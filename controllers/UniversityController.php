<?php

namespace Controllers;
use Models\University;

class UniversityController
{
    /**
     * @param $content
     * @param $itIsOpen
     */
    private function getHTML($content, $itIsOpen){
        require_once(ROOT.'/vendor/twig/twig/lib/Twig/Autoloader.php');
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader, array(
            'debug' => true));
        $create = $twig->loadTemplate('univer.twig');
        $array = array(
            'title' => 'Університет',
            'menu' => include(ROOT."/config/menu.php"),
            'content' => $content,
            'open' => $itIsOpen,
        );
        echo $view = $create->render($array);

    }
    /**
     * Index method. It run query "SELECT * FROM universities" and view this.
     * return: rows
     */
    public function actionIndex(){
        $listUniversity = [];
        if(isset($_POST['submit'])){
            $result = University::addUniversity(array($_POST['nameUniver'], $_POST['cityUniver'], $_POST['siteUniver']));
            if ($result){
                header('Location: ', '/university');
            }
        }
        $listUniver = University::getListUniversities();
        $this->getHTML($listUniver, false);
        //require_once(ROOT.'/views/university/index.php');
    }

    /**
     * @param $idUniver
     * This method open rows with table in new page (example: /univer/open/1)
     * result: row
     */
    public function actionOpen($idUniver){
        $arrayGetRow = University::getUniversityById($idUniver);
        $this->getHTML($arrayGetRow, true);
        //require_once(ROOT.'/views/university/update.php');
        return true;
    }

    /**
     * @param $idUniver
     * This method delete rows with table Universities
     * return: true/false delete row
     */
    public function actionDelete($idUniver){
        $result = University::deleteUniversityById($idUniver);
        header('Location: /university');
    }
}