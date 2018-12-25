<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Database\Mysql;
use \App\Core\Flasher;

class ProductController extends Controller
{
    public function index()
    {
        //set title and keyword
        $data['title'] = "All Product";
        if (isset($_POST['keyword'])) {
            $data['keyword'] = $_POST['keyword'];
        } else {
            $data['keyword'] = "";
        }

        //set product
        $product = $this->model('Product');
        $product->setDatabase(new Mysql());
        $data['product'] = $product->readAll();

        return $this->view('product/index', $data);
    }

    public function create(){
        $data['title'] = "Create New Product";
        $data['product'] = [
            'name' => '',
            'description' => '',
            'price' => ''
        ];
        return $this->view('product/create',$data);
    }

    public function store()
    {
        $product = $this->model('Product');
        $product->setDatabase(new Mysql());

        //validate request
        $validation = $this->validate($_POST, [
            'name' => 'required|alphaNumDashSpace|min:3|max:100',
            'description' => 'required',
            'price' => 'required|number|min:3|max:100'
            ]);

        if(!empty($validation->getError())) {
            Flasher::setFlash($validation->getError(), ' Create New Product', 'danger');
            $err = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];
            Flasher::setRequest($err);
            header('Location: ' . BASEURL . '/product/create/');
            exit;
        }
        //setting value
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $id = $product->save();
        
        if ($id != 0) {
            Flasher::setFlash(['Success ! '], ' Create New Product', 'success');
            header('Location: ' . BASEURL . '/product/show/' . $id);
            exit;
        } else {
            Flasher::setFlash(['Failed ! '], ' Create New Product', 'danger');
            $err = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];
            Flasher::setRequest($err);
            header('Location: ' . BASEURL . '/product/create/');
            exit;
        }
    }
    
    public function show($id)
    {
        $data['title'] = "Product Details";
        $product = $this->model('Product');
        $product->setDatabase(new Mysql);
        $data['product'] = $product->read($id);
        return $this->view('product/show',$data);
    }
    
    public function edit($id)
    {
        $data['title'] = "Product Details";
        $product = $this->model('Product');
        $product->setDatabase(new Mysql);
        $data['product'] = $product->read($id);
        return $this->view('product/edit',$data);
    }

    public function update($id)
    {
        $product = $this->model('Product');
        $product->setDatabase(new Mysql());
    
        //validate request
        $validation = $this->validate($_POST, [
            'name' => 'required|alphaNumDashSpace|min:3|max:100',
            'description' => 'required',
            'price' => 'required|number|min:3|max:100'
            ]);
    
        if(!empty($validation->getError())) {
            Flasher::setFlash($validation->getError(), ' Update Product', 'danger');
            $err = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];
            Flasher::setRequest($err);
            header('Location: ' . BASEURL . '/product/edit/'. $id);
            exit;
        }
        //setting value
        $product->id = $id;
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $row = $product->save();
        
        if ($row > 0) {
            Flasher::setFlash(['Success ! '], ' Update Product', 'success');
            header('Location: ' . BASEURL . '/product/show/' . $id);
            exit;
        } else {
            Flasher::setFlash(['Failed ! Please insert any change'], ' Update Product', 'danger');
            $err = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price']
            ];
            Flasher::setRequest($err);
            header('Location: ' . BASEURL . '/product/edit/' . $id);
            exit;
        }
    }

    public function delete($id)
    {
        $product = $this->model('Product');
        $product->setDatabase(new Mysql);

        if($product->delete($id)>0) {
            Flasher::setFlash(['Success !! '], 'Delete the Product', 'success');
        } else {
            Flasher::setFlash(['Failed !! '], 'Delete the Product', 'danger');
        }
        header('Location: ' . BASEURL . '/product/index');
        exit;
    }
    
    public function search()
    {
        $product = $this->model('Product');
        $product->setDatabase(new Mysql);

        if(isset($_POST['keyword'])){
            $keyword = $_POST['keyword'];
        }else{
            Flasher::setFlash(['Failed! '], 'Empty keyword', 'danger');
            header('Location: '.BASEURL.'/product/index');
            exit;
        }

        $data['title'] = "All Product";
        $data['keyword'] = $keyword;
        $data['product'] = $product->search($keyword);
        
        return $this->view('product/index',$data);
    }
}