<?php

namespace App\Models;

use App\Core\Model;

class Product extends Model
{
    public function __construct(){
        $this->dbh = $this->getMysqlConnection();
    }
}