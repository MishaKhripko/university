<?php

namespace Controllers;

use Models\Students;
use Models\Chairs;

/**
 * Class StudentsController
 * @package Controllers
 */
class StudentsController
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
        $create = $twig->loadTemplate('students.twig');
        $array = array(
            'title' => 'Студенти',
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
        if (isset($_POST['idChairs'])){
            $result = Students::addStudent(array($_POST['idChairs'], $_POST['firstnameStudent'], $_POST['lastnameStudent'], $_POST['numberphoneStudent']));
            if ($result){
                return $result;
            }
        } else
            $listStudents = [];
            if (isset($_POST['search'])) {
                $listStudents = Students::getSearchStudent($_POST['search']);
                $arrayListChairs = Chairs::getListChairs();
                $this->getHTML(array('students' => $listStudents, 'chairs' => $arrayListChairs), false);                //require_once(ROOT . '/views/students/search.php');
                return true;
            } else {
            $listStudents = Students::getlistStudents();
            $arrayListChairs = Chairs::getListChairs();
            $this->getHTML(array('students' => $listStudents, 'chairs' => $arrayListChairs), false);
            //require_once(ROOT.'/views/students/index.php');
            return true;
        }

    }

    /**
     * @param $idStudent
     * @return bool
     */
    public function actionOpen($idStudent){
        $listStudents = Students::getStudentById($idStudent);
        $arrayListChairs = Chairs::getListChairs();
        $this->getHTML(array('students' => $listStudents, 'chairs' => $arrayListChairs), true);
        //require_once(ROOT.'/views/students/update.php');
        return true;
    }

    /**
     * @param $idStudent
     */
    public function actionDelete($idStudent){
        Students::deleteStudentById($idStudent);
        header('Location: /students');
    }
}