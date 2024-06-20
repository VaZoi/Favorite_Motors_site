<?php

class Other
{
    private $dbh;
    private $categorytable = 'category';
    private $statustable = 'status';
    private $brandtable = 'brands';
    private $motorlicensetable = 'motorlicenses';
    public function __construct(Database $dbh)
    {
        $this->dbh = $dbh;
    }

    public function getCategories() {
        $query = "SELECT * FROM $this->categorytable";
        return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatuses() {
        $query = "SELECT * FROM $this->statustable";
        return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBrands() {
        $query = "SELECT * FROM $this->brandtable";
        return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMotorlicenses() {
        $query = "SELECT * FROM $this->motorlicensetable";
        return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addBrand($brand_name) {
        $query = "
            INSERT INTO $this->brandtable (brand_name)
            VALUES (:brand_name)";

        $params = [
            ':brand_name' => $brand_name,
        ];

        return $this->dbh->run($query, $params);
    }

    public function addCategory($category_name) {
        $query = "
            INSERT INTO $this->categorytable (category)
            VALUES (:category_name)";

        $params = [
            ':category_name' => $category_name,
        ];

        return $this->dbh->run($query, $params);
    }
}