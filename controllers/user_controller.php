<?php

require_once ROOT . '/controllers/controller.php';


class UserController extends Controller
{
    public function actionProfile($username)
    {
        require_once ROOT . '/views/user/profile.php';
    }


    public function actionSignIn()
    {
        //
    }


    public function actionSignUp()
    {
        require_once ROOT . '/views/user/sign_up.php';
    }


    public function actionSettings()
    {
        //
    }


    public function actionArticles()
    {
        //
    }
}
