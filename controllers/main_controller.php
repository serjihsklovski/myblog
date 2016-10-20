<?php

require_once ROOT . '/controllers/controller.php';


class MainController extends Controller
{
    public function __construct()
    {
        parent::__construct(null);
    }


    public function actionIndex()
    {
        if (
            Application::getSiteCookie('username') !== null and
            Application::getSiteCookie('password') !== null
        ) {
            $loggedIn = true;
        }
        
        require_once ROOT . '/views/main/index.php';
    }
}