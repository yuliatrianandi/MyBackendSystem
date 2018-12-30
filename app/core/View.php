<?php

namespace App\Core;

class View
{
    public static function getCategoryOption($array, $pre = "")
    {
        foreach($array as $key){
            if(!isset($key['child'])){
                $result = '<option value = "' . $key['id']. '" >';
                $result = $result . $pre . $key['name'];
                $result = $result . '</option>';
            } else {
                var_dump($key['child']);
                $pre = $pre . '-';
                $result = $result . getCategoryOption($key['child'], $pre);
            }
        }
        return $result;
    }
}