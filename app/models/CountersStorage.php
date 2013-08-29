<?php

class CountersStorage extends ModelMongoDb {

    protected $collectionName="counters";

   public function get($name){
       $val = $this->getOneBy('name', $name);
       if($val!==null) $val = $val['value'];
       return $val;
   }

   public function setVal($name, $val){
        $this->set(array('name'=>$name), array('value'=>$val));
   }


    public function incVal($name, $delta=1){
        if(!$this->get($name)){
            $this->insert(array('name'=>$name,'value'=>0));
        }
        $this->inc(array('name'=>$name), 'value', $delta);
    }

    public function decVal($name, $delta=1){
        if(!$this->get($name)){
            $this->insert(array('name'=>$name,'value'=>0));
        }
        $this->dec(array('name'=>$name), 'value', $delta);
    }

}
