<?php
error_reporting(0);
class Suburb
{

    // database connection and table name
    private $conn;
    private $table_name = "Suburb";

    // object properties
    public $Id;
    public $Suburb;
    public $Postcode;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    function selectAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY Suburb ASC";
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
        $this->Suburb = $row['Suburb'];
        $this->Postcode = $row['Postcode'];

    }

    function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Suburb = ?, Postcode = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->Suburb);
        $stmt->bindParam(2,$this->Postcode);


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
        $query = "UPDATE " . $this->table_name . " SET Suburb = :suburb, Postcode = :postcode WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':suburb', $this->Suburb);
        $stmt->bindParam(':postcode', $this->Postcode);

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