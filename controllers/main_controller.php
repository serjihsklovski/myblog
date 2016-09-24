<?php

require_once ROOT . '/controllers/controller.php';


class MainController extends Controller
{
    public function actionIndex()
    {
        require_once ROOT . '/views/main/index.php';
    }
}