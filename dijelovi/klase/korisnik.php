<?php

class Korisnik
{

    /**  @var mysqli */
    private $conn;

    public $userId;
    public $ime;
    public $prezime;
    public $email;
    public $aktivan;
    public $isAdmin;
    public $password;


    public function __construct($conn)
    {
        $this->conn = $conn;

    }


    public function readUserData($userId)
    {
        $this->userId=$userId;
        $sql = "SELECT * FROM korisnici WHERE idKorisnik=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("d", $userId);
        if ($stmt->execute()) {
            $row = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            $this->ime = $row["ime"];
            $this->prezime = $row["prezime"];
            $this->email = $row["email"];
            $this->password = $row["sifra"];
            if ($row["ulogaId"] == 2) {
                $this->isAdmin = true;
            } else {
                $this->isAdmin = false;
            }
            return true;
        }
        return false;
    }

    public function registerNewUser($ime, $prezime, $email, $pswrd)
    {
        //SELECT registrirajKorisnika("ime","prezime","email","pswrd") vrace UID ili -1 


        try {
            $sql = "SELECT registrirajKorisnika(?,?,?,?) AS uid";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $ime, $prezime, $email, $pswrd);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_assoc()["uid"];
                $stmt->close();
                return $result;
            }
            throw new Exception("Database execution error", $stmt->error);

        } catch (Exception $e) {
            throw new Exception("Database execution error", $stmt->error);
        }

    }

    public function emailExists($email)
    {
        try {
            $sql = "SELECT emailExists(?) AS email;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $row = $stmt->get_result()->fetch_assoc();
                $stmt->close();
                if ($row["email"] == 0) {
                    return false;
                } else {
                    return true;


                }

            }
            throw new Exception("Database execution error", $stmt->error);


        } catch (Exception $e) {
            throw new Exception("Database execution error", $stmt->error);
        }




    }


    public function updateUserData()
{   
   // id ime , prezime , aktivan,email,sifra,uloga
    $sql = "SELECT azurirajKorisnika(?,?,?,?,?,?,?) AS output";
    $stmt = $this->conn->prepare($sql);
    
    
    $uloga = null;  
    
   
    if (!$stmt->bind_param(
        "dssdsss",  
        $this->userId,
        $this->ime,
        $this->prezime,
        $this->aktivan,
        $this->email,
        $this->password,
        $uloga
    )) {
        return false; 
    }
    
 
    if ($stmt->execute()) {
        $res = $stmt->get_result()->fetch_assoc()["output"];
        $stmt->close();
        
      
        if ($res != -1) {
            return true; 
        }
        
        return false; 
    }
    
    return false; 
}

    //* za login ako se potvrdi password se moze procitat posto se id sprema */

    public function getPasswordReadId($email)
    {
        $sql = "CALL getUserPasswordId(?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        if ($stmt->execute()) {
            $row = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            if ($row == null) {
                return false;
            }

            $this->userId = $row["idKorisnik"];
            $this->password = $row["sifra"];

            return true;
        }
        return false;

    }











    /*
validacije

    TODO dodat error code + funkciju s switch koja vraca poruku ...
    */

    private $passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z]).{8,}$/";

    private $FSnamePattern = "/^[a-zA-ZÀ-ÿ'-]+$/";

    private $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    public function validacijeImePrezime($ime)
    {

        if (preg_match($this->FSnamePattern, $ime)) {
            return true;
        }
        return false;
    }

    public function validacijaSifre($sifra, $sifraPon)
    {
        if ($sifra != $sifraPon) {
            return false;
        }
        if (preg_match($this->passwordPattern, $sifra)) {
            return true;
        }
        return false;
    }

    public function validacijaEmail($email)
    {
        if ($this->emailExists($email)) {
            return false;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }

    }









}