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


    public function usernameExists($username)
    {
        $query = 'SELECT COUNT(*) AS `count` FROM `user` WHERE `username` = :username';
        $statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $statement->execute(['username' => $username]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($result[0]['count'] != 0) {
            return true;
        }

        return false;
    }


    public function addUser($email, $username, $password)
    {
        $query = 'INSERT INTO `user` (`email`, `username`, `password`, `user_status_id`) VALUES (:email, :username, :password, 1)';
        $statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $statement->execute([
            'email' => $email,
            'username' => $username,
            'password' => $password
        ]);
    }
}
