<?php

class Adminfood extends AuthController {
   public function edit(){
      if(isset($_GET['id']) && !empty($_GET['id'])){
         $fm = new FoodModel();
         return $fm->getById($_GET['id']);
      } else return array();
   }

   public function check_edit(){
      return array();
   }



}
