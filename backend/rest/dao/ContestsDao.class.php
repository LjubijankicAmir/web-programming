<?php

require_once __DIR__ . '/BaseDao.class.php';

class ContestsDao extends BaseDao
{

    public function __construct()
    {
        parent::__construct("contests");
    }

    public function get_contests()
    {

        $stmt = $this->connection->prepare("SELECT * FROM contests");

        $stmt->execute();
        $contests = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $contests;
    }

    public function get_contest_details($contestId)
    {

        $stmt = $this->connection->prepare("SELECT * FROM contests WHERE id = :id");

        $stmt->bindParam(':id', $contestId);

        $stmt->execute();
        $contest = $stmt->fetch(PDO::FETCH_ASSOC);

        return $contest;
    }
}
