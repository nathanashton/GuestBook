<?php
error_reporting(0);
session_start();

class Login
{

    private $conn;
    private $table_name = "Access";


    public function __construct($db)
    {
        $this->conn = $db;
    }


    function login($accessCode)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Code = ?";

        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $accessCode);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($row['Guest_Id'] != "" || $row["Staff_Id"] != "")
        {
            $_SESSION['loggedin'] = strtoupper($accessCode);
            $_SESSION['accesslevel'] = $row['Staff'];

            if ($row['Guest_Id'] != "")
            {
                $_SESSION['id'] = $row['Guest_Id'];
                $queryGuest = "SELECT * FROM Guest WHERE Id = ?";
                $stmtGuest = $this->conn->prepare( $queryGuest );
                $stmtGuest->bindParam(1, $_SESSION['id']);
                $stmtGuest->execute();

                $rowGuest = $stmtGuest->fetch(PDO::FETCH_ASSOC);
                $_SESSION['name'] = $rowGuest['FirstName']." ".$rowGuest['LastName'];;

            } elseif ($row['Staff_Id'] != "")
            {
                $_SESSION['id'] = $row['Staff_Id'];
                $queryStaff = "SELECT * FROM Staff WHERE Id = ?";
                $stmtStaff = $this->conn->prepare( $queryStaff );
                $stmtStaff->bindParam(1, $_SESSION['id']);
                $stmtStaff->execute();

                $rowStaff = $stmtStaff->fetch(PDO::FETCH_ASSOC);
                $_SESSION['name'] = $rowStaff['FirstName']." ".$rowStaff['LastName'];;
            }




        } else
        {
            session_destroy();
            return false;
        }

    }

    function logout()
    {
        session_destroy();
        header("Location: index.php");
    }

}