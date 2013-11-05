<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

error_reporting(E_ALL);

include 'path.php';
include CONFIG.'system.php';

$options = getopt('i:');
$taskId = $options['i'];

$sm = new MngCliScheduler();
$taskInfo = $sm->getTask($taskId);

if(TaskModel::isAvailable($taskInfo['name'])){
   $task = new $taskInfo['name'];
   if($task instanceof ITask){
      $task->start($taskInfo);
   }
   $sm->setTaskProgress($taskId, 100);
} else {
   $sm->abortTask($taskId, array('Task not allowed'));
}




