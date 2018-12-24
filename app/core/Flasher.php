<?php

namespace App\Core;

class Flasher
{
    public static function setFlash($message = [], $action, $type)
    {
        $index = 0;
        foreach ($message as $key) {
            $error = [
                'message' => $key,
                'action' => $action,
                'type' => $type
            ];
            $_SESSION['flash'][$index] = $error;
            $index += 1;
        }
    }
    
    public static function getFlash()
    {
        if(isset($_SESSION['flash'])){
            foreach ($_SESSION['flash'] as $key) {
                echo '<div class="alert alert-' . $key['type'] . '" role="alert">
                            <strong> ' . 
                                $key['message'] . 
                            '</strong>' . $key['action'] . 
                        '</div>';
            }
            unset($_SESSION['flash']);
        }
    }

    public static function setRequest($value = [])
    {
        unset($_SESSION['request']);
        $_SESSION['request'] = $value;
    }

    public static function getRequest()
    {
        if (isset($_SESSION['request'])) {
            $value = $_SESSION['request'];
            unset($_SESSION['request']);
            return $value;
        } else {
            return null;
        }
    }
}