<?php
/**
 * User: b00tanik
 * Date: 11.07.11
 * Time: 23:08
 */

require_once LIBS . 'MonDB.php';


class ModelMongoDb{

    protected $collection = null;
    protected $collectionName;

    public function __construct(){
        $this->collection = MonDB::getInstance()->mongo->{$this->collectionName};
        if(!$this->collection) {
            MonDB::getInstance()->mongo->createCollection($this->collectionName);
            $this->collection = MonDB::getInstance()->mongo->{$this->collectionName};
        }

    }

    public function findAll(){
        return $this->collection->find();
    }


    public function getAll(){
        return iterator_to_array($this->findAll());
    }


    public function getById($id){
        try {
            return $this->collection->findOne(array("_id" => new MongoId($id)));
        } catch(MongoException $e) {
            return false;
        }
    }

    public function getBy($fields, $val = false){

        return iterator_to_array($this->findBy($fields, $val));

    }

    public function findBy($fields, $val = false){
        if(is_array($fields)) {
            return $this->collection->find($fields);
        } else {
            return $this->collection->find(array($fields => $val));
        }
    }

    public function getOneBy($fields, $val = false){
        if(is_array($fields)) {
            return $this->collection->findOne($fields);
        } else {
            return $this->collection->findOne(array($fields => $val));
        }
    }

    public function update($criteria, $set){
        if($criteria instanceof MongoId) {
            return $this->collection->update(array("_id" => $criteria), $set);
        } else {
            return $this->collection->update($criteria, $set);
        }
    }

    public function inc($criteria, $field, $count = 1){
        if($criteria instanceof MongoId) {
            return $this->collection->update(array("_id" => $criteria), array('$inc' => array($field => $count)));
        } else {
            return $this->collection->update($criteria, array('$inc' => array($field => $count)));
        }
    }

    public function dec($criteria, $field, $count = 1){
        if($criteria instanceof MongoId) {
            return $this->collection->update(array("_id" => $criteria), array('$inc' => array($field => -$count)));
        } else {
            return $this->collection->update($criteria, array('$inc' => array($field => -$count)));
        }
    }

    public function unsetField($criteria, $field){
        if($criteria instanceof MongoId) {
            return $this->collection->update(array("_id" => $criteria), array('$unset' => array($field => "")));
        } else {
            return $this->collection->update($criteria, array('$unset' => array($field => "")));
        }

    }

    public function set($criteria, $set, $multi = true){
        if($criteria instanceof MongoId) {
            return $this->collection->update(array("_id" => $criteria), array('$set' => $set));
        } else {
            return $this->collection->update($criteria, array('$set' => $set), array('multiple' => $multi));
        }

    }

    public function insert($set){
        $this->collection->insert($set);
        return $set;
    }


    public function remove($criteria){
        if($criteria instanceof MongoId) {
            return $this->collection->remove(array("_id" => $criteria));
        } else {
            return $this->collection->remove($criteria);
        }

    }
}
