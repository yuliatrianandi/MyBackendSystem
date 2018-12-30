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

    public function read()
    {
        $this->database->read($this->table);
        return $this->database->single();
    }

    public function readAll()
    {
        $this->database->read($this->table);
        return $this->database->resultSet();
    }

    public function delete()
    {
        return $this->database->delete($this->table);
    }

    public function store($table, $data)
    {
        return $this->database->store($table, $data);
    }

    public function update($table, $data)
    {
        return $this->database->update($table, $data);
    }
}