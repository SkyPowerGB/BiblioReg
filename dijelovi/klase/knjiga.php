<?php

class Knjiga{

   /**  @var mysqli */
    public $conn;
    public $idKnjige;
    public $naslov;
    public $izdavac;
    public $godina;
    public $datum;
    public $autorId;

function __construct($conn){
    $this->conn=$conn;
}

function readBookData($bookId){
$sql="SELECT * FROM knjiga WHERE idKnjiga=?;";

}

function createNewBook(){

    
}

function updateBookData($naslov,$izdavac,$godina){

    //id, naslov,izdavac,godina
$sql="SELECT azurirajKnjigu(?,?,?,?);";

}

function deleteBook($bookId){
    $sql="DELETE FROM knjiga WHERE idKnjiga=?;";
}




}

