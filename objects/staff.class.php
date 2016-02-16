<?php
error_reporting(0);
class Staff
{

    // database connection and table name
    private $conn;
    private $table_name = "Staff";

    // object properties
    public $Id;
    public $FirstName;
    public $LastName;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function selectAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY LastName ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function selectById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Id = ? LIMIT 1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->Id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Id = $row['Id'];
        $this->FirstName = $row['FirstName'];
        $this->LastName = $row['LastName'];
    }

    function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " SET FirstName = ?, LastName = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->FirstName);
        $stmt->bindParam(2,$this->LastName);

        if($stmt->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET FirstName = :firstName, LastName = :lastName WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':firstName', $this->FirstName);
        $stmt->bindParam(':lastName', $this->LastName);
        $stmt->bindParam(':id', $this->Id);

        // execute the query
        if($stmt->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    function delete()
    {
        $query = "DELETE FROM " .$this->table_name. " WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->Id);

        if($stmt->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
}
?>