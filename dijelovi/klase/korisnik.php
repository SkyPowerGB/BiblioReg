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

    public $roleName;
    public $password;


    public function __construct($conn)
    {
        $this->conn = $conn;

    }


    public function readUserData($userId)
    {
        $this->userId = $userId;
        $sql = "SELECT * FROM korisnici join uloge on ulogaId=idUloga WHERE idKorisnik=? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("d", $userId);
        if ($stmt->execute()) {
            $row = $stmt->get_result()->fetch_assoc();
            if ($row == null) {
                return false;
            }
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
            $this->roleName = $row["nazivUloga"];
            $this->aktivan = $row["aktivan"];
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


        if ($this->isAdmin) {
            $this->role = "administrator";
        }


        if (
            !$stmt->bind_param(
                "dssdsss",
                $this->userId,
                $this->ime,
                $this->prezime,
                $this->aktivan,
                $this->email,
                $this->password,
                $this->roleName
            )
        ) {
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



    public function deleteUser($uid)
    {



        try {
            $sql = "select deleteUser(?) as output";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("d", $uid);
            if ($stmt->execute()) {
                $out = $stmt->get_result()->fetch_assoc()["output"];
                $stmt->close();
                if ($out == 1) {
                    return true;
                }

            }

        } catch (Exception $e) {
            return false;
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

    private $validationErrCode = 0;

    private const FIELD_REQUIRED = "Ovo polje ne može biti prazno";
    private const FS_FILTER_ERROR = "Neispravan unos";
    public function validacijeImePrezime($ime)
    {
        if ($ime) {
            $this->validationErrCode = 1;
            return false;
        }

        if (preg_match($this->FSnamePattern, $ime)) {
            return true;
        }
        $this->validationErrCode = 2;
        return false;
    }

     const PASSWORD_MISSMATCH = "Šifra se ne podudara";
     const PASSWORD_FILTER_ERROR = "Šifra mora sadržavat najmanje 8 znakova te barem Jedno Veliko i malo slovo";
    public function validacijaSifre($sifra, $sifraPon)
    {
        if ($sifra == null) {
            $this->validationErrCode = 1;
            return false;
        }
        if ($sifra != $sifraPon) {
            $this->validationErrCode = 3;
            return false;
        }
        if (preg_match($this->passwordPattern, $sifra)) {
            return true;
        }
        $this->validationErrCode = 4;
        return false;
    }

    const EMAIL_EIXTS = "Email postoji";
     const EMAIL_ERROR = "Neispravan email";
   
    public function validacijaEmail($email)
    {
        if ($email == null) {
            $this->validationErrCode = 1;
            return false;
        }
        if ($this->emailExists($email)) {
            $this->validationErrCode = 5;
            return false;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->validationErrCode = 6;
            return false;
        }

    }

     const VALIDATION_ERR_DEF="neispravan unos";
    public function getValidationMsg()
    {
          switch($this->validationErrCode){
             case 1: return self::FIELD_REQUIRED;
             case 2: return self::FS_FILTER_ERROR ;
             case 3: return self::PASSWORD_MISSMATCH;
             case 4: return self::PASSWORD_FILTER_ERROR;
             case 5: return self:: EMAIL_EIXTS;
             case 6: return self::EMAIL_ERROR ;
             default: return self::VALIDATION_ERR_DEF; 

          }

    }








}