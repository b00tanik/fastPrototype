<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class AnalyzeNegFile implements  ITask {

   public function getParams() {
      $fileList=AnalyzerModel::getFileList('neg');
      return array('filename'=>array('label'=>'Имя файла', 'options'=>
        array_combine($fileList, $fileList))
      );
   }

   public function start($info) {
      $analyzer = new AnalyzerModel();
      $analyzer->store($info['params']['filename'], 'neg', $info['_id']);
   }
}