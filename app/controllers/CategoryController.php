<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Database\Mysql;
use \App\Core\Flasher;

class CategoryController extends Controller
{
    private $modelName = "Category";

    public function index()
    {
        //set title and keyword
        $data["title"] = "All " . $this->modelName;
        if (isset($_POST["keyword"])) {
            $data["keyword"] = $_POST["keyword"];
            unset($_POST["keyword"]);
        } else {
            $data["keyword"] = "";
        }

        //set category
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql());
        $data["category"] = $category->readAll();

        return $this->view("category/index", $data);
    }

    public function create()
    {
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql);

        $data["title"] = "Create New " . $this->modelName;
        $data["category"]["tree"] = $category->getTree();

        return $this->view("category/create",$data);
    }

    public function store()
    {
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql());

        //validate request
        $validation = $this->validate($_POST, [
            "name" => "required|alphaNumDashSpace|min:3|max:100"
            ]);

        if(!empty($validation->getError())) {
            Flasher::setFlash($validation->getError(), " Create New " . $this->modelName, "danger");
            $err = [
                "name" => $_POST["name"],
                "parent_id" => $_POST["parent_id"]
            ];
            Flasher::setRequest($err);
            header("Location: " . BASEURL . "/category/create/");
            exit;
        }
        //setting value
        $category->name = $_POST["name"];
        $category->parent_id = $_POST["parent_id"];
        $id = $category->save();
        
        if ($id != 0) {
            Flasher::setFlash(["Success ! "], " Create New " . $this->modelName, "success");
            header("Location: " . BASEURL . "/category/show/" . $id);
            exit;
        } else {
            Flasher::setFlash(["Failed ! "], " Create New " . $this->modelName, "danger");
            $err = [
                "name" => $_POST["name"],
                "parent_id" => $_POST["parent_id"]
            ];
            Flasher::setRequest($err);
            header("Location: " . BASEURL . "/category/create/");
            exit;
        }
    }
    
    public function show($id)
    {
        $data["title"] = $this->modelName . " Details";
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql);
        $data["category"] = $category->read($id);
        return $this->view("category/show",$data);
    }
    
    public function edit($id)
    {
        $data["title"] = $this->modelName . " Details";
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql);
        $data["category"] = $category->read($id);
        $data["category"]["tree"] = $category->getTree();
        return $this->view("category/edit",$data);
    }

    public function update($id)
    {
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql());
    
        //validate request
        $validation = $this->validate($_POST, [
            "name" => "required|alphaNumDashSpace|min:3|max:100"
            ]);
    
        if(!empty($validation->getError())) {
            Flasher::setFlash($validation->getError(), " Update " . $this->modelName, "danger");
            $err = [
                "name" => $_POST["name"],
                "parent_id" => $_POST["parent_id"]
            ];
            Flasher::setRequest($err);
            header("Location: " . BASEURL . "/category/edit/". $id);
            exit;
        }
        //setting value
        $category->id = $id;
        $category->name = $_POST["name"];
        $category->parent_id = $_POST["parent_id"];
        $row = $category->save();
        
        if ($row > 0) {
            Flasher::setFlash(["Success ! "], " Update " . $this->modelName, "success");
            header("Location: " . BASEURL . "/category/show/" . $id);
            exit;
        } else {
            Flasher::setFlash(["Failed ! Please insert any change"], " Update " . $this->modelName, "danger");
            $err = [
                "name" => $_POST["name"],
                "parent_id" => $_POST["parent_id"]
            ];
            Flasher::setRequest($err);
            header("Location: " . BASEURL . "/category/edit/" . $id);
            exit;
        }
    }

    public function delete($id)
    {
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql);

        if($category->delete($id)>0) {
            Flasher::setFlash(["Success !! "], "Delete the " . $this->modelName, "success");
        } else {
            Flasher::setFlash(["Failed !! "], "Delete the " . $this->modelName, "danger");
        }
        header("Location: " . BASEURL . "/category/index");
        exit;
    }

    public function search()
    {
        $category = $this->model($this->modelName);
        $category->setDatabase(new Mysql);

        if(isset($_POST['keyword'])){
            $keyword = $_POST['keyword'];
        }else{
            Flasher::setFlash(['Failed! '], 'Empty keyword', 'danger');
            header('Location: '.BASEURL.'/category/index');
            exit;
        }

        $data['title'] = "All Category";
        $data['keyword'] = $keyword;
        $data['category'] = $category->search($keyword);
        
        return $this->view('category/index',$data);
    }
}