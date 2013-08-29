<?php
/**
 * User: b00tanik
 * Date: .07.11
 * Time: 13:06
 */

include CONFIG.'db.php';

class MonDB {

    private  $connection=null;
    public  $mongo=null;


    private function __construct($host, $db){
        $this->connection = new MongoClient($host);
        $this->mongo = $this->connection->selectDB($db);
    }
    private function __clone(){;}


    private static $instance=null;

    /**
     * @static
     * @return MonDB
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new MonDB(MONGO_HOST, MONGO_DB);
        }
        return self::$instance;
    }

    public static function toMongoId($data){
        $ret = array();
        foreach ($data as $val) {
            $ret[]=new MongoId($val);
        }
        return $ret;

    }



}
