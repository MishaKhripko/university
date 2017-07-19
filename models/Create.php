<?php

namespace Models;

use Components\Db;

/**
 * Class Create
 * @package Models
 */
class Create
{
    private $params;
    private $dbconnect;

    /**
     * Create constructor.
     */
    public function __construct()
    {
        $paramsPath = ROOT.'/config/createdb.php';
        $this->params = include($paramsPath);
        $this->dbconnect = Db::getConnection();
    }

    /**
     * @return bool|int
     */
    public function createDB()
    {
        $listDB = $this->dbconnect->query('SHOW DATABASES');
        $listDB = $listDB->fetchAll(\PDO::FETCH_COLUMN, 0);
        $bool = 0;
        foreach ($listDB as $value) {
            if ($value === "university") {
                $bool = 0;
                break;
                //echo "<br>$value";
            } else {
                $bool = 1;
            }
        }
        if ($bool) {
            return $this->executeQueryDB();
        } else {
            return $bool;
        }
    }

    /**
     * @return bool
     */
    private function executeQueryDB()
    {
        foreach ($this->params as $key => $value) {
            try {
                $result = $this->dbconnect->exec($value);// or die(print_r($db->errorInfo(), false));
                $this->dbconnect->errorCode();

                return true;
            } catch (\Exception $exception) {
                //echo $exception->getMessage();
                return false;
            }
        }
    }
}