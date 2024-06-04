<?php

require_once __DIR__ . '/../dao/ContestsDao.class.php';

class ContestsService
{
    private $contests_dao;

    public function __construct()
    {
        $this->contests_dao = new ContestsDao();
    }

    public function get_contests()
    {
        return $this->contests_dao->get_contests();
    }

    public function get_contest_details($contestId)
    {
        return $this->contests_dao->get_contest_details($contestId);
    }


    public function get_filtered_contests($name = null, $category = null, $price = null)
    {
        return $this->contests_dao->get_filtered_contests($name, $category, $price);
    }
}
