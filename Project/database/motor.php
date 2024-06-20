<?php

class Motor
{
    private $dbh;
    private $motortable = 'motors';
    private $imagetable = 'motor_images';

    public function __construct(Database $dbh)
    {
        $this->dbh = $dbh;
    }

    public function getMotors() {
        $query = "
            SELECT m.*, c.category as category_name, b.brand_name as brand_name, s.status as status_name, l.motorlicense_name as motorlicense_name
            FROM $this->motortable m
            LEFT JOIN category c ON m.category_id = c.category_id
            LEFT JOIN brands b ON m.brand_id = b.brand_id
            LEFT JOIN status s ON m.status_id = s.status_id
            LEFT JOIN motorlicenses l ON m.motorlicense_id = l.motorlicense_id";
        return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMotorImage($motor_id, $image_path)
    {
        $query = "INSERT INTO $this->imagetable (motor_id, image_path) VALUES (:motor_id, :image_path)";
        $params = [
            ':motor_id' => $motor_id,
            ':image_path' => $image_path
        ];

        try {
            $stmt = $this->dbh->run($query, $params);
            return true;
        } catch (PDOException $e) {
            error_log('Failed to add image to motor: ' . $e->getMessage());
            return false;
        }
    }

    public function getMotorImages($motor_id)
    {
        $query = "SELECT * FROM $this->imagetable WHERE motor_id = :motor_id";
        $params = [':motor_id' => $motor_id];

        try {
            $stmt = $this->dbh->run($query, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to fetch motor images: ' . $e->getMessage());
            return [];
        }
    }

    public function addMotor($name, $category_id, $status_id, $brand_id, $motorlicense_id, $cc, $pk, $kw, $seat_height, $weight, $price) {
        $query = "
            INSERT INTO $this->motortable (name, category_id, status_id, brand_id, motorlicense_id, cc, pk, kw, seat_height, weight, price)
            VALUES (:name, :category_id, :status_id, :brand_id, :motorlicense_id, :cc, :pk, :kw, :seat_height, :weight, :price)";

        $params = [
            ':name' => $name,
            ':category_id' => $category_id,
            ':status_id' => $status_id,
            ':brand_id' => $brand_id,
            ':motorlicense_id' => $motorlicense_id,
            ':cc' => $cc,
            ':pk' => $pk,
            ':kw' => $kw,
            ':seat_height' => $seat_height,
            ':weight' => $weight,
            ':price' => $price,
        ];

        return $this->dbh->run($query, $params);
    }

    public function getMotorById($motor_id)
    {
        $query = "
            SELECT m.*, c.category as category_name, b.brand_name as brand_name, s.status as status_name
            FROM $this->motortable m
            LEFT JOIN category c ON m.category_id = c.category_id
            LEFT JOIN brands b ON m.brand_id = b.brand_id
            LEFT JOIN status s ON m.status_id = s.status_id
            WHERE m.motor_id = :motor_id";
        
        $params = [':motor_id' => $motor_id];
        
        try {
            $stmt = $this->dbh->run($query, $params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to fetch motor: ' . $e->getMessage());
            return false;
        }
    }

    public function countMotors()
    {
        $query = "SELECT COUNT(*) as total FROM $this->motortable";
        
        try {
            $stmt = $this->dbh->run($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            error_log('Failed to count motors: ' . $e->getMessage());
            return 0;
        }
    }

    public function updateMotor($motor_id, $name, $category_id, $status_id, $brand_id, $motorlicense_id, $cc, $pk, $kw, $seat_height, $weight, $price) {
        $query = "
            UPDATE $this->motortable 
            SET name = :name, 
                category_id = :category_id, 
                status_id = :status_id, 
                brand_id = :brand_id, 
                motorlicense_id = :motorlicense_id, 
                cc = :cc, 
                pk = :pk, 
                kw = :kw, 
                seat_height = :seat_height, 
                weight = :weight, 
                price = :price
            WHERE motor_id = :motor_id";
    
        $params = [
            ':motor_id' => $motor_id,
            ':name' => $name,
            ':category_id' => $category_id,
            ':status_id' => $status_id,
            ':brand_id' => $brand_id,
            ':motorlicense_id' => $motorlicense_id,
            ':cc' => $cc,
            ':pk' => $pk,
            ':kw' => $kw,
            ':seat_height' => $seat_height,
            ':weight' => $weight,
            ':price' => $price,
        ];
    
        try {
            $stmt = $this->dbh->run($query, $params);
            return true;
        } catch (PDOException $e) {
            error_log('Failed to update motor: ' . $e->getMessage());
            return false;
        }
    }

    public function getImagesByMotorId($motor_id)
    {
        $query = "SELECT * FROM $this->imagetable WHERE motor_id = :motor_id";
        $params = [':motor_id' => $motor_id];

        try {
            $stmt = $this->dbh->run($query, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to fetch motor images: ' . $e->getMessage());
            return [];
        }
    }

    public function deleteImagesByMotorId($motor_id)
    {
        $query = "DELETE FROM $this->imagetable WHERE motor_id = :motor_id";
        $params = [':motor_id' => $motor_id];

        try {
            $stmt = $this->dbh->run($query, $params);
            return true;
        } catch (PDOException $e) {
            error_log('Failed to delete motor images: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteMotor($motor_id)
    {
        $query = "DELETE FROM $this->motortable WHERE motor_id = :motor_id";
        $params = [':motor_id' => $motor_id];

        try {
            $stmt = $this->dbh->run($query, $params);
            return true;
        } catch (PDOException $e) {
            error_log('Failed to delete motor: ' . $e->getMessage());
            return false;
        }
    }
    
}
