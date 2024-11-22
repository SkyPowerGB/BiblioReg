<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
session_start();
if (!isset($_SESSION["userId"])) {
   header("Location: prijava.php");
}

?>


<div>
   <div>
      <a>Logo</a>
      <ul>
         <li><a href="pocetna.php">Početna</a></li>
         <li><a href="mojeKnjige.php">Moje knjige</a></li>
         <li><a>Korisnici</a></li>
      </ul>

      <a>Account</a>

   </div>


   <?php

        $sql="SELECT idKnjiga,naslov,izdavac,godina,datumDodavanja,ime,prezime
         FROM knjiga JOIN korisnici ON autorId=idKorisnik ORDER BY datumDodavanja";


       $stmt= $conn->prepare($sql);
        $knjige;
        if($stmt->execute()){
         $knjige=$stmt->get_result();
        $stmt->close();

        }
        if($knjige!=null){
            while(($row=$knjige->fetch_assoc())!=null){
                    
               echo("<div>");
               echo("<h1>");echo($row["naslov"]);  echo("</h1>");
               echo("<h4>");echo($row["ime"]); echo(" "); echo($row["prezime"]);  echo("</h4>");
               echo("<h4>");echo($row["izdavac"]);   echo("</h4>");
               echo("<h5>");echo($row["godina"]);   echo("</h5>");
         
               



               echo("</div>");
            }
        }
       


   ?>

   <div>



   </div>




</div>




<?php
include("../dijelovi/podnozje.php");

?>