<?php



class UserModel extends ModelMongoDb {

    protected $collectionName="users";
    protected $currentUser;

    public function generateHash($id, $pass){
        return sha1($id.$pass);
    }

    public function isAuth($required = true){
        if(Cookies::isSetted('login')){
            $logUser = $this->getCurrentUser();
            if($logUser['pass'] == Cookies::get('token')){
                return true;
            } else {
                $this->logOut();
                if(DEBUG && $required){
                    throw new UserException('Token not valid');
                }
            }
        }
        return false;
    }

    public function getCurrentUser(){
        if($this->currentUser === null){
            $this->currentUser = $this->getOneBy("nick", Cookies::get('login'));
        }
        return $this->currentUser;
    }

    public function getCurrentUserId(){
        if($this->currentUser === null){
            $this->currentUser = $this->getOneBy("nick", Cookies::get('login'));
        }
        return $this->currentUser['_id'];
    }

    public function auth($login, $pass){
        if(!$this->isAuth(false)){
            $logUser = $this->getOneBy("nick", $login);
            $this->currentUser=$logUser;
            Cookies::set('id', $logUser['_id']);
            Cookies::set('login', $logUser['nick']);
            Cookies::set('token', $logUser['pass']);
        }
        return $this->currentUser;
    }

    public function logOut(){
       $this->currentUser = null;
        Cookies::del('login');
        Cookies::del('token');
        Cookies::del('id');
    }

    public function register($nick, $pass){
        $this->insert(array(
                'nick'=>$nick,
                'pass'=>$this->generateHash($nick, $pass)
            )
        );
    }
}
