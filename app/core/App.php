<?php

namespace App\Core;

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params =[];
    private $url;

    public function __construct()
    {
        $this->url = $this->parseUrl();

        $this->controller = $this->setController();
        
        $this->setMethod();

        $this->setParams();

        call_user_func_array([$this->controller,$this->method],$this->params);
    }

    //Filter url then explode url to an array
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    //Set Controller depends on url[0]
    public function setController()
    {
        if (isset($this->url[0])) {
            if (file_exists(__DIR__.'/../controllers/'.$this->url[0].'Controller.php')) {
                $this->controller = '\App\\Controllers\\'.ucfirst($this->url[0]).'Controller';
            }
            unset($this->url[0]);
        }
        return new $this->controller;
    }

    //Set Method depends on url[1]
    public function setMethod()
    {
        if (isset($this->url[1])) {
            if (method_exists($this->controller, $this->url[1])) {
                $this->method = $this->url[1];
            }
            unset($this->url[1]);
        }
    }
    
    //Set Params from the rest of an arrays (url)
    public function setParams(){
        if (isset($this->url)) {
            $this->params = array_values($this->url);
            unset($this->url);
        }
    }
}