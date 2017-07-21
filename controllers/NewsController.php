<?php

namespace Controllers;

use Models\News;

/**
 * Class NewsController
 * @package Controllers
 */
class NewsController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();

        require_once(ROOT.'/views/news/index.php');

        return true;
    }
}

