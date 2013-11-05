<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class MngCliScheduler extends Sheduler {

   protected $maxWorkersCount = 1;
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
         $sm->set(new MongoId($taskId), $newFields);
      }
   }

   public function getTask($taskId) {
      $sm = new MngShedulerModel();
      return $sm->getById(new MongoId($taskId));
   }

   public function startTask($taskId){
      parent::startTask($taskId);
      $cmd = 'php '.CLI.'start_task.php -i='.$taskId;
      self::execInBackground($cmd);
   }

   public static function execInBackground($cmd) {
      if (substr(php_uname(), 0, 7) == "Windows"){
         pclose(popen("start /B ". $cmd.' > log.htm', "r"));
      }
      else {
         exec($cmd . " > /dev/null &");
      }
   }
}