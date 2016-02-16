<?php
error_reporting(0);
class Guest
{

    // database connection and table name
    private $conn;
    private $table_name = "Guest";

    // object properties
    public $Id;
    public $FirstName;
    public $LastName;
    public $Gender;
    public $Email;
    public $Address;
    public $Suburb_Id;
    public $Rating;

    public $SuburbId;
    public $Suburb;
    public $Postcode;


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

    function selectAllGroupSuburb()
    {
        $query = "SELECT Guest.Id AS Id, Rating, FirstName, LastName, Gender, Address, Email, Suburb_Id, Suburb.Id AS SuburbId, Suburb.Suburb AS Suburb, Suburb.Postcode AS Postcode  FROM " . $this->table_name . " INNER JOIN Suburb ON Suburb_Id = Suburb.Id ORDER BY Suburb ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function selectById()
    {
        $query = "SELECT Guest.Id AS Id, Rating, FirstName, LastName, Gender, Address, Email, Suburb_Id, Suburb.Id AS SuburbId, Suburb.Suburb AS Suburb, Suburb.Postcode AS Postcode FROM " . $this->table_name . " INNER JOIN Suburb ON Suburb_Id = Suburb.Id WHERE Guest.Id = ? LIMIT 1";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->Id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Id = $row['Id'];
        $this->FirstName = $row['FirstName'];
        $this->LastName = $row['LastName'];
        $this->Gender = $row['Gender'];
        $this->Email = $row['Email'];
        $this->Address = $row['Address'];
        $this->Rating = $row['Rating'];

        $this->Suburb_Id = $row['Suburb_Id'];
        $this->SuburbId = $row['SuburbId'];


        $this->Suburb = $row['Suburb'];
        $this->Postcode = $row['Postcode'];



    }

    function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " SET FirstName = ?, LastName = ?, Rating = ?, Gender = ?, Email = ?, Address = ?, Suburb_Id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->FirstName);
        $stmt->bindParam(2,$this->LastName);
        $stmt->bindParam(3,$this->Rating);
        $stmt->bindParam(4,$this->Gender);
        $stmt->bindParam(5,$this->Email);
        $stmt->bindParam(6,$this->Address);
        $stmt->bindParam(7,$this->Suburb_Id);


        if($stmt->execute())
        {
            $query = "SELECT * FROM " . $this->table_name . " ORDER BY Id DESC LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->Id = $row['Id'];
            return true;
        }else
        {
            return false;
        }
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET FirstName = :firstName, LastName = :lastName, Rating = :rating, Gender = :gender, Email = :email, Address = :address, Suburb_Id = :suburbId WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':firstName', $this->FirstName);
        $stmt->bindParam(':lastName', $this->LastName);
        $stmt->bindParam(':gender', $this->Gender);
        $stmt->bindParam(':email', $this->Email);
        $stmt->bindParam(':address', $this->Address);
        $stmt->bindParam(':suburbId', $this->Suburb_Id);
        $stmt->bindParam(':rating', $this->Rating);

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