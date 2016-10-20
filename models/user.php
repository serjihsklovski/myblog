<?php

require_once ROOT . '/models/model.php';


class User extends Model
{
    public function __construct()
    {
        parent::__construct();
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


    public function addUser($username, $password, $email = null)
    {
        $query = 'INSERT INTO `user` (`username`, `password`, `email`, `user_status_id`) VALUES (:username, :password, :email, 1)';
        $statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $statement->execute([
            'username' => $username,
            'password' => $password,
            'email' => $email
        ]);
    }


    public function hasLoggedIn($username, $password)
    {
        $query = 'SELECT COUNT(*) AS `count` FROM `user` WHERE `username` = :username AND `password` = :password';
        $statement = $this->_conn->prepare($query, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $statement->execute([
            'username' => $username,
            'password' => $password
        ]);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['count'] != 0;
    }
}
