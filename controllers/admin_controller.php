<?php

require_once ROOT . '/controllers/controller.php';


class AdminController extends Controller
{
    public function actionIndex()
    {
        require_once ROOT . '/views/admin/index.php';
    }
}
