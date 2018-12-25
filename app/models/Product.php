<?php

namespace App\Models;

use App\Core\AbstractModel;
use App\Core\DatabaseInterface;

class Product extends AbstractModel
{
    public $id = null;
    public $name;
    public $description;
    public $price;

    public function __construct()
    {
        $this->setTable('products');
    }

    public function read($id)
    {
        return $this->database->read($this->table, $id);
    }

    public function readAll()
    {
        return $this->database->readAll($this->table);
    }

    //create if $id == null, update if $id has been set.
    //this function returning lastInsertId() for last created product.
    public function save()
    {
        if (is_null($this->id)) {
            return $this->database->store($this->table, [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price
                ]);
        } else {
            return $this->database->update($this->table, [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price
                ]);
        }
    }

    public function delete($id)
    {
        return $this->database->delete($this->table, $id);
    }

    public function search($keyword)
    {
        $column = ['name', 'description'];
        $operator = 'OR';
        return $this->database->search($this->table, $keyword, $column, $operator);
    }
}