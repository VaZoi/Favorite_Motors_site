<?php

class Route
{
    private $dbh;
    private $routetable = 'routes';

    public function __construct(Database $dbh)
    {
        $this->dbh = $dbh;
    }

    // Insert a new route into the database
    public function insertRoute($name, $file_path, $distance, $duration, $description) {
        $query = "INSERT INTO $this->routetable (name, file_path, distance_km, duration_hours, description) 
                  VALUES (:name, :file_path, :distance_km, :duration_hours, :description)";
        $this->dbh->run($query, [
            ':name' => $name,
            ':file_path' => $file_path,
            ':distance_km' => $distance,
            ':duration_hours' => $duration,
            ':description' => $description
        ]);
    }

    // Fetch all routes from the database
    public function getAllRoutes()
    {
        $query = "SELECT * FROM $this->routetable";
        return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
