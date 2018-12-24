<?php

namespace App\Core;

interface DatabaseInterface{
    public function connect($dsn, $user = '', $pass = '', $options = null);
    public function readAll($table = null);
}