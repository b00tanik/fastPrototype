<?php

class FoodModel extends ModelMongoDb {

    protected $collectionName="food";

   public static function getTypes(){
      return array(
         'cookie'=>1, 'drink'=>2, 'office'=>3, 'other'=>255
      );
   }

   public static function getLocalizedTypes(){
      return array(
         'cookie'=>'Печенье', 'drink'=>'Напитки', 'office'=>'Канцелярия', 'other'=>'Другое'
      );
   }

}
