<?php

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Home";
        return $this->view('home/index', $data);
    }
}