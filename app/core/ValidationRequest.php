<?php

namespace App\Core;

class ValidationRequest
{
    private $error = [];

    public function __construct($request = [], $options = [])
    {
        foreach ($options as $key => $value) {
            if(isset($request[$key])) {
                $this->valueValidate($request[$key], $key, $value);
            } else {
                $this->valueValidate('', $key, $value);
            }
        }
    }
    public function valueValidate($singleRequest = null, $key, $options)
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

    public function isValid()
    {
        if (empty($this->error)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function getError()
    {
        return $this->error;
    }
}