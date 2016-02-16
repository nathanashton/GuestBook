<?php
error_reporting(0);
class Rating
{

    // database connection and table name
    private $conn;
    private $table_name = "Rating";

    // object properties
    public $Id;
    public $Rating;
    public $Comment;
    public $Guest_Id;
    public $MenuOption_Id;
    public $MenuItem;
    public $FirstName;
    public $LastName;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    function selectAll()
    {
        $query = "SELECT Rating.Id, Rating.Rating, Rating.Comment, Rating.Guest_Id, Rating.MenuOption_Id, MenuOption.MenuItem, Guest.FirstName, Guest.LastName FROM " . $this->table_name . " INNER JOIN MenuOption on Rating.MenuOption_Id = MenuOption.Id INNER JOIN Guest ON Rating.Guest_Id = Guest.Id ORDER BY Rating DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function selectAllByGuestId()
    {
        $query = "SELECT Rating.Id, Rating.Rating, Rating.Comment, Rating.Guest_Id, Rating.MenuOption_Id, MenuOption.MenuItem, Guest.FirstName, Guest.LastName FROM " . $this->table_name . " INNER JOIN MenuOption on Rating.MenuOption_Id = MenuOption.Id INNER JOIN Guest ON Rating.Guest_Id = Guest.Id WHERE Rating.Guest_Id = ? ORDER BY Rating DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->Guest_Id);

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
        $this->Rating = $row['Rating'];
        $this->Comment = $row['Comment'];
        $this->Guest_Id = $row['Guest_Id'];
        $this->MenuOption_Id = $row['MenuOption_Id'];

    }

      function insert()
    {
        $query = "INSERT INTO " . $this->table_name . " SET Rating = ?, Comment = ?, Guest_Id = ?, MenuOption_Id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->Rating);
        $stmt->bindParam(2,$this->Comment);
        $stmt->bindParam(3,$this->Guest_Id);
        $stmt->bindParam(4,$this->MenuOption_Id);


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
        $query = "UPDATE " . $this->table_name . " SET Rating = :rating, Comment = :comment, Guest_Id = :guestId, MenuOption_Id = :menuOptionId WHERE Id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':rating', $this->Rating);
        $stmt->bindParam(':comment', $this->Comment);
        $stmt->bindParam(':guestId', $this->Guest_Id);
        $stmt->bindParam(':menuOptionId', $this->MenuOption_Id);
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