<?php
/**
 * User: b00tanik
 * Date: 11.07.11
 * Time: 23:08
 */

require_once LIBS.'abstract/ModelMongoDb.php';



class ArchiveModelMongoDb extends ModelMongoDb   {
    public function remove($criteria){
        $archive = MonDB::getInstance()->mongo->{'archive_'.$this->collectionName};
        if(!$archive){
            MonDB::getInstance()->mongo->createCollection('archive_'.$this->collectionName);
            $archive = MonDB::getInstance()->mongo->{'archive_'.$this->collectionName};
        }
        $data = $this->getBy($criteria);
        $archive->batchInsert($data);
        parent::remove($criteria);
    }
}
