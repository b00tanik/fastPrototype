<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class AnalyzerModel  extends ModelMongoDb {
   protected $collectionName="analyzer";

   public function isStored($filename, $tone){

   }

   public function store($filename, $tone){
      // Проводим анализ текста
      // Получаем текст
      // Разбиваем на слова
      // Считаем частотность каждого слова
      // Проставляем процентовку
      // Будим шедулер чтобы он нас смержил
   }

   public function isLock($filename, $tone){

   }

   public function getFile($filename, $tone){

   }

   public function clear($tone){

   }

   public function analyze($text){

   }

   public static function getFileList($tone){
      $data =  scandir(TASKS_DATA.$tone);
      unset($data[0]); unset($data[1]);
      return $data;
   }

} 