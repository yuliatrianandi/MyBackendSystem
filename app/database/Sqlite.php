<?php

namespace App\Database;

use App\Database\AbstractDatabase;
use App\Database\DatabaseInterface;

class Sqlite extends AbstractDatabase implements DatabaseInterface
{
    public function __construct()
    {
        $dsn = "sqlite:".SQLITE_PATH;
        $this->connect($dsn);
    }

    public function connect($dsn, $user = '', $pass = '', $options)
    {
        $this->dbh = new PDO($dsn);
    }

    public function readAll($table = null)
    {
        return "sqlite readAll works later";
    }
}