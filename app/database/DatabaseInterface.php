<?php

namespace App\Database;

interface DatabaseInterface{
    public function connect($dsn, $user = '', $pass = '', $options = null);
    public function readAll($table = null);
}