<?php

namespace App\Models;

use App\Models\AbstractModel;

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

    //create if $id == null, update if $id has been set.
    //this function returning lastInsertId() for last created product.
    public function save()
    {
        if (is_null($this->id)) {
            $data = [
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price
            ];
            return $this->database->store($this->table, $data);
        } else {
            $data = [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price
            ];
            return $this->update($this->table, $data);
        }
    }

    public function search($keyword)
    {
        $column = ['name', 'description'];
        $operator = 'OR';
        return $this->database->search($this->table, $keyword, $column, $operator);
    }
}