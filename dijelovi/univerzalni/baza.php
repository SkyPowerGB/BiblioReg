<?php
$server="localhost";
$korisnik="root";
$sifra="root";
$imeBaze="biblioreg";

$conn=new mysqli($server,$korisnik,$sifra,$imeBaze);

$vezaRadi=false;

if($conn->connect_error) {
    $vezaRadi=false;
    die("Nuspjelo spajanje na bazu " . $conn->connect_error);
}else{
    $vezaRadi=true;
}