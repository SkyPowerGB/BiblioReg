<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/knjiga.php");
session_start();
if (!isset($_SESSION["userId"])) {
   header("Location: prijava.php");
}

?>
<?php
include("../dijelovi/univerzalni/navbar.php");
?>

<?php
$knjiga=new Knjiga($conn);

if(isset($_POST["submitDodajKnjigu"])){
$naslov=filter_input(INPUT_POST,"naslov",FILTER_SANITIZE_STRING);
$izdavac=filter_input(INPUT_POST,"izdavac",FILTER_SANITIZE_STRING);
$godina=filter_input(INPUT_POST,"godina",FILTER_SANITIZE_STRING);
if(is_numeric($godina)){

  $knjiga->naslov=$naslov;
  $knjiga->izdavac=$izdavac;
  $knjiga->godina=$godina;

  $knjiga->createNewBook($_SESSION["userId"]);
  Header("Location:mojeKnjige.php");


}


}

?>

<div class="sg-new-book-form sg-form-new-book ">

   <div class="sg-new-book-close-form-btn-container">
      <button>X</button>
   </div>

   <form class="sg-new-book-form " method="POST" action="mojeKnjige.php">

      <div class="sg-new-book-form-part">
         <label>Naslov:</label>
         <input name="naslov">
      </div>

      <div class="sg-new-book-form-part">
         <label>Izdavač:</label>
         <input name="izdavac">
      </div>

      <div class="sg-new-book-form-part">
         <label>Godina:</label>
         <input name="godina">
      </div>

      <div class="sg-new-book-form-part">
         <button name="submitDodajKnjigu">Kreiraj</button>
      </div>

   </form>



</div>



<div>
   <?php

   include("../dijelovi/klase/bookshelf.php");
   $bookshelf = new Bookshelf($conn);
   $bookshelf->displayAllBooks($_SESSION["userId"]);
   ?>



</div>



<?php
include("../dijelovi/podnozje.php");

?>