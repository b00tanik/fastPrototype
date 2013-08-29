<?php
/**
 * User: b00tanik
 * Date: 24.07.11
 * Time: 2:23
 */
include_once 'Exceptions.php';
include_once 'Registry.php';

class Session extends Registry {
    private static $started = false;

    public static function startSession(){
        if(!self::$started) {
            session_set_cookie_params(time()+31536000, '/', $_SERVER['HTTP_HOST'], true); // 1 год
            self::$started = session_start();
            if(DEBUG && !self::$started){
                throw new SessionException(' Cant start session ');
            }
            self::$vars = $_SESSION;
        }
    }

    public static function set($name, $val){
        $_SESSION[$name]=$val;
        parent::set($name, $val);
    }

    public static function del($name){
        unset($_SESSION[$name]);
        unset(self::$vars[$name]);
    }

    public static function destroy(){
        if(self::$started){
            self::$started = !session_destroy();
        }
    }
}
