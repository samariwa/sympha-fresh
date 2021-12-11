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
            return false;
    }

    public static function getSet($item)
    {
        if(isset($_GET[$item]))
        {
            return true;
        }
            return false;
    }

    public static function postSet($item)
    {
        if(isset($_POST[$item]))
        {
            return true;
        }
            return false;
    }

    public static function requestSet($item)
    {
        if(isset($_REQUEST[$item]))
        {
            return true;
        }
            return false;
    }

    public static function get($item)
    {
        if(isset($_GET[$item]))
        {
            return $_GET[$item];
        }
        return '';
    }

    public static function post($item)
    {
        if(isset($_POST[$item]))
        {
            return $_POST[$item];
        }
        return '';
    }

    public static function request($item)
    {
        if(isset($_REQUEST[$item]))
        {
            return $_REQUEST[$item];
        }
        return '';
    }
}