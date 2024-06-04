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


    public function get_filtered_contests($name = null, $category = null, $price = null)
    {

        $query = "SELECT * FROM contests";
        $params = [];
    
        if ($name || $category || $price) {
            $query .= " WHERE";
            $firstCondition = true;
    
            if ($name) {
                $query .= " name LIKE :name";
                $params[':name'] = '%' . $name . '%';
                $firstCondition = false;
            }
    
            if ($category) {
                $query .= $firstCondition ? " category = :category" : " AND category = :category";
                $params[':category'] = $category;
                $firstCondition = false;
            }
    
            if ($price) {
                if ($price == "50") {
                    $query .= $firstCondition ? " entry_price > :price" : " AND entry_price > :price";
                    $params[':price'] = $price;
                } elseif ($price == "0") {
                    $query .= $firstCondition ? " (entry_price = :price OR entry_price IS NULL)" : " AND (entry_price = :price OR entry_price IS NULL)";
                    $params[':price'] = $price;
                } else {
                    $priceRange = explode("-", $price);
                    $query .= $firstCondition ? " entry_price BETWEEN :priceLow AND :priceHigh" : " AND entry_price BETWEEN :priceLow AND :priceHigh";
                    $params[':priceLow'] = $priceRange[0];
                    $params[':priceHigh'] = $priceRange[1];
                }
            }
        }
    
    
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        $contests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $contests;
    }
}
