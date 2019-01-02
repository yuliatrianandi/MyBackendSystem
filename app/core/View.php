<?php

namespace App\Core;

class View
{
    public function getCategoryOption($array, $pre = "-")
    {
        $result = '';
        foreach($array as $key){
            $result = $result . '<option value = "' . $key['id']. '" >';
            $result = $result . $pre . $key['name'];
            $result = $result . '</option>';
            if(isset($key['child'])){
                $result = $result . $this->getCategoryOption($key['child'],'&nbsp;&nbsp;&nbsp;&nbsp;' . $pre);
            }
        }
        return $result;
    }
}