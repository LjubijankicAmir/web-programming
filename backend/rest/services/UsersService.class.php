<?php

require_once __DIR__ . '/../dao/UsersDao.class.php';


class UsersService
{

    private $user_dao;

    public function __construct()
    {
        $this->user_dao = new UsersDao();
    }

    public function add_user($user)
    {
        return $this->user_dao->add_user($user);
    }

    public function login($user)
    {
        return $this->user_dao->login($user);
    }

    public function get_user($userId)
    {
        return $this->user_dao->get_user($userId);
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
