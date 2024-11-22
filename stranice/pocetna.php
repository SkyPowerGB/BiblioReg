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
         <li><a>Početna</a></li>
         <li><a>Moje knjige</a></li>
         <li><a>Korisnici</a></li>
      </ul>

      <a>Account</a>

   </div>



   


</div>




<?php
include("../dijelovi/podnozje.php");

?>