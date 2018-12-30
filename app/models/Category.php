<?php

namespace App\Models;

use App\Models\AbstractModel;

class Category extends AbstractModel
{
    public $id = null;
    public $name;
    public $parent_id;

    public function __construct()
    {
        $this->setTable('categories');
    }

    //create if $id == null, update if $id has been set.
    //this function returning lastInsertId() for last created product.
    public function save()
    {
        if (is_null($this->id)) {
            $data = [
                'name' => $this->name,
                'parent_id' => $this->parent_id
            ];
            return $this->database->store($this->table, $data);
        } else {
            $data = [
                'id' => $this->id,
                'name' => $this->name,
                'parent_id' => $this->parent_id
            ];
            return $this->update($this->table, $data);
        }
    }

    public function search($keyword)
    {
        $column = ['name'];
        $operator = 'OR';
        return $this->database->search($this->table, $keyword, $column, $operator);
    }

    public function getTree()
    {
        $this->database->setSelect([
            'id' => '',
            'name' => ''
        ]);
        $this->database->setOrderBy([
            'parent_id' => ''
        ]);
        $tree = $this->getChild();
        return $tree;
    }

    public function getChild($parent_id = 0)
    {
        $this->database->setWhere([
            'parent_id' => $parent_id
        ]);
        $category = $this->readAll($this->table);
        $tree = [];
        if (!empty($category)) {
            foreach ($category as $key) {
                $tree[$key['id']]['name'] = $key['name'];
                $tree[$key['id']]['id'] = $key['id'];
                if (!is_null($this->getChild($key['id']))) {
                    $tree[$key['id']]['child'] = $this->getChild($key['id']);
                }
            }
            return $tree;
        } else {
            return null;
        }
    }
}