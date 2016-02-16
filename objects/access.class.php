<?php
error_reporting(0);
class Access
{

    // database connection and table name
    private $conn;
    private $table_name = "Access";

    // object properties
    public $Id;
    public $Code;
    public $Staff;
    public $Staff_Id;
    public $Guest_Id;

    public $FirstName;
    public $LastName;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function generateRandom()
    {
        $this->Code = substr(md5(rand()),0,6);
    }

    function selectAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY Code";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function selectAllWithStaffAccess()
    {
        $query = "SELECT Access.Id, Code, Staff, Staff_Id, FirstName, LastName FROM " . $this->table_name . " INNER JOIN Staff ON Staff_Id = Staff.Id ORDER BY Code";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function selectAllWithGuestAccess()
    {
        $query = "SELECT Access.Id, Code, Staff, Staff_Id, FirstName, LastName FROM " . $this->table_name . " INNER JOIN Guest ON Guest_Id = Guest.Id ORDER BY Code";
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
        $this->Code = $row['Code'];
        $this->Staff = $row['Staff'];
        $this->Staff_Id = $row['Staff_Id'];
        $this->Guest_Id = $row['Guest_Id'];
    }

    function selectByCode()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Code = ? LIMIT 1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->Code);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->execute())
        {
            $this->Id = $row['Id'];
            $this->Code = $row['Code'];
            $this->Staff = $row['Staff'];
            $this->Staff_Id = $row['Staff_Id'];
            $this->Guest_Id = $row['Guest_Id'];
            return true;
        }else
        {
            return false;
        }
    }

    function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Code = ?, Staff = ?, Staff_Id = ?, Guest_Id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->Code);
        $stmt->bindParam(2,$this->Staff);
        $stmt->bindParam(3,$this->Staff_Id);
        $stmt->bindParam(4,$this->Guest_Id);

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
        $query = "UPDATE " . $this->table_name . " SET Code = :code, Staff = :staff, Staff_Id = :staffid, Guest_Id = :guestid WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':code', $this->Code);
        $stmt->bindParam(':staff', $this->Staff);
        $stmt->bindParam(':staffid', $this->Staff_Id);
        $stmt->bindParam(':guestid', $this->Guest_Id);
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