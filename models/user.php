<?php

require_once ROOT . '/models/model.php';


class User extends Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function emailExists($email)
    {
        $query = 'SELECT COUNT(*) AS `count` FROM `user` WHERE `email` = :email';
        $statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $statement->execute(['email' => $email]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result[0]['count'] != 0) {
            return true;
        }

        return false;
    }
}
