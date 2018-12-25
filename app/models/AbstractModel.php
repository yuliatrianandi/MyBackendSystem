<?php

namespace App\Models;

use App\Database\DatabaseInterface;

abstract class AbstractModel
{
    protected $table;
    protected $database = null;

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function setDatabase(DatabaseInterface $database){
        $this->database = $database;
    }
}