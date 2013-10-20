<?php
/**
 * User: b00tanik
 * Date: 04.07.11
 * Time: 2:33
 */
 
class AuthController extends Controller {
   public function redirectNotAuth() {
      $um = new UserModel();
      if (!$um->isAuth(false)) {
         header("Location: /user/user.login");
      }
   }
}
