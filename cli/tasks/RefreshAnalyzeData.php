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

   public function start($info) {
      // добавляем таски в шедулер
      // Обновляем шедулер
      // добавляем к детям свой parent_id
   }

   public function wakeup(){
      // Проверяем - все ли наши таски завершены
      // Производим финальные подсчеты
   }
}