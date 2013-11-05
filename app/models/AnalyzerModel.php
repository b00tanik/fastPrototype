<?php
/**
 * Created by crmMaster.
 * Date: 05.11.13
 */

class AnalyzerModel extends ModelMongoDb {
   protected $collectionName = "analyzer";

   public function isStored($filename, $tone) {
      $file = $this->getOneBy(array('filename'=>$filename, 'tone'=>$tone));
      return !empty($file);
   }

   public function store($filename, $tone, $taskId) {
      $sm = new CliMongoScheduler();
      // Все это ради нормальной поддержки UTF-8
      mb_internal_encoding('UTF-8');
      // Проводим анализ текста
      // Получаем текст
      $text = mb_strtolower(file_get_contents(TASKS_DATA . $tone . '/' . $filename));
      $sm->setTaskProgress($taskId, 20);
      // Разбиваем на слова
      $text = str_replace("&#039;", "'", $text);
      $t = array(' ', '"', "\t", '=', '+', '-', '*', '/', '\\', ',', '.', ';', ':', '[', ']', '{', '}', '(', ')', '<',
         '>', '&', '%', '$', '@', '#', '^', '!', '?', '~'); // разделители
      $text = str_replace($t, " ", $text);
      $text = trim(preg_replace("/\s+/", " ", $text));
      $wordList = array();
      if (mb_strlen($text) > 0) {
         $wordList = explode(" ", $text);
      }
      $sm->setTaskProgress($taskId, 30);
      // Считаем частотность каждого слова
      $allWordsCount = count($wordList);
      $wordsGet = array();
      $wordsCount = array();
      foreach ($wordList as $word) {

         $index = array_search($word, $wordsGet);
         if ($index === false) {
            $wordsGet[] = $word;
            $wordsCount[] = 1;
         }
         else {
            $wordsCount[$index]++;
         }
      }
      $sm->setTaskProgress($taskId, 40);

      // Проставляем процентовку
      foreach($wordsCount as &$count){
         $count = $count/$allWordsCount*100;
      }
      $sm->setTaskProgress($taskId, 50);

      $this->insert(array('filename'=>$filename, 'tone'=>$tone, 'words'=>$wordsGet, 'counts'=>$wordsCount));
      $sm->setTaskProgress($taskId, 60);
      $this->mergeValues($filename, $tone);
      $sm->setTaskProgress($taskId, 100);

   }

   public function getFile($filename, $tone) {
      return $this->getBy(array('filename'=>$filename, 'tone'=>$tone));
   }

   public function clear($tone) {
      $this->remove(array('tone'=>$tone));
   }

   public function analyze($text) {

   }

   public function mergeValues($filename, $tone){
      // для рассинхронизации
      while($this->isLockedMerge()){
         sleep(rand(0.02,0.1));
      }
      $this->lockMerge();
      $wm = new WordsModel();
      $am = new AnalyzerModel();

      // берем из базы чтобы быть увереннными что данные актуальны
      $analyzerInfo = $am->getOneBy(array('filename'=>$filename, 'tone'=>$tone));
      $currWords = $wm->getBy('word', $analyzerInfo['words']);
      foreach($currWords as $mergeWord){

      }
      $this->unlockMerge();
   }

   protected function lockMerge(){
      file_put_contents('mergeLock', 'lock');
   }

   protected function unlockMerge(){
      unlink('mergeLock');
   }

   protected function isLockedMerge(){
      return file_exists('mergeLock');
   }


   public static function getFileList($tone) {
      $data = scandir(TASKS_DATA . $tone);
      unset($data[0]);
      unset($data[1]);
      return $data;
   }

} 