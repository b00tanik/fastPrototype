<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

interface ITask {
   public function getParams();
   public function start($info);
}