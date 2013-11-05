<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class RefreshAnalyzeData implements  ITask {

   public function getParams() {
      return array('type'=>
         array('options'=>array('refresh'=>'Обновить', 'rewrite'=>'Перезаписать'),
               'label'=>'Действие'
      ),
      'tones'=>array('options'=>array(
         'all'=>'Все',
         'neg'=>'Негативные',
         'pos'=>'Позитивные'
      ), 'label'=>'Тональность'));
   }

   public function start($info ) {
      $sm = new CliMongoScheduler();
      $am = new AnalyzerModel();
      // Чистим
      $params = $info['params'];
      $all = ($params['tones']=='all');
      if($params['type']=='rewrite'){
         if($params['tones']=='pos' || $all){
            $am->clear('pos');
         }
         if($params['tones']=='neg' || $all){
            $am->clear('neg');
         }
      }
      $sm->setTaskProgress($info['_id'], 30);

      // Устанавливаем таски
      if($params['tones']=='pos' || $all){
         foreach($am->getFileList('pos') as $file){
            if(!$am->isStored($file, 'pos')){
               $sm->addTask('AnalyzePosFile', array(
                  'filename'=>$file
               ));
            }
         }
      }
      $sm->setTaskProgress($info['_id'], 70);

      if($params['tones']=='neg' || $all){
         foreach($am->getFileList('neg') as $file){
            if(!$am->isStored($file, 'neg')){
               $sm->addTask('AnalyzeNegFile', array(
                  'filename'=>$file
               ));
            }
         }
      }
      $sm->setTaskProgress($info['_id'], 100);
   }
}