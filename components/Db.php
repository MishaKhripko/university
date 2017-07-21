<?php

namespace Components;

class Db
{
    /**
     * @return \PDO|string
     */
    public static function getConnectionWithDb()
    {
        $paramsPath = ROOT.'/config/db_params.php';
        $params = include($paramsPath);

        try {
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            $db = new \PDO($dsn, $params['user'], $params['password']);

            return $db;
        } catch (\Exception $exception) {
            //if (preg_replace('/^Unknown database ^/',$exception->getMessage()) ){
            return "notdb";
        }
    }

    /**
     * @return \PDO|string
     */
    public static function getConnection()
    {
        $paramsPath = ROOT.'/config/db_params.php';
        $params = include($paramsPath);

        try {
            $dsn = "mysql:host={$params['host']}";
            $db = new \PDO($dsn, $params['user'], $params['password']);

            return $db;
        } catch (\Exception $exception) {
            return "notdb";
        }
    }
}