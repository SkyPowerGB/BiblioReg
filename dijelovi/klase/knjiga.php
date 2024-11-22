<?php

class Knjiga
{

    /**  @var mysqli */
    public $conn;
    public $idKnjige;
    public $naslov;
    public $izdavac;
    public $godina;
    public $datum;
    public $autorId;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    function readBookData($bookId)
    {
        if($bookId==null&&$bookId<0){return;}

        $sql = "SELECT * FROM knjiga WHERE idKnjiga=?;";

    }

    function createNewBook($autorId)
    {
        // naslov, izdavac , godina, autorID
        // returns new id ili -1
        $sql = "select novaKnjiga(?,?,?,?) as output";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssdd", $this->naslov, $this->izdavac, $this->godina, $autorId);
        if ($stmt->execute()) {
            $res = $stmt->get_result()->fetch_assoc()["output"];
            $stmt->close();
            if ($res != -1) {
                $this->idKnjige = $res;
               
                return true;
            }
            return false;
        }

        return false;
    }

    function updateBookData($naslov, $izdavac, $godina)
    {
       

        //id, naslov,izdavac,godina
        $sql = "SELECT azurirajKnjigu(?,?,?,?);";
       $stmt=$this->conn->prepare($sql);
       $stmt->bind_param("dssd",$this->idKnjige,$naslov,$izdavac,$godina);
         if($stmt->execute()){
            $stmt->close();
            $this->readBookData($this->idKnjige);
         }


    }

    function deleteBook()
    {
        $sql = "DELETE FROM knjiga WHERE idKnjiga=?;";
        $stmt=$this->conn->prepare($sql);
        $stmt->bind_param("d",$this->idKnjige);
        if($stmt->execute()){
            
            $stmt->close();
            return true;
        }
        return false;

    }




}

