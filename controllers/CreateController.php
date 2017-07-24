<?php

namespace Controllers;
use Models\Create;

/**
 * Class CreateController
 * @package Controllers
 */
class CreateController
{
    public function actionIndex()
    {
        $result = false;
        $var = new Create();
        $result = $var->createDB(); // Якщо БД буде створена, метод поверне 1

        require_once(ROOT.'/vendor/twig/twig/lib/Twig/Autoloader.php');
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem('templates');
        $twig = new \Twig_Environment($loader);

        if ($result) $text = "База даних створена";
        else
            $text = "Неможливо створити базу даних. База даних вже існує.";
        $create = $twig->loadTemplate('create.twig');
        $array = array('text' => $text, 'menu' => include(ROOT."/config/menu.php"));
        echo $view = $create->render($array);


        return true;
    }
}