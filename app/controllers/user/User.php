<?php

define('NEWS_PER_PAGE', 3);

class User extends Controller {

    private function redirectNotAuth(){
        $um = new UserModel();
        if(!$um->isAuth(false)) {
            header("Location: /user/user.login");
        }
    }

    public function show(){
        $this->redirectNotAuth();

        $um = new UserModel();
        if(!isset($_GET['uid'])){
            $_GET['uid']=$um->getCurrentUserId();
        } else {
            $_GET['uid']=$um->getOneBy('nick', $_GET['uid']);
            $_GET['uid']=(string) $_GET['uid']['_id'];
        }

        $pm = new PostModel();
        return array('posts'=>$pm->getBy('uid', new MongoId($_GET['uid'])));
    }

    public function logout(){
        $um = new UserModel();
        $um->logOut();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function login(){
        $um = new UserModel();
        if($um->isAuth(false)) {
            header("Location: /user/user.show");
        }
    }

    public function check_login(){
        $errors = array();
        $_POST['nick'] = trim(htmlspecialchars($_POST['nick']));
        $_POST['pass'] = trim($_POST['pass']);

        if(empty($_POST['pass'])) {
            $errors['pass'] = 'Пароль не может быть пустым';
        }
        if(empty($errors)) {
            $um = new UserModel();
            $user = $um->getOneBy('nick', $_POST['nick']);
            if(!empty($user)) {
                if($user['pass'] == $um->generateHash($_POST['nick'], $_POST['pass'])) {
                    $um->auth($user['nick'], $user['pass']);
                } else {
                    $errors['pass'][] = 'Неверный пароль';
                }
            } else {
                $errors['nick'][] = 'Такого пользователя не существует';
            }
        }

        return array('errors' => $errors);
    }

    public function register(){

    }

    public function check_register(){
        $errors = array();
        $um = new UserModel();

        $_POST['nick'] = trim(htmlspecialchars($_POST['nick']));

        if(strlen($_POST['nick']) < 3)
            $errors['nick'] = 'Слишком короткий ник';


        if(strlen($_POST['nick']) > 100)
            $errors['nick'] = 'Слишком длинный ник';


        $user = $um->getOneBy('nick', $_POST['nick']);
        if(!empty($user)) {
            $errors['nick'] = 'Такой пользователь уже есть';
        }

        $_POST['pass'] = trim($_POST['pass']);
        if(empty($_POST['pass'])) {
            $errors['pass'] = 'Пароль не может быть пустым';
        }
        if($_POST['pass'] != $_POST['pass_confirm']) {
            $errors['pass_confirm'] = 'Пароль и подтверждение не совпадают';
        }

        if(empty($errors)) {
            // register user
            $um->register($_POST['nick'], $_POST['pass']);
        }

        return array("errors" => $errors);
    }
}
