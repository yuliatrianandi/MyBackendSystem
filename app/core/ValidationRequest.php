<?php

namespace App\Core;

class ValidationRequest
{
    private $error = [];

    /**
     * input example
     * $request = ['name' => 'trianandi'], $options = ['name' => 'required|min:20']
     * running valueValidate('name', 'required|min:20', 'trianandi')
     */ 
    public function __construct($request = [], $options = [])
    {
        foreach ($options as $key => $value) {
            if(isset($request[$key])) {
                $this->valueValidate($key, $value, $request[$key]);
            } else {
                $this->valueValidate($key, $value, '');
            }
        }
    }

    /**
     * Explode options value and running method with params if set
     */
    public function valueValidate($key, $options, $singleRequest = null)
    {
        $options = explode('|', $options);
        foreach ($options as $option) {
            $params = [];
            $params[0] = $key;
            $params[1] = $singleRequest;
            $option = explode(':', $option);
            if (method_exists($this, $option[0])) {
                $method = $option[0];
                unset($option[0]);
                if (isset($option[1])) {
                    array_push($params, $option[1]);
                }
                call_user_func_array([$this, $method], $params);
                unset($params[2]);
            }
        }
    }

    public function required($key, $data)
    {
        if (empty($data)) {
            array_push($this->error, "Error!! " . $key . " Required !");
        }
    }
    
    public function min($key, $data, $param)
    {
        if (strlen($data) < $param) {
            array_push($this->error, "Error!! " . $key . " length minimum = " . $param . " !");
        }
    }
    
    public function max($key, $data, $param)
    {
        if (strlen($data) > $param) {
            array_push($this->error, "Error!! " . $key . " length maximum = " . $param . " !");
        }
    }
    
    public function number($key, $data)
    {
        if (!is_numeric($data)) {
            array_push($this->error, "Error!! The " . $key . " field may only contain number");
        }
    }

    public function alphaNumDashSpace($key, $data)
    {
        if (! preg_match('/^([-a-z0-9_ ])+$/i', $data)) {
            array_push($this->error, "Error!! The " . $key . " field may only contain alpha-numeric, dash, and space");
        }
    }
    
    public function getError()
    {
        return $this->error;
    }
}