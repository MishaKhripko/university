<?php

namespace Controllers;

use Models\Chairs;
use Models\University;

/**
 * Class ChairsController
 * @package Controllers
 */
class ChairsController
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
        $create = $twig->loadTemplate('chairs.twig');
        $array = array(
            'title' => 'Кафедри',
            'menu' => include(ROOT."/config/menu.php"),
            'content' => $content,
            'open' => $itIsOpen,
        );
        echo $view = $create->render($array);

    }
    /**
     * @return bool
     */
    public function actionIndex(){
        if(isset($_POST['idUniver']) and isset($_POST['nameChairs'])){
            //echo $_POST['idUniver']." ".$_POST['nameChairs'];
            $result = Chairs::addRecord(array($_POST['idUniver'], $_POST['nameChairs']));
            if ($result)
                header('Location: /chairs');
        }
        $listChairs = Chairs::getListChairs();
        $listUniversities = University::getIdNameUniversities();
        $this->getHTML(array('chairs' => $listChairs, 'universities' => $listUniversities), false);
        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function actionOpen($id){
        $listChairs = Chairs::getChairsById($id);
        $listUniversities = University::getIdNameUniversities();
        $this->getHTML(array('chairs' => $listChairs, 'universities' => $listUniversities), true);
        //require_once(ROOT.'/views/chairs/update.php');
        return true;
    }
    private function viewContent($content){
        require_once(ROOT.'/vendor/twig/twig/lib/Twig/Autoloader.php');
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader);
        $create = $twig->loadTemplate('chairs.twig');
        $array = array(
            'title' => 'Кафедра',
            'menu' => include(ROOT."/config/menu.php"),
            'content' =>$content,
        );
        echo $view = $create->render($array);
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