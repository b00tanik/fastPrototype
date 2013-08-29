<?php
/**
 * User: b00tanik
 * Date: 04.07.11
 * Time: 2:33
 */
 
class Controller {
    private $template=null;

    public function getTemplate(){
        return $this->template;
    }

    protected function testBool($val){
        if($val == 1 || $val==0) return true;
        return false;
    }

    protected function testColor($val){
       return preg_match("/[0-9a-f]{6}/i", $val);
    }
}
