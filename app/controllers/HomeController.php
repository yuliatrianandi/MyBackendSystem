<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = "Home";
        return $this->view('home/index', $data);
    }
}