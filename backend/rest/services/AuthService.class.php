<?php

require_once __DIR__ . '/../dao/AuthDao.class.php';


class AuthService
{

    private $auth_dao;

    public function __construct()
    {
        $this->auth_dao = new AuthDao();
    }

    public function add_user($user)
    {
        return $this->auth_dao->add_user($user);
    }

    public function login($user)
    {
        return $this->auth_dao->login($user);
    }

    public function get_user($userId)
    {
        return $this->auth_dao->get_user($userId);
    }

    public function logged_in()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}
