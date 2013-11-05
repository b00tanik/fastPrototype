<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class AnalyzePosFile implements  ITask {

   public function getParams() {
      $fileList=AnalyzerModel::getFileList('pos');
      return array('filename'=>array('label'=>'Имя файла', 'options'=>
        array_combine($fileList, $fileList))
      );
   }

   public function start($info) {
      // Проводим анализ текста
      $analyzer = new AnalyzerModel();
      $analyzer->store($info['params']['filename'], 'pos');
   }
}