<?php

namespace Controllers;

use Chairs\Chairs;
use Models\Students;

class StudentsController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        if (isset($_POST['idChairs'])) {
            $result = Students::addStudent(
                array(
                    $_POST['idChairs'],
                    $_POST['firstnameStudent'],
                    $_POST['lastnameStudent'],
                    $_POST['numberphoneStudent'],
                )
            );
            if ($result) {
                return $result;
            }
        } else {

            $listStudents = Students::getlistStudents();
            $arrayListChairs = Chairs::getListChairs();

            require_once(ROOT.'/views/students/index.php');

            return true;
        }
    }

    /**
     * @param $idStudent
     * @return bool
     */
    public function actionOpen($idStudent)
    {
        $arrayIdStudent = Students::getStudentById($idStudent);
        $arrayListChairs = Chairs::getListChairs();
        require_once(ROOT.'/views/students/update.php');

        return true;
    }

    /**
     * @param $idStudent
     */
    public function actionDelete($idStudent)
    {
        Students::deleteStudentById($idStudent);
        header('Location: /students');
    }
}