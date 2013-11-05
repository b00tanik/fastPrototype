<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class TaskModel {
   public function getAllowedTasks(){
      $data =  scandir(TASKS);
      unset($data[0]); unset($data[1]);
      foreach ($data as &$taskName){
         $taskName = substr($taskName, 0, strlen($taskName)-4);
      }
      return $data;
   }

   public function getTaskParams($taskName){
      if($this->isAvailable($taskName)){
         $task = new $taskName();
         if($task instanceof ITask){
            return $task->getParams();
         }
      }
      return array();
   }

   public static function isAvailable($taskName){
      return file_exists(TASKS.$taskName.'.php');
   }
} 