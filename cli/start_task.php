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

$sm = new CliMongoScheduler();
$taskInfo = $sm->getTask($taskId);

set_error_handler(function($errno, $errstr, $errfile, $errline) use ($taskId){
   file_put_contents($taskId.'.log', $errstr.' FILE '.$errfile. ' LINE '.$errline);
});

if(TaskModel::isAvailable($taskInfo['name'])){
   $task = new $taskInfo['name'];
   if($task instanceof ITask){
      $task->start($taskInfo);
   }
} else {
   $sm->abortTask($taskId, array('Task not allowed'));
}

$sm->update();




