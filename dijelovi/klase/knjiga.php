<?php

class Knjiga{

   /**  @var mysqli */
    public $conn;
    public $idKnjige;
    public $naslov;
    public $izdavač;
    public $godina;
    public $datum;
    public $autorId;

function __construct($conn){
    $this->conn=$conn;
}




}