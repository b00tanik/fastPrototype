<?php
/**
 * Registry
 * 
 * @package ${Package}
 * @copyright 2011 OOO NetExpert
 * @license closed
 */
 
class Registry {
    public static $vars;

    public static function set($name, $val){
        self::$vars[$name]=$val;
    }

    public static function get($name){
       if(!isset(self::$vars[$name])) return null;
        return self::$vars[$name];
    }

    public static function isSetted($name){
        return isset(self::$vars[$name]);
    }
}
