<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
session_start();
if (!isset($_SESSION["userId"])) {
   header("Location: prijava.php");
}

?>


<div>
   <?php
    include("../dijelovi/univerzalni/navbar.php");
   ?>


   
   <script src="../funkcionalnost/univerzalna/navbar.js"></script>



   <div class="sg-book-shelf">
      <?php

      $sql = "SELECT idKnjiga,naslov,izdavac,godina,datumDodavanja,ime,prezime,idKorisnik
         FROM knjiga JOIN korisnici ON autorId=idKorisnik ORDER BY datumDodavanja";


      $stmt = $conn->prepare($sql);
      $knjige;
      if ($stmt->execute()) {
         $knjige = $stmt->get_result();
         $stmt->close();

      }
      if ($knjige != null) {
         while (($row = $knjige->fetch_assoc()) != null) {

            echo ('<div class="sg-book-container">');
            echo ('<form method="POST" action="prikazKnjige.php">');
            echo ('<input name="idKnjige" type="hidden"' . 'value=' . $row["idKnjiga"] . ' >');

            echo ('<button class="sg-book-button">');
            echo ("<h1>");
            echo ($row["naslov"]);
            echo ("</h1>");
            echo ("<h4>");
            echo ($row["ime"]);
            echo (" ");
            echo ($row["prezime"]);
            echo ("</h4>");
            echo ("<h5>");
            echo ($row["izdavac"]);
            echo ("</h5>");
            echo ("<h6>");
            echo ($row["godina"]);
            echo ("</h6>");

            echo ("</button>");
            echo ("</form>");



            echo ("</div>");
         }
      }



      ?>

   </div>

   <div>



   </div>




</div>




<?php
include("../dijelovi/podnozje.php");

?>