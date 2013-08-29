<?php

class PostModel extends ModelMongoDb {

    protected $collectionName="post";

    public function publish($title, $text){
        $um = new UserModel();

        $counter = new CountersStorage();
        $counter->incVal('post');

        return $this->insert(array(
            'title'=>$title,
            'text'=>$text,
            'uid'=>$um->getCurrentUserId()
        ));
    }
}
