<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class CliMongoScheduler extends Scheduler {

   protected $maxWorkersCount = 16;
   protected $idFieldName = '_id';

   public function getCurrentTasks($status = array(self::TASK_STATUS_STARTED), $limit = null, $offset = null) {
      $sm = new MngShedulerModel();
      $find = $sm->findBy('status', $status);
      if (!is_null($offset)) {
         $find = $find->skip($offset);
      }
      if (!is_null($limit)) {
         $find = $find->limit($limit);
      }

      return iterator_to_array($find);
   }

   protected function setTaskInfo($taskId, $newFields) {
      $sm = new MngShedulerModel();
      if (is_null($taskId)) {
         $sm->insert($newFields);
      }
      else {
         if (!($taskId instanceof MongoId)) {
            $taskId = new MongoId($taskId);
         }
         $sm->set($taskId, $newFields);
      }
   }

   public function getTask($taskId) {
      $sm = new MngShedulerModel();
      if (!($taskId instanceof MongoId)) {
         $taskId = new MongoId($taskId);
      }
      return $sm->getById($taskId);
   }

   public function startTask($taskId) {
      parent::startTask($taskId);
      $cmd = 'php ' . CLI . 'start_task.php -i=' . $taskId;
      self::execInBackground($cmd);
   }

   public static function execInBackground($cmd) {
      if (substr(php_uname(), 0, 7) == "Windows") {
         pclose(popen("start /B " . $cmd , "r"));
      }
      else {
         exec($cmd . " > /dev/null &");
      }
   }
}