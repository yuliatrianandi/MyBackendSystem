<?php

namespace App\Database;

use App\Core\AbstractDatabase;
use App\Core\DatabaseInterface;

use \PDO;

class Mysql extends AbstractDatabase implements DatabaseInterface
{
    private $host = MYSQL_HOST;
    private $dbname = MYSQL_NAME;
    private $charset = MYSQL_CHARSET;
    private $user = MYSQL_USER;
    private $pass = MYSQL_PASS;

    public function __construct()
    {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname.";charset=".$this->charset;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        $this->connect($dsn, $this->user, $this->pass, $options);
    }

    public function connect($dsn, $user = '', $pass = '', $options = null)
    {
        try {
            $this->dbh = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    
    public function readAll($table = null)
    {
        $query = "SELECT * FROM " . $table;
        $this->query($query);
        $this->execute();
        return $this->resultSet();
    }

    public function read($table = null, $id)
    {
        $query = "SELECT * FROM " . $table . " WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->single();
    }
    
    public function store($table = null, $data = [])
    {
        $query = "INSERT INTO " . $table . " (";
        $query = $this->merge($query, $data, "", ', ');
        $query = $query . ") VALUES (";
        $query = $this->merge($query, $data, ':', ', :');
        $query = $query . ")";
        $this->query($query);
        $this->bindAll($data);
        $this->execute();
        return $this->lastInsertId();
        
    }

    public function update($table = null, $data = [])
    {
        $id = $data['id'];
        unset($data['id']);
        $query = "UPDATE " . $table . " SET ";
        $query = $this->merge($query, $data, "", ', ', ' = :');
        $query = $query . " WHERE id = :id";
        $data['id'] = $id;
        $this->query($query);
        $this->bindAll($data);
        $this->execute();
        return $this->rowCount();        
    }

    public function delete($table = null, $id)
    {
        $query = "DELETE FROM " . $table . " WHERE id = :id";
        $this->query($query);
        $this->bind(':id', $id);
        $this->execute();
        return $this->rowCount();
    }

    public function merge($query, $data = [], $first, $last, $update = null)
    {
        $i = 0;
        foreach ($data as $key => $value) {
            if ($i == 0) {
                if (is_null($update)) {
                    $query = $query . $first . $key;
                } else {
                    $query = $query . $first . $key . $update . $key;
                }
            } else {
                if (is_null($update)) {
                    $query = $query . $last . $key;
                } else {
                    $query = $query . $last . $key . $update . $key;
                }
            }
            $i += 1;
        }
        return $query;
    }

    public function bindAll($data = [])
    {
        foreach ($data as $key => $value) {
            $this->bind(":" . $key, $value);
        }
    }

    public function search($table, $keyword)
    {
        $query = "SELECT * FROM " . $table . " WHERE name LIKE :keyword";
        $this->query($query);
        $this->bind(':keyword', "%$keyword%");
        $this->execute();
        return $this->resultSet();
    }
}