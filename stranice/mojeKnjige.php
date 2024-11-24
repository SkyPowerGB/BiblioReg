<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/knjiga.php");
include("../dijelovi/klase/validator.php");
session_start();
if (!isset($_SESSION["userId"])) {
   header("Location: prijava.php");
}

?>
<?php
include("../dijelovi/univerzalni/navbar.php");
?>

<?php
$knjiga = new Knjiga($conn);
$validator = new Validator();


$formInputNaslov = new FormInput(
   "naslovInput",
   "naslovLbl",
   "naslov",
   "text",
   "",
   "Naslov:",
   null,
   null
);
$formInputIzdavac = new FormInput(
   "izdavacInput",
   "izdavacLbl",
   "izdavac",
   "text",
   "",
   "Izdavac:",
   null,
   null
);
$formInputGodina = new FormInput(
   "godinaInput",
   "godinaLbl",
   "godina",
   "text",
   "",
   "Godina:",
   null,
   null
);

if (isset($_POST["submitDodajKnjigu"])) {
   $naslov = filter_input(INPUT_POST, "naslov", FILTER_SANITIZE_STRING);
   $izdavac = filter_input(INPUT_POST, "izdavac", FILTER_SANITIZE_STRING);
   $godina = filter_input(INPUT_POST, "godina", FILTER_SANITIZE_STRING);
   $knjiga->naslov = $naslov;
   $knjiga->izdavac = $izdavac;
   $knjiga->godina = $godina;
   $create=true;
if($naslov==""){
   $validator->showValidationMsg($formInputNaslov,"Ovo polje ne može biti prazno");
   $create=false;
}
if($izdavac==""){
   $validator->showValidationMsg($formInputIzdavac,"Ovo polje ne može biti prazno");
   $create=false;
   }

   if (is_numeric($godina)&&$create) {
      
   

      $knjiga->createNewBook($_SESSION["userId"]);
      Header("Location:mojeKnjige.php");


   }else{
      $validator->showValidationMsg($formInputGodina,"Godina mora biti broj");
      unset($_POST["submitDodajKnjigu"]);
   }


}


$formInputNaslov->inputDefaultValue=$knjiga->naslov;
$formInputGodina->inputDefaultValue=$knjiga->godina;
$formInputIzdavac->inputDefaultValue=$knjiga->izdavac;






?>

<div class="sg-new-book-form sg-form-new-book ">

   <div class="sg-new-book-close-form-btn-container">
      <button>X</button>
   </div>

   <form class="sg-new-book-form " method="POST" action="mojeKnjige.php">

      <div class="sg-new-book-form-part">
         <?php $formInputNaslov->generateInput();  ?>
      </div>

      <div class="sg-new-book-form-part">
      <?php $formInputIzdavac->generateInput();  ?>
      </div>

      <div class="sg-new-book-form-part">
      <?php $formInputGodina->generateInput();  ?>
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