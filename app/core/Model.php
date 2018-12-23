<?php

namespace App\Core;

use App\Core\Database;

abstract class Model
{
    protected $table;
    protected $dbh;

    public function getMysqlConnection(){
        return new Database();
    }
}