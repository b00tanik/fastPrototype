<?php
/**
 * Created by crmMaster.
 * Date: 04.11.13
 */

abstract class Scheduler {

   const TASK_STATUS_WAITING = 1;
   const TASK_STATUS_STARTED = 2;
   const TASK_STATUS_FINISHED = 3;
   const TASK_STATUS_ABORTED = 4;
   const TASK_STATUS_ABORTED_BY_ERRORS = 5;

   protected $maxWorkersCount;
   protected $idFieldName = 'id';

   abstract public function getCurrentTasks($status = array(self::TASK_STATUS_STARTED), $limit = null);

   abstract protected function setTaskInfo($taskId, $newFields);

   abstract public function getTask($taskId);

   protected function startTask($taskId) {
      $this->setTaskInfo($taskId, array('status' => self::TASK_STATUS_STARTED));
   }

   public function addTask($taskName, $taskParams) {
      $this->setTaskInfo(null, array('status' => self::TASK_STATUS_WAITING, 'progress' => 0, 'params' => $taskParams,
         'name' => $taskName));
   }

   public function abortTask($taskId, $errors = array()) {
      if (count($errors) == 0) {
         $this->setTaskInfo($taskId, array('status' => self::TASK_STATUS_ABORTED));
      }
      else {
         $this->setTaskInfo($taskId, array('status' => self::TASK_STATUS_ABORTED_BY_ERRORS, 'errors' => $errors));
      }
   }


   public function getTaskStatus($taskId) {
      $taskInfo = $this->getTask($taskId);
      return $taskInfo['status'];
   }


   public function setTaskProgress($taskId, $newProgress) {
      $tm = new LogsModel();
      $curLog = $tm->getOneBy('hid', 'test');

      $curLog['data'].="TASK ".$taskId." SET progress ".$newProgress.PHP_EOL;
      $tm->set(new MongoId($curLog['_id']), array('data'=>$curLog['data']));
      if ($newProgress >= 100) {
         $newProgress = 100;
         $this->setTaskInfo($taskId, array('progress' => $newProgress, 'status' => self::TASK_STATUS_FINISHED));
      }
      else {
         $this->setTaskInfo($taskId, array('progress' => $newProgress));
      }
   }

   public function update() {
      $currTasksCount = count($this->getCurrentTasks());
      $tasksForStart = $this->getCurrentTasks(array(self::TASK_STATUS_WAITING), $this->maxWorkersCount - $currTasksCount);
      foreach ($tasksForStart as $task) {
         $this->startTask($task[$this->idFieldName]);
      }
   }


}