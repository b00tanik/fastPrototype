<?php
/**
 * User: b00tanik
 * Date: 04.07.11
 * Time: 2:17
 *
 * @description: Описание классов эксепшенов
 */
class Exception404Error extends Exception{
        public function __construct($place, $path){
            parent::__construct("[{$place}] Path {$path} not found");
        }
}

class Exception500Error extends Exception{
          public function __construct($place, $path){
            parent::__construct("[{$place}] Path {$path} not found");
        }
}

class UniException extends Exception {
    public function __construct($message){
        parent::__construct('['.get_class($this).'] '.$message);
    }
}

class SessionException extends UniException {}

class UserException extends UniException {}

class NotValidDataException extends Exception {}
