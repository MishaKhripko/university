<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));
require_once __DIR__.'/vendor/autoload.php';

$routes = require_once __DIR__.'/config/routes.php';
$url = '';
if (!empty($_SERVER['REQUEST_URI'])) {
    $url = trim($_SERVER['REQUEST_URI'], '/');
}
foreach ($routes as $uriPattern => $path) {
    //$url = "chairs/open/1";
    if (preg_match("~$uriPattern~", $url)) {
        $internalRoute = preg_replace("~$uriPattern~", $path, $url);
        $segments = explode('/', $internalRoute);
        $controllerName = 'Controllers\\'.ucfirst(array_shift($segments).'Controller');
        $actionName = 'action'.ucfirst(array_shift($segments));
        $parameters = $segments;
        $result = call_user_func_array(array(new $controllerName, $actionName), $parameters);
        if ($result != null) {
            break;
        }
    }
}