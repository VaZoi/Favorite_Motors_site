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

    public function addMotor($name, $category_id, $status_id, $brand_id, $motorlicense_id, $cc, $pk, $kw, $seat_height, $weight, $price)
    {
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

        try {
            $this->dbh->run($query, $params);
            $motor_id = $this->dbh->lastInsertId();  // get the new motor ID

            // Add price history only if not exists for today
            $lastPrice = $this->getLastPrice($motor_id);
            if ($lastPrice === null || $lastPrice != $price) {
                $this->addPriceHistory($motor_id, $price);
            }

            return $motor_id;
        } catch (PDOException $e) {
            error_log('Failed to add motor: ' . $e->getMessage());
            return false;
        }
    }

    public function updateMotor($motor_id, $name, $category_id, $status_id, $brand_id, $motorlicense_id, $cc, $pk, $kw, $seat_height, $weight, $price)
    {
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
            $this->dbh->run($query, $params);

            // Add price to history only if different from last recorded
            $lastPrice = $this->getLastPrice($motor_id);
            if ($lastPrice === null || $lastPrice != $price) {
                $this->addPriceHistory($motor_id, $price);
            }

            return true;
        } catch (PDOException $e) {
            error_log('Failed to update motor: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the last recorded price of a motor
     */
    public function getLastPrice($motor_id)
    {
        $query = "SELECT price FROM motor_price_history WHERE motor_id = :motor_id ORDER BY recorded_at DESC LIMIT 1";
        $params = [':motor_id' => $motor_id];

        try {
            $stmt = $this->dbh->run($query, $params);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['price'] : null;
        } catch (PDOException $e) {
            error_log('Failed to get last price: ' . $e->getMessage());
            return null;
        }
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

    public function searchMotors($searchTerm, $column = '', $order = 'ASC')
    {
        $allowedSortColumns = ['weight', 'seat_height', 'price', 'likes'];
        $columnSql = in_array($column, $allowedSortColumns) ? "ORDER BY $column $order" : "ORDER BY m.likes DESC";

        $query = "
        SELECT m.*, c.category as category_name, b.brand_name as brand_name, s.status as status_name, l.motorlicense_name as motorlicense_name
        FROM $this->motortable m
        LEFT JOIN category c ON m.category_id = c.category_id
        LEFT JOIN brands b ON m.brand_id = b.brand_id
        LEFT JOIN status s ON m.status_id = s.status_id
        LEFT JOIN motorlicenses l ON m.motorlicense_id = l.motorlicense_id
        WHERE m.name LIKE :searchTerm OR b.brand_name LIKE :searchTerm
        $columnSql";

        $params = [':searchTerm' => "%$searchTerm%"];

        try {
            $stmt = $this->dbh->run($query, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to search motors: ' . $e->getMessage());
            return [];
        }
    }


    public function addLike($motor_id)
    {
        $query = "UPDATE $this->motortable SET likes = likes + 1 WHERE motor_id = :motor_id";
        $params = [':motor_id' => $motor_id];

        try {
            $this->dbh->run($query, $params);
            return true;
        } catch (PDOException $e) {
            error_log('Failed to add like: ' . $e->getMessage());
            return false;
        }
    }


    public function getMotorsOrderedByLikes()
    {
        $query = "
            SELECT m.*, c.category as category_name, b.brand_name as brand_name, s.status as status_name, l.motorlicense_name as motorlicense_name
            FROM $this->motortable m
            LEFT JOIN category c ON m.category_id = c.category_id
            LEFT JOIN brands b ON m.brand_id = b.brand_id
            LEFT JOIN status s ON m.status_id = s.status_id
            LEFT JOIN motorlicenses l ON m.motorlicense_id = l.motorlicense_id
            ORDER BY m.likes DESC";

        try {
            return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to fetch motors ordered by likes: ' . $e->getMessage());
            return [];
        }
    }

    public function getMotorsSorted($column, $order)
    {
        $allowedSortColumns = ['weight', 'seat_height', 'price', 'likes'];
        $columnSql = in_array($column, $allowedSortColumns) ? "ORDER BY $column $order" : "ORDER BY likes DESC";

        $query = "
        SELECT m.*, c.category as category_name, b.brand_name as brand_name, s.status as status_name, l.motorlicense_name as motorlicense_name
        FROM $this->motortable m
        LEFT JOIN category c ON m.category_id = c.category_id
        LEFT JOIN brands b ON m.brand_id = b.brand_id
        LEFT JOIN status s ON m.status_id = s.status_id
        LEFT JOIN motorlicenses l ON m.motorlicense_id = l.motorlicense_id
        $columnSql";

        try {
            return $this->dbh->run($query)->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to fetch motors sorted: ' . $e->getMessage());
            return [];
        }
    }

    public function addPriceHistory($motor_id, $price)
    {
        $query = "INSERT INTO motor_price_history (motor_id, price) VALUES (:motor_id, :price)";
        $params = [
            ':motor_id' => $motor_id,
            ':price' => $price
        ];

        try {
            $this->dbh->run($query, $params);
            return true;
        } catch (PDOException $e) {
            error_log('Failed to add price history: ' . $e->getMessage());
            return false;
        }
    }

    public function getPriceHistory($motor_id)
    {
        $query = "SELECT price, recorded_at FROM motor_price_history WHERE motor_id = :motor_id ORDER BY recorded_at ASC";
        $params = [':motor_id' => $motor_id];

        try {
            $stmt = $this->dbh->run($query, $params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Failed to fetch price history: ' . $e->getMessage());
            return [];
        }
    }
}
