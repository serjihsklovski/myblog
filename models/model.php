<?php

class Model
{
    protected $_conn;


    public function __construct()
    {
        $dsn = 'mysql:host=' . Application::$config['database']['host'] . ';' .
            'dbname=' . Application::$config['database']['name'];

        $this->_conn = new PDO(
            $dsn,
            Application::$config['database']['user'],
            Application::$config['database']['password']
        );
    }
}
