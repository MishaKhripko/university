<?php



class StudentsController
{
    public function actionIndex($idStudent){
        if (isset($_POST['idChairs'])){
            $result = Students::addStudent(array($_POST['idChairs'], $_POST['firstnameStudent'], $_POST['lastnameStudent'], $_POST['numberphoneStudent']));
            if ($result){
                return $result;
            }
        } else {

            $listStudents = Students::getlistStudents();

            require_once(ROOT . '/views/students/index.php');
            return true;
        }
    }

    public function actionOpen($idStudent){
        Students::deleteStudentById($idStudent);
        require_once(ROOT.'/views/university/update.php');
    }

    public function actionDelete($idStudent){
        Students::deleteStudentById($idStudent);
        header('Location: /students');
    }
}