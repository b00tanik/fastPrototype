<?php

class Post extends Controller {

    private function redirectNotAuth() {
        $um = new UserModel();
        if (!$um->isAuth(false)) {
            header("Location: /user/user.login");
        }
    }

    public function write(){
        $this->redirectNotAuth();

    }

    public function check_write(){

        $this->redirectNotAuth();
        $errors = array();

        $_POST['title']=trim(htmlspecialchars($_POST['title']));
        $_POST['text']=trim($_POST['text']);

        if(strlen($_POST['title'])<20) $errors['title']='Слишком короткий заголовок';
        if(strlen($_POST['text'])<140) $errors['text']='Слишком короткий текст';

        $response = array('errors'=>$errors);

        if(empty($errors)){
            $pm = new PostModel();
            $pd = $pm->publish($_POST['title'], $_POST['text']);
            $response['edit_id']=(string) $pd['_id'];
        }

        return $response;
    }


    public function edit(){
        $this->redirectNotAuth();
        $pm = new PostModel();

        $pd = $pm->getById($_GET['post']);
        if(!empty($pd)){
            $um = new UserModel();
            if($um->getCurrentUserId()!=(string)$pd['uid']){
                $pd = false;
            }
        }
        return array('post'=>$pd);
    }

    public function check_edit(){

        $this->redirectNotAuth();
        $errors = array();



        $_POST['title']=trim(htmlspecialchars($_POST['title']));
        $_POST['text']=trim($_POST['text']);

        if(strlen($_POST['title'])<20) $errors['title']='Слишком короткий заголовок';
        if(strlen($_POST['text'])<140) $errors['text']='Слишком короткий текст';

        $pm = new PostModel();
        $pd = $pm->getById($_POST['post_id']);


        if(!empty($pd)){
            $um = new UserModel();
            if($um->getCurrentUserId()!=$pd['uid']){
                $pd = false;
            }
        }

        if(!$pd) $errors['title'] = 'Данный пост запрещено редактировать';

        if(empty($errors)){
             $pm->set(new MongoId($_POST['post_id']), array(
                'text'=>$_POST['text'],
                'title'=>$_POST['title']
            ));
        }

        return array('errors'=>$errors);
    }

    public function show(){
        $this->redirectNotAuth();
        $pm = new PostModel();

        $pd = $pm->getById($_GET['post_id']);

        return array('post'=>$pd);
    }
}
