<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class Task extends Controller {
   public function summary() {
      $scheduler = new CliMongoScheduler();
      $tasks =  $scheduler->getCurrentTasks(array(Scheduler::TASK_STATUS_STARTED,
         Scheduler::TASK_STATUS_ABORTED_BY_ERRORS, Scheduler::TASK_STATUS_WAITING));
      return array('tasks' =>$tasks);
   }

   public function add_task() {
      $tm = new TaskModel();
      $scheduler = new CliMongoScheduler();
      return array('allowedTasks' => $tm->getAllowedTasks(), 'waitTasks'=>$scheduler->getCurrentTasks(array(Scheduler::TASK_STATUS_WAITING)));
   }

   public function get_task_params() {
      $tm = new TaskModel();
      return $tm->getTaskParams($_POST['taskName']);
   }

   public function check_add_task() {
      $errors = array();
      if (!TaskModel::isAvailable($_POST['taskName'])) {
         $errors['taskName'] = 'Неверное название таска';
      }

      if(!isset($_POST['params'])){
         $errors['taskParams']='Не установлены параметры';
      }

      if (empty($errors)) {
         $sheduler = new CliMongoScheduler();
         $sheduler->addTask($_POST['taskName'], $_POST['params']);
      }
      return array('errors'=>$errors);
   }

   public function abort_task(){
      $scheduler = new CliMongoScheduler();
      $scheduler->abortTask($_GET['taskId']);
   }

   public function update_schedule(){
      $scheduler = new CliMongoScheduler();
      $scheduler->update();
   }
}