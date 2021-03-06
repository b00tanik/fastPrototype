<?php
/**
 * User: b00tanik
 * Date: 24.07.11
 * Time: 2:23
 */

class Cookies extends Registry {

    public static function set($name, $val){
       setcookie($name, $val, time()+31536000,'/');
    }

    public static function get($name){
      return $_COOKIE[$name];
    }

    public static function isSetted($name){
        return isset($_COOKIE[$name]);
    }

    public static function del($name){
        setcookie($name, "", time()-3600,'/');
        unset($_COOKIE[$name]);
    }
}
