<?php
include("../dijelovi/head.php");
include("../dijelovi/klase/korisnik.php");
include("../dijelovi/klase/knjiga.php");
session_start();
if (!isset($_SESSION["userId"])) {
    header("Location: prijava.php");
}


if (!isset($_POST["idKnjige"])) {

    header("Location: pocetna.php");
}
$knjiga = new Knjiga($conn);
$korisnik = new Korisnik($conn);

if(isset($_POST["editBookSubmit"])){
    $naslov=filter_input(INPUT_POST,"naslov",FILTER_SANITIZE_STRING);
    $izdavac=filter_input(INPUT_POST,"izdavac",FILTER_SANITIZE_STRING);
    $godina=filter_input(INPUT_POST,"godina",FILTER_SANITIZE_STRING);

    $knjiga->idKnjige=$_POST["idKnjige"];
    if(is_numeric($godina)){
   $knjiga->updateBookData($naslov,$izdavac,$godina);
    }
}

$korisnik->readUserData($_SESSION["userId"]);
$knjiga->readBookData($_POST["idKnjige"]);

 if(isset($_POST["deleteBook"])){
    $knjiga->deleteBook();
    header("Location:mojeKnjige.php");
 }
  


?>


<?php
include("../dijelovi/univerzalni/navbar.php");

?>

<div class="sg-content">


    <div class="sg-sidebar">

        <?php
        if ($korisnik->isAdmin || $knjiga->autorId == $_SESSION["userId"]) {
            ?>
            <div class="sg-sidebar-btn-container">

                <button id="editBookBtn">Uredi</button>
            </div>

            <div class="sg-sidebar-btn-container">
                <button id="deleteBookBtn">Izbriši</button>
            </div>
            <?php
        }
        ?>

    </div>


    <div class="sg-content-mid">
        <div id="bookDisplay">
        <?php
        $knjiga->displayBook();
        ?>
        </div>
        <div  id="editBookForm" class="sg-book-front sg-hide-div">
            <div ><button id="closeBookEditor">X</button></div>
            <form method="POST" action="prikazKnjige.php" class="sg-book-front-form">
                <label>Naslov:</label>
                <input class="sg-book-front-form-input" name="naslov" value="<?php echo ($knjiga->naslov); ?>">
                <h2><?php echo ($knjiga->autorIme . " " . $knjiga->autorPrezime) ?></h2>
                <label>Izdavac:</label>
                <input class="sg-book-front-form-input" name="izdavac" value="<?php echo ($knjiga->izdavac); ?>">
                <label>Godina:</label>
                <input class="sg-book-front-form-input" name="godina" value="<?php echo ($knjiga->godina); ?>">
                <input type="hidden" name="idKnjige" value="<?php echo($knjiga->idKnjige) ?>">
                <button name="editBookSubmit">Spremi Promjene</button>
            </form>
           
        </div>





    </div>


    <div id="confirmActionForm" class="sg-confirm-action-form-container sg-hide-div ">
        <h1>Izbriši knjigu?</h1>
        <div class="sg-confirm-action-form-container-buttons">
            <button id="sgConfirmActionBtnCancel">Odustani</button>
            <form method="POST" action="prikazKnjige.php" class="sg-confirm-action-form">
            <input type="hidden" name="idKnjige" value="<?php echo $_POST["idKnjige"]; ?>">
                <button name="deleteBook" id="sgConfirmActionBtnOk">Izbriši</button>
            </form>
        </div>

    </div>


</div>
<script src="../funkcionalnost/prikazKnjige/prikazKnjige.js"></script>

<?php
include("../dijelovi/podnozje.php");

?>