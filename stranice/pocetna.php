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







   <?php

   include("../dijelovi/klase/bookshelf.php");
   $bookshelf = new Bookshelf($conn);
   $bookshelf->displayAllBooks(null);
   ?>










</div>




<?php
include("../dijelovi/podnozje.php");

?>