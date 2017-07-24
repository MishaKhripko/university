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
    public function actionIndex(){
        $var = new Fill();
        $this->record = $var->getReport();

        require_once(ROOT.'/vendor/twig/twig/lib/Twig/Autoloader.php');
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader);
        $create = $twig->loadTemplate('fill.twig');
        $array = array(
            'title' => 'Заповнити БД',
            'menu' => include(ROOT."/config/menu.php"),
            'content' => $this->record,
    );
        echo $view = $create->render($array);

        //require_once(ROOT . '/views/fill/index.php');
    }
}