<?php

namespace App\Database;

use App\Database\AbstractDatabase;
use App\Database\DatabaseInterface;

use \PDO;

class Mysql extends AbstractDatabase implements DatabaseInterface
{
    private $host = MYSQL_HOST;
    private $dbname = MYSQL_NAME;
    private $charset = MYSQL_CHARSET;
    private $user = MYSQL_USER;
    private $pass = MYSQL_PASS;
    private $select = [];
    private $where = [];
    private $orderBy = [];
    private $orderOptions = '';

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
    
    public function querySelect()
    {
        if (empty($this->select)) {
            $query = "SELECT * FROM ";
            return $query;
        } else {
            $query = "SELECT ";
            $query = $this->merge($query, $this->select, "", ", ");
            $query = $query . " FROM ";
            return $query;
        }
    }
    
    public function queryWhere($query)
    {
        if (empty($this->where)) {
            return $query;
        } elseif(isset($this->where['WHERE'])) {
            $query = $query . " WHERE ";
            $query = $query . $this->where['WHERE'];
            return $query;
        }else {
            $query = $query . " WHERE ";
            $query = $this->merge($query, $this->where, "", ', ', ' = :');
            return $query;
        }
    }
    
    public function queryOrderBy($query)
    {
        if (empty($this->orderBy)) {
            return $query;
        } else {
            $query = $query . " ORDER BY ";
            $query = $this->merge($query, $this->orderBy, "", ", ");
            $query = $query . $this->orderOptions;
            return $query;
        }
    }

    public function read($table = null)
    {
        $query = $this->querySelect();
        $query = $query . $table;
        $query = $this->queryWhere($query);
        $query = $this->queryOrderBy($query);
        $this->query($query);
        if (!empty($this->where)) {
            $this->bindAll($this->where);
        }
        $this->execute();
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

    public function delete($table = null)
    {
        $query = "DELETE FROM " . $table;
        $query = $this->queryWhere($query);
        $this->query($query);
        if (!empty($this->where)) {
            $this->bindAll($this->where);
        }
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

    public function search($table, $keyword, $column = [], $operator = 'OR')
    {
        $query = "SELECT * FROM " . $table . " WHERE ";
        $index = 0;
        foreach ($column as $value) {
            if ($index == 0) {
                $query = $query . $value . " LIKE :keyword";
            } else {
                $query = $query . ' ' . $operator . ' ' . $value . " LIKE :keyword";
            }
            $index += 1;
        }
        echo $query;
        $this->query($query);
        $this->bind(':keyword', "%$keyword%");
        $this->execute();
        return $this->resultSet();
    }
    
    public function setSelect($select = [])
    {
        $this->select = $select;
    }

    public function setWhere($where = [])
    {
        $this->where = $where;
    }

    public function setOrderBy($orderBy = [])
    {
        $this->orderBy = $orderBy;
    }

    public function setOrderOption($orderOption = "")
    {
        $this->orderOption = $orderOption;
    }
}