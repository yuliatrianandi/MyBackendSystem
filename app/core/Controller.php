<?php

namespace App\Core;

use App\Core\ValidationRequest;

abstract class Controller
{
    public function view($view, $data = [])
    {
        if ($_SESSION['user'] == 'admin') {
            $user = 'backend/';
        } else {
            $user = '';
        }
        require_once __DIR__.'/../../resources/views/'.$user.'partials/_header.php';
        require_once __DIR__.'/../../resources/views/'.$user.$view.'.php';
        require_once __DIR__.'/../../resources/views/'.$user.'partials/_footer.php';
    }

    public function model($model)
    {
        $model = "\App\\Models\\".$model;
        return new $model;
    }

    public function validate($request = [], $options = [])
    {
        return new ValidationRequest($request, $options);
    }
}