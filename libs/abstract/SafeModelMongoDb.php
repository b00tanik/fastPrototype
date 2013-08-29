<?php
/**
 * User: b00tanik
 * Date: 11.07.11
 * Time: 23:08
 */

require_once LIBS.'abstract/ModelMongoDb.php';



class SafeModelMongoDb extends ModelMongoDb   {

    public function findAll(){
        return $this->collection->find(array('_del'=>false));
    }


    public function getById($id){
        try {
            return $this->collection->findOne(array("_id"=>new MongoId($id), '_del'=>false));
        } catch (MongoException $e) {
            return false;
        }
    }

   public function findBy($fields, $val=false){
        if(is_array($fields)){
            $fields = array_merge($fields, array('_del'=>false));
            return $this->collection->find($fields);
        } else {
            return $this->collection->find(array($fields=>$val, '_del'=>false));
        }
    }

   public function getOneBy($fields, $val=false){
       if(is_array($fields)){
           $fields = array_merge($fields, array('_del'=>false));
           return $this->collection->findOne($fields);
       } else {
           return $this->collection->findOne(array($fields=>$val, '_del'=>false));
       }
   }

   public function update($criteria, $set){
       $set = array_merge($set, array('_del'=>false));
       parent::update($criteria, $set);
   }

   public function insert($set){
       $set = array_merge($set, array('_del'=>false));
       $this->collection->insert($set);
       return $set;
   }


    public function remove($criteria){
       $this->set($criteria, array('_del'=>true));
    }
}
