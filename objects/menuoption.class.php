<?php
error_reporting(0);
class MenuOption
{

    // database connection and table name
    private $conn;
    private $table_name = "MenuOption";

    // object properties
    public $Id;
    public $MenuItem;
    public $MenuItemPrice;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function selectAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY MenuItem ASC";
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
        $this->MenuItem = $row['MenuItem'];
        $this->MenuItemPrice = $row['MenuItemPrice'];
    }

    function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " SET MenuItem = ?, MenuItemPrice = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->MenuItem);
        $stmt->bindParam(2,$this->MenuItemPrice);

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
        $query = "UPDATE " . $this->table_name . " SET MenuItem = :menuItem, MenuItemPrice = :menuItemPrice WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':menuItem', $this->MenuItem);
        $stmt->bindParam(':menuItemPrice', $this->MenuItemPrice, PDO::PARAM_INT);
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