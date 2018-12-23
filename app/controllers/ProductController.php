<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models;

class ProductController extends Controller
{
    public function index()
    {
        $data['title'] = "All Product";
        return $this->view('product/index', $data);
    }
}