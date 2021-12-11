<?php
class Input{
    public static function exists($type = 'post')
    {
        switch($type)
        {
            case 'post':
                return (!empty($_POST)) ? true : false;
            break;
            case 'get':
                return (!empty($_GET)) ? true : false;
            break;
            case 'request':
                return (!empty($_REQUEST)) ? true : false;
            break;    
            default:
                return false;
            break;            
        }
    }

    public static function set($item)
    {
        if(isset($_POST[$item]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function get($item)
    {
        if(isset($_POST[$item]))
        {
            return $_POST[$item];
        }
        elseif(isset($_GET[$item]))
        {
            return $_GET[$item];
        }
        elseif(isset($_REQUEST[$item]))
        {
            return $_REQUEST[$item];
        }
        return '';
    }
}